<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\DocumentExpiryNotification;

class CheckUserDocuments
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $now = Carbon::now();

            // Check user documents
            $userDocuments = $user->papiersUsers()->where('date_fin', '<=', $now->copy()->addDays(90))->get();
            $this->processDocuments($userDocuments, $user, $now, false);

            // Check car documents
            $carDocuments = $user->voitures()
                ->with('papiersVoiture')
                ->get()
                ->pluck('papiersVoiture')
                ->flatten()
                ->where('date_fin', '<=', $now->copy()->addDays(90));
            $this->processDocuments($carDocuments, $user, $now, true);
        }

        return $next($request);
    }

    /**
     * Process documents and send notifications.
     */
    private function processDocuments($documents, $user, $now, $isCar = false)
    {
        foreach ($documents as $document) {
            $daysLeft = $now->diffInDays(Carbon::parse($document->date_fin), false);

            // Construct the message
            if ($daysLeft === 0) {
                $message = "Le document '{$document->type}' expire aujourd'hui.";
            } elseif ($daysLeft < 0) {
                $message = "Le document '{$document->type}' a expiré il y a " . abs($daysLeft) . " jour(s).";
            } else {
                $message = "Le document '{$document->type}' expirera dans {$daysLeft} jour(s).";
            }

            // Create a unique notification key
            $uniqueKey = $isCar ? "car-{$document->id}" : "user-{$document->id}";

            // Check for existing notification
            $existingNotification = $user->notifications()
                ->where('data->unique_key', $uniqueKey)
                ->first();

            if ($daysLeft > 90) {
                // Delete notification if not expiring soon
                if ($existingNotification) {
                    $existingNotification->delete();
                }
            } else {
                // Create or update notification
                if ($existingNotification) {
                    $existingNotification->update([
                        'data' => [
                            'unique_key' => $uniqueKey,
                            'document_id' => $document->id,
                            'type' => $document->type,
                            'message' => $message,
                            'is_car_document' => $isCar,
                            'car_id' => $isCar ? $document->voiture_id : null,
                        ],
                    ]);
                } else {
                    $user->notify(new DocumentExpiryNotification($document, $message, $uniqueKey, $isCar));
                }
            }
        }
    }
}
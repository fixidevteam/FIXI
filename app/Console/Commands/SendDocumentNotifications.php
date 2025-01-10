<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\DocumentExpiryNotification;


class SendDocumentNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send document expiry notifications to all users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();

        // Fetch all users
        $users = User::all();

        foreach ($users as $user) {
            // Check user documents
            $userDocuments = $user->papiersUsers()
                ->where('date_fin', '<=', $now->copy()->addDays(90))
                ->get();
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
        // see the message in the storage/logs/laravel.log
        // \Log::info("Notification  amessage}");
        $this->info('Notifications sent successfully to all users!');
    }

    /**
     * Process documents and send notifications.
     *
     * @param  \Illuminate\Support\Collection  $documents
     * @param  \App\Models\User  $user
     * @param  \Carbon\Carbon  $now
     * @param  bool  $isCar
     * @return void
     */
    // private function processDocuments($documents, $user, $now, $isCar = false)
    // {
    //     foreach ($documents as $document) {

    //         $daysLeft = $now->diffInDays(Carbon::parse($document->date_fin), false);

    //         // Construct the message
    //         if ($daysLeft === 0) {
    //             $message = "Le document '{$document->type}' expire aujourd'hui.";
    //         } elseif ($daysLeft < 0) {
    //             $message = "Le document '{$document->type}' a expiré il y a " . abs($daysLeft) . " jour(s).";
    //         } else {
    //             $message = "Le document '{$document->type}' expirera dans {$daysLeft} jour(s).";
    //         }

    //         // Create a unique notification key
    //         $uniqueKey = $isCar ? "car-{$document->id}" : "user-{$document->id}";

    //         // Check for existing notification
    //         $existingNotification = $user->notifications()
    //             ->where('data->unique_key', $uniqueKey)
    //             ->first();

    //         if ($daysLeft > 90) {
    //             // Delete notification if not expiring soon
    //             if ($existingNotification) {
    //                 $existingNotification->delete();
    //             }
    //         } else {
    //             // Create or update notification
    //             if ($existingNotification) {
    //                 $existingNotification->delete();
    //                 $user->notify(new DocumentExpiryNotification($document, $message, $uniqueKey, $isCar));
    //             } else {
    //                 $user->notify(new DocumentExpiryNotification($document, $message, $uniqueKey, $isCar));
    //             }
    //         }
    //     }
    // }
    private function processDocuments($documents, $user, $now, $isCar = false)
    {
        foreach ($documents as $document) {
            // Calculate days left until expiration
            $daysLeft = $now->diffInDays(Carbon::parse($document->date_fin), false);

            // Only process for specific days
            if (in_array($daysLeft, [0, 15, 90])) {
                // Construct the notification message
                if ($daysLeft === 0) {
                    $message = "Le document '{$document->type}' expire aujourd'hui.";
                } elseif ($daysLeft === 15) {
                    $message = "Le document '{$document->type}' expirera dans 15 jour(s).";
                } elseif ($daysLeft === 90) {
                    $message = "Le document '{$document->type}' expirera dans 90 jour(s).";
                }

                // Create a unique notification key
                $uniqueKey = $isCar ? "car-{$document->id}" : "user-{$document->id}";

                // Check for an existing notification
                $existingNotification = $user->notifications()
                    ->where('data->unique_key', $uniqueKey)
                    ->first();

                // Replace existing notification or create a new one
                if ($existingNotification) {
                    $existingNotification->delete();
                }

                // Send the notification
                $user->notify(new DocumentExpiryNotification($document, $message, $uniqueKey, $isCar));
            }
        }
    }
}

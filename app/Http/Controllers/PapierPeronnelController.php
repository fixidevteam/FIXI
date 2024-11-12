<?php

namespace App\Http\Controllers;

use App\Models\UserPapier;
use App\Notifications\DocumentExpiryNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

class PapierPeronnelController extends Controller
{
    use Notifiable;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user_id = Auth::user()->id;
        $papiers = UserPapier::where('user_id', $user_id)->get();

        return view('userPaiperPersonnel.index', compact('papiers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("userPaiperPersonnel.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->validate([
            'type' => ['required', 'max:30'],
            'note' => ['max:255'],
            'photo' => ['image'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date'],

        ]);
        // dd($data['note']);
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('user/papierperso', 'public');
            $data['photo'] = $imagePath;
        }
        $data['user_id'] = $user_id;
        UserPapier::create($data);
        session()->flash('success', 'Document ajouté');
        session()->flash('subtitle', 'Votre document a été ajouté avec succès à la liste.');
        return redirect()->route('paiperPersonnel.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $papier = UserPapier::find($id);


        if (!$papier || $papier->user_id != auth()->id()) {
            abort(403);
        }
        // Calculate days remaining until expiration
        $dateFin = Carbon::parse($papier->date_fin);
        $today = Carbon::now();
        $daysRemaining = $today->diffInDays($dateFin, false); // false makes it negative if date_fin is in the past
        // Determine if it's close to expiring, e.g., less than 7 days left
        $isCloseToExpiry = $daysRemaining <= 7 && $daysRemaining > 0;
        return view('userPaiperPersonnel.show', compact('papier', 'daysRemaining', 'isCloseToExpiry'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $papier = UserPapier::find($id);
        if (!$papier || $papier->user_id != auth()->id()) {
            abort(403);
        }
        return view('userPaiperPersonnel.edit', compact('papier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $papier = UserPapier::find($id);

        if ($papier) {
            // Validate the request data
            $validatedData = $request->validate([
                'type' => ['required', 'max:30'],
                'note' => ['nullable', 'max:255'],
                'photo' => ['nullable', 'image'],
                'date_debut' => ['required', 'date'],
                'date_fin' => ['required', 'date'],
            ]);

            // Handle file upload if a photo is provided
            if ($request->hasFile('photo')) {
                $imagePath = $request->file('photo')->store('user/papierperso', 'public');
                $validatedData['photo'] = $imagePath;
            }

            // Update the document
            $papier->update($validatedData);

            // Handle related notifications
            // Handle related notifications
            $user = $papier->user; // Ensure this relationship exists in your UserPapier model

            if ($user) {
                // Generate unique key for the notification
                $uniqueKey = "user-{$papier->id}";

                // Check if a notification already exists
                $notification = $user->notifications()
                    ->where('data->unique_key', $uniqueKey)
                    ->first();

                $daysLeft = Carbon::now()->diffInDays(Carbon::parse($papier->date_fin), false);

                if ($daysLeft > 7) {
                    // Delete notification if document is no longer expiring soon
                    if ($notification) {
                        $notification->delete();
                    }
                } else {
                    // Generate the notification message
                    $message = $daysLeft === 0
                        ? "Le document '{$papier->type}' expire aujourd'hui."
                        : ($daysLeft < 0
                            ? "Le document '{$papier->type}' a expiré il y a " . abs($daysLeft) . " jour(s)."
                            : "Le document '{$papier->type}' expirera dans {$daysLeft} jour(s).");

                    if ($notification) {
                        // Update existing notification
                        $notification->update([
                            'read_at' => null, // Mark as unread
                            'data' => array_merge($notification->data, [
                                'message' => $message,
                                'document_id' => $papier->id,
                                'type' => $papier->type,
                                'unique_key' => $uniqueKey,
                            ]),
                        ]);
                    } else {
                        // Create a new notification
                        $user->notify(new DocumentExpiryNotification($papier, $message, $uniqueKey, false));
                    }
                }
            }
            session()->flash('success', 'Document mis à jour');
            session()->flash('subtitle', 'Votre document a été mis à jour avec succès.');
        } else {
            session()->flash('error', 'Document introuvable');
        }

        return redirect()->route('paiperPersonnel.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $papier = UserPapier::find($id);
        if ($papier) {
            $papier->delete();
        }
        session()->flash('success', 'Document supprimée');
        session()->flash('subtitle', 'Votre document a été supprimée avec succès.');
        return redirect()->route('paiperPersonnel.index');
    }
}

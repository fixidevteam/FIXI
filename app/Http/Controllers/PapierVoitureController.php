<?php

namespace App\Http\Controllers;

use App\Models\type_papierv;
use App\Models\VoiturePapier;
use App\Notifications\DocumentExpiryNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

use function PHPSTORM_META\type;

class PapierVoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return abort(403);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = type_papierv::all();
        return view("userPaiperVoiture.create", compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $voiture_id = Session::get('voiture_id');

        // Check if the vehicle already has 3 documents
        $existingDocumentsCount = VoiturePapier::where('voiture_id', $voiture_id)->count();
        if ($existingDocumentsCount >= 5) {
            session()->flash('error', 'Limite atteinte');
            session()->flash('subtitle', 'Vous ne pouvez ajouter que 3 documents par véhicule.');
            return redirect()->route('voiture.show', $voiture_id);
        }

        // Fetch the valid types from the database
        $validTypes = type_papierv::pluck('type')->toArray();
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('user/papierVoiture', 'public');
            $request->session()->put('temp_photo_path', $imagePath); // Save the path in the session    

        }
        $data = $request->validate([
            'type' => ['required', 'string', Rule::in($validTypes)], // Ensure type is valid
            'note' => ['nullable', 'max:255'],
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'], // Allow only JPG, PNG, and PDF, max size 2MB                'date_debut' => ['required', 'date'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date'],

        ]);
        // Use temp_photo_path if no new file is uploaded
        if (!$request->hasFile('photo') && $request->input('temp_photo_path')) {
            $data['photo'] = $request->input('temp_photo_path');
        } elseif ($request->hasFile('photo')) {
            $data['photo'] = $imagePath;
        }
        $data['voiture_id'] = $voiture_id;
        VoiturePapier::create($data);

        $request->session()->forget('temp_photo_path');
        session()->flash('success', 'Document ajouté');
        session()->flash('subtitle', 'Votre document a été ajouté avec succès à la liste.');
        return redirect()->route('voiture.show', $voiture_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $papier = VoiturePapier::find($id);
        if (!$papier || $papier->voiture_id != Session::get('voiture_id')) {
            abort(403);
        }
        // Add the file extension to the view
        $fileExtension = pathinfo($papier->photo, PATHINFO_EXTENSION);
        // Calculate days remaining until expiration
        $dateFin = Carbon::parse($papier->date_fin);
        $today = Carbon::now();
        $daysRemaining = $today->diffInDays($dateFin, false); // false makes it negative if date_fin is in the past
        // Determine if it's close to expiring, e.g., less than 7 days left
        $isCloseToExpiry = $daysRemaining <= 7 && $daysRemaining > 0;
        return view('userPaiperVoiture.show', compact('papier', 'daysRemaining', 'isCloseToExpiry', 'fileExtension'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $types = type_papierv::all();
        $papier = VoiturePapier::find($id);
        if (!$papier || $papier->voiture_id != Session::get('voiture_id')) {
            abort(403);
        }
        return view('userPaiperVoiture.edit', compact('papier', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $papier = VoiturePapier::find($id);
        $voiture_id = Session::get('voiture_id');

        // Validate the request data
        $data = $request->validate([
            'type' => ['required'],
            'note' => ['max:255'],
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'], // Allow only JPG, PNG, and PDF, max size 2MB                'date_debut' => ['required', 'date'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date'],
        ]);

        // Handle file upload if a photo is provided
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('user/papierVoiture', 'public');
            $data['photo'] = $imagePath;
        }

        // Add voiture_id to the data
        $data['voiture_id'] = $voiture_id;

        // Update the document
        if ($papier) {
            $papier->update($data);

            // Handle related notifications
            $user = $papier->voiture->user; // Ensure Voiture model has a `user` relationship
            if ($user) {
                // Generate unique key for the notification
                $uniqueKey = "car-{$papier->id}";

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
                        $notification->update(['created_at' => now()]);
                    } else {
                        // Create a new notification
                        $user->notify(new DocumentExpiryNotification($papier, $message, $uniqueKey, true));
                    }
                }
            }


            session()->flash('success', 'Document mise à jour');
            session()->flash('subtitle', 'Votre document a été mis à jour avec succès.');
        } else {
            session()->flash('error', 'Document introuvable');
        }

        // Redirect to the voiture page
        return redirect()->route('voiture.show', $voiture_id);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $papier = VoiturePapier::find($id);
        $voiture_id = $papier->voiture_id;
        if ($papier) {
            $papier->delete();
        }

        session()->flash('success', 'Document supprimée');
        session()->flash('subtitle', 'Votre document a été supprimée avec succès.');
        return redirect()->route('voiture.show', $voiture_id);
    }
}
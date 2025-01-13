<?php

namespace App\Http\Controllers;

use App\Models\type_papierp;
use App\Models\UserPapier;
use App\Notifications\AddDocumentNotification;
use App\Notifications\DocumentExpiryNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rule;

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
        $types = type_papierp::all();
        return view("userPaiperPersonnel.create", compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Retrieve the current user's ID
        $user_id = Auth::user()->id;

        // Validate the request for the photo
        $request->validate([
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'], // Only allow JPG, PNG, and PDF with max size 2MB
        ]);

        $compressedFilePath = null; // Initialize compressed file path

        if ($request->hasFile('photo')) {
            // Handle file upload and compression
            $file = $request->file('photo');
            $extension = strtolower($file->getClientOriginalExtension());
            $uniqueName = uniqid() . '_' . time() . '.' . $extension;
            $outputPath = storage_path('app/public/user/papierperso/' . $uniqueName);

            if (in_array($extension, ['jpg', 'jpeg'])) {
                $image = imagecreatefromjpeg($file->getRealPath());
                imagejpeg($image, $outputPath, 25); // Compress JPEG
                imagedestroy($image);
            } elseif ($extension === 'png') {
                $image = imagecreatefrompng($file->getRealPath());
                imagepng($image, $outputPath, 6); // Compress PNG
                imagedestroy($image);
            } elseif ($extension === 'pdf') {
                $file->move(storage_path('app/public/user/papierperso'), $uniqueName); // Move PDF without compression
            }

            $compressedFilePath = 'user/papierperso/' . $uniqueName;

            // Store the file path in the session
            $request->session()->put('temp_photo_perso', $compressedFilePath);
        }

        // Fetch valid types from the database
        $validTypes = type_papierp::pluck('type')->toArray();

        // Validate the rest of the input fields
        $request->validate([
            'type' => ['required', 'string', Rule::in($validTypes)], // Ensure type is valid
            'note' => ['nullable', 'max:255'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date', 'after_or_equal:date_debut'], // Ensure date_fin is after date_debut
        ]);

        // Prepare the data for insertion
        $data = $request->only(['type', 'note', 'date_debut', 'date_fin']); // Only extract validated fields
        $data['user_id'] = $user_id;

        // Use temp_photo_path if no new file is uploaded
        if (!$request->hasFile('photo') && $request->session()->has('temp_photo_perso')) {
            $data['photo'] = $request->session()->get('temp_photo_perso');
        } else {
            $data['photo'] = $compressedFilePath;
        }

        // Create the document
        $document = UserPapier::create($data);


        Auth::user()->notify(new AddDocumentNotification($document, 'Vous avouez ajouté le document ' . $document->type, 'ajouter' . $document->id . 'user', false));

        // Clear the temp photo path from the session
        $request->session()->forget('temp_photo_perso');

        // Flash success message and redirect
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
        // Add the file extension to the view
        $fileExtension = pathinfo($papier->photo, PATHINFO_EXTENSION);
        // Calculate days remaining until expiration
        $dateFin = Carbon::parse($papier->date_fin);
        $today = Carbon::now();
        $daysRemaining = $today->diffInDays($dateFin, false); // false makes it negative if date_fin is in the past
        // Determine if it's close to expiring, e.g., less than 7 days left
        $isCloseToExpiry = $daysRemaining <= 7 && $daysRemaining > 0;
        return view('userPaiperPersonnel.show', compact('papier', 'daysRemaining', 'isCloseToExpiry', 'fileExtension'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $types = type_papierp::all();
        $papier = UserPapier::find($id);
        if (!$papier || $papier->user_id != auth()->id()) {
            abort(403);
        }
        return view('userPaiperPersonnel.edit', compact('papier', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // new update
        $papier = UserPapier::find($id);

        if ($papier) {
            // Validate the input fields
            $validatedData = $request->validate([
                'type' => ['required'],
                'note' => ['nullable', 'max:255'],
                'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
                'date_debut' => ['required', 'date'],
                'date_fin' => ['required', 'date', 'after_or_equal:date_debut'],
            ]);

            // Handle photo upload if provided
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $extension = strtolower($file->getClientOriginalExtension());
                $uniqueName = uniqid() . '_' . time() . '.' . $extension;

                if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    // Compress image files (JPG/PNG)
                    $outputPath = storage_path('app/public/user/papierperso/' . $uniqueName);
                    $sourcePath = $file->getRealPath();

                    if ($extension === 'jpg' || $extension === 'jpeg') {
                        $image = imagecreatefromjpeg($sourcePath);
                        imagejpeg($image, $outputPath, 25); // Compress JPEG
                        imagedestroy($image);
                    } elseif ($extension === 'png') {
                        $image = imagecreatefrompng($sourcePath);
                        imagepng($image, $outputPath, 6); // Compress PNG
                        imagedestroy($image);
                    }
                } elseif ($extension === 'pdf') {
                    // Move PDF file without modification
                    $file->move(storage_path('app/public/user/papierperso'), $uniqueName);
                }

                // Update the validated data with the file path
                $validatedData['photo'] = 'user/papierperso/' . $uniqueName;
            }

            // Update the document in the database
            $papier->update($validatedData);

            // Handle notifications for document expiry
            $user = $papier->user; // Ensure the relationship exists in your UserPapier model
            if ($user) {
                $uniqueKey = "user-{$papier->id}";
                $notification = $user->notifications()->where('data->unique_key', $uniqueKey)->first();
                $daysLeft = Carbon::now()->diffInDays(Carbon::parse($papier->date_fin), false);

                if ($daysLeft > 7) {
                    // Delete notification if the document is not expiring soon
                    if ($notification) {
                        $notification->delete();
                    }
                } else {
                    // Create or update a notification
                    $message = $daysLeft === 0
                        ? "Le document '{$papier->type}' expire aujourd'hui."
                        : ($daysLeft < 0
                            ? "Le document '{$papier->type}' a expiré il y a " . abs($daysLeft) . " jour(s)."
                            : "Le document '{$papier->type}' expirera dans {$daysLeft} jour(s).");

                    if ($notification) {
                        $notification->update([
                            'read_at' => null, // Mark as unread
                            'data' => array_merge($notification->data, [
                                'message' => $message,
                                'document_id' => $papier->id,
                                'type' => $papier->type,
                                'unique_key' => $uniqueKey,
                            ]),
                            'created_at' => now(),
                        ]);
                    } else {
                        $user->notify(new DocumentExpiryNotification($papier, $message, $uniqueKey, false));
                    }
                }
            }

            // Flash success message
            session()->flash('success', 'Document mis à jour');
            session()->flash('subtitle', 'Votre document a été mis à jour avec succès.');
        } else {
            // Flash error message if the document is not found
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

<?php

namespace App\Http\Controllers;

use App\Models\type_papierv;
use App\Models\Voiture;
use App\Models\VoiturePapier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DocumentVoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();

        // Fetch voiture_ids that belong to the authenticated user
        $voiture_ids = Voiture::where('user_id', $user_id)->pluck('id');

        // Fetch documents (papiers) related to the user's vehicles with pagination
        $documents = VoiturePapier::whereIn('voiture_id', $voiture_ids)->paginate(10); // 10 items per page

        return view('userDocumentVoiture.index', compact('documents'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        // Fetch authenticated user's vehicles
        $userVehicles = Voiture::where('user_id', $user->id)->get();
        // Fetch all available types
        $types = type_papierv::all();
        return view('userDocumentVoiture.create', compact('userVehicles', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'], // Allow only JPG, PNG, and PDF, max size 2MB
            'voiture_id' => ['required', Rule::exists('voitures', 'id')->where('user_id', Auth::id())], // Ensure voiture belongs to the user
        ]);

        $compressedFilePath = null; // Initialize the compressed file path

        // Handle photo upload and compression
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = strtolower($file->getClientOriginalExtension());
            $uniqueName = uniqid() . '_' . time() . '.' . $extension;

            // Handle image compression or PDF saving
            if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                $outputPath = storage_path('app/public/user/papierVoiture/' . $uniqueName);
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

                $compressedFilePath = 'user/papierVoiture/' . $uniqueName;
            } elseif ($extension === 'pdf') {
                // Move the PDF without modification
                $file->move(storage_path('app/public/user/papierVoiture'), $uniqueName);
                $compressedFilePath = 'user/papierVoiture/' . $uniqueName;
            }

            // Store the file path in the session
            $request->session()->put('temp_photo_document_voiture', $compressedFilePath);
        }

        // Fetch valid types from the database
        $validTypes = type_papierv::pluck('type')->toArray();

        // Validate the rest of the input fields
        $data = $request->validate([
            'type' => ['required', 'string', Rule::in($validTypes)], // Ensure type is valid
            'note' => ['nullable', 'max:255'],
            'date_debut' => ['required', 'date'],
            'date_fin' => ['required', 'date', 'after_or_equal:date_debut'], // Ensure date_fin is after date_debut
        ]);

        // Use the session photo if no new file is uploaded
        if (!$request->hasFile('photo') && $request->session()->has('temp_photo_document_voiture')) {
            $data['photo'] = $request->session()->get('temp_photo_document_voiture');
        } elseif ($request->hasFile('photo')) {
            $data['photo'] = $compressedFilePath;
        }

        // Assign the voiture_id to the data
        $data['voiture_id'] = $request->input('voiture_id');

        // Create the document
        VoiturePapier::create($data);

        // Clear the temp_photo_document_voiture session
        $request->session()->forget('temp_photo_document_voiture');

        // Flash success message and redirect
        session()->flash('success', 'Document ajouté');
        session()->flash('subtitle', 'Votre document a été ajouté avec succès à la liste.');

        return redirect()->route('documentVoiture.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return back();
    }
}
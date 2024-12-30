<?php

namespace App\Http\Controllers;

use App\Models\MarqueVoiture;
use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class VoitureController extends Controller
{

    public function index()
    {
        $user_id = Auth::user()->id;
        $voitures = Voiture::where('user_id', $user_id)->get();
        return view('userCars.index', compact('voitures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marques = MarqueVoiture::all();
        return view("userCars.create", compact('marques'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $request->validate(['photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048']]);
        // Gestion de la photo (compression et stockage)
        if ($request->hasFile('photo')) {
            $sourcePath = $request->file('photo')->getRealPath();
            $extension = strtolower($request->file('photo')->getClientOriginalExtension());
            $uniqueName = uniqid() . '_' . time() . '.' . $extension;
            $outputPath = storage_path('app/public/user/voitures/' . $uniqueName);

            $image = null;
            if (in_array($extension, ['jpg', 'jpeg'])) {
                $image = imagecreatefromjpeg($sourcePath);
                imagejpeg($image, $outputPath, 25);
            } elseif ($extension === 'png') {
                $image = imagecreatefrompng($sourcePath);
                imagepng($image, $outputPath, 6);
            }
            if ($image) {
                imagedestroy($image);
            }

            $compressedImagePath = '/user/voitures/' . $uniqueName;
            $request->session()->put('temp_photo_voiture', $compressedImagePath);
        }

        // Validation des données d'entrée
        $data = $request->validate([
            'part1' => ['required', 'digits_between:1,6'],
            'part2' => ['required', 'string', 'size:1'],
            'part3' => ['required', 'digits_between:1,2'],
        ]);

        // Combiner les parties pour créer le numéro d'immatriculation
        $numeroImmatriculation = $data['part1'] . '-' . $data['part2'] . '-' . $data['part3'];

        // Vérification de l'unicité du numéro d'immatriculation
        $exists = Voiture::where('user_id', $user_id)
            ->where('numero_immatriculation', $numeroImmatriculation)
            ->whereNull('deleted_at')
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withErrors(['numero_immatriculation' => 'Une voiture avec ce numéro d\'immatriculation existe déjà dans votre compte.'])
                ->withInput();
        }

        // validation 
        $data = $request->validate([
            'part1' => ['required', 'digits_between:1,6'], // 1 to 6 digits
            'part2' => ['required', 'string', 'size:1'], // Single Arabic letter
            'part3' => ['required', 'digits_between:1,2'], // 1 to 2 digits
            'marque' => ['required', 'max:30'],
            'modele' => ['required', 'max:30'],
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'], // Allow only JPG, PNG, and PDF, max size 2MB
            'date_de_première_mise_en_circulation' => ['nullable', 'date'],
            'date_achat' => ['nullable', 'date'],
            'date_de_dédouanement' => ['nullable', 'date'],
        ]);

        // Use temp_photo_voiture if no new file is uploaded
        if (!$request->hasFile('photo') && $request->input('temp_photo_voiture')) {
            $data['photo'] = $request->input('temp_photo_voiture');
        } elseif ($request->hasFile('photo')) {
            $data['photo'] = $compressedImagePath;
        }

        // Préparation des données pour la sauvegarde
        $data['user_id'] = $user_id;
        $data['numero_immatriculation'] = $numeroImmatriculation;
        unset($data['part1'], $data['part2'], $data['part3']);

        // Création de l'enregistrement
        Voiture::create($data);

        // Remove temp_photo_voiture when done
        $request->session()->forget('temp_photo_voiture');
        // Flash message to the session
        session()->flash('success', 'Voiture ajoutée');
        session()->flash('subtitle', 'Votre voiture a été ajoutée avec succès à la liste.');

        return redirect()->route('voiture.index');
        // normal store :
        // $user_id = Auth::user()->id;
        // Vérifiez si l'utilisateur a déjà atteint la limite
        // $existingVoituresCount = Voiture::where('user_id', $user_id)->count();
        // if ($existingVoituresCount >= 1) {
        // Redirection avec un message d'assistance
        // session()->flash('error', 'Vous avez atteint la limite autorisée.');
        // session()->flash('subtitle', 'Pour ajouter davantage, merci de nous contacter.');
        // return redirect()->route('voiture.index');
        // }
        // $request->validate([
        //     'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'], // Allow only JPG, PNG, and PDF, max size 2MB
        // ]);
        // if ($request->hasFile('photo')) {
        //     // Source image path (temporary uploaded file)
        //     $sourcePath = $request->file('photo')->getRealPath();
        //     // Define the output path (store in public storage for access)
        //     $extension = strtolower($request->file('photo')->getClientOriginalExtension());
        //     $uniqueName = uniqid() . '_' . time() . '.' . $extension;
        //     $outputPath = storage_path('app/public/user/voitures/' . $uniqueName);
        //     // Load the image based on its type
        //     $image = null;
        //     if (in_array($extension, ['jpg', 'jpeg'])) {
        //         $image = imagecreatefromjpeg($sourcePath);
        //         imagejpeg($image, $outputPath, 25); // Compress JPEG/JPG
        //     } elseif ($extension === 'png') {
        //         $image = imagecreatefrompng($sourcePath);
        //         imagepng($image, $outputPath, 6);
        //     }
        //     imagedestroy($image);
        //     $compressedImagePath = '/user/voitures/' . $uniqueName;
        //     $request->session()->put('temp_photo_path', $compressedImagePath);
        // }
        // // validation 
        // $data = $request->validate([
        //     'part1' => ['required', 'digits_between:1,6'], // 1 to 6 digits
        //     'part2' => ['required', 'string', 'size:1'], // Single Arabic letter
        //     'part3' => ['required', 'digits_between:1,2'], // 1 to 2 digits
        //     'marque' => ['required', 'max:30'],
        //     'modele' => ['required', 'max:30'],
        //     'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'], // Allow only JPG, PNG, and PDF, max size 2MB
        //     'date_de_première_mise_en_circulation' => ['nullable', 'date'],
        //     'date_achat' => ['nullable', 'date'],
        //     'date_de_dédouanement' => ['nullable', 'date'],
        // ]);

        // // Use temp_photo_path if no new file is uploaded
        // if (!$request->hasFile('photo') && $request->input('temp_photo_path')) {
        //     $data['photo'] = $request->input('temp_photo_path');
        // } elseif ($request->hasFile('photo')) {
        //     $data['photo'] = $compressedImagePath;
        // }

        // // Combine the parts into the `numero_immatriculation`
        // $numeroImmatriculation = $data['part1'] . '-' . $data['part2'] . '-' . $data['part3'];
        // // Validation de l'unicité du numéro d'immatriculation
        // $request->validate([
        //     'numero_immatriculation' => [
        //         'regex:/^\d{1,6}-[أ-ي]{1}-\d{1,2}$/', // Vérifie le format correct
        //         Rule::unique('voitures', 'numero_immatriculation')
        //             ->where('user_id', $user_id) // Unicité par utilisateur
        //             ->whereNull('deleted_at'), // Gère les soft deletes
        //     ],
        // ]);

        // $data['user_id'] = $user_id;
        // $data['numero_immatriculation'] = $numeroImmatriculation;
        // // Remove temporary fields to avoid unnecessary database columns
        // unset($data['part1'], $data['part2'], $data['part3']);
        // Voiture::create($data);

        // // Remove temp_photo_path when done
        // $request->session()->forget('temp_photo_path');
        // // Flash message to the session
        // session()->flash('success', 'Voiture ajoutée');
        // session()->flash('subtitle', 'Votre voiture a été ajoutée avec succès à la liste.');
        // return redirect()->route('voiture.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Session::put('voiture_id', $id);
        $operations = nom_operation::all();
        $categories = nom_categorie::all();
        $voiture  = Voiture::find($id);
        if (!$voiture || $voiture->user_id !== auth()->id()) {
            abort(403);
        }

        return view('userCars.show', compact('voiture', 'operations', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $voiture = Voiture::find($id);
        $marques = MarqueVoiture::all();
        if (!$voiture || $voiture->user_id !== auth()->id()) {
            abort(403);
        }
        return view('userCars.edit', compact('voiture', 'marques'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $voiture = Voiture::find($id);
        $user_id = Auth::user()->id;
        $data = $request->validate([
            'part1' => ['required', 'digits_between:1,6'], // 1 to 6 digits
            'part2' => ['required', 'string', 'size:1'], // Single Arabic letter
            'part3' => ['required', 'digits_between:1,2'], // 1 to 2 digits
            'marque' => ['required', 'max:30'],
            'modele' => ['required', 'max:30'],
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'], // Allow only JPG, PNG, and PDF, max size 2MB                'date_debut' => ['required', 'date'],
            'date_de_première_mise_en_circulation' => ['nullable', 'date'],
            'date_achat' => ['nullable', 'date'],
            'date_de_dédouanement' => ['nullable', 'date'],
        ]);
        // Combine the parts into the `numero_immatriculation`
        $numeroImmatriculation = $data['part1'] . '-' . $data['part2'] . '-' . $data['part3'];
        // Validate the uniqueness of the combined `numero_immatriculation`, ignoring the current voiture record
        $request->validate([
            'numero_immatriculation' => [
                'regex:/^\d{1,6}-[أ-ي]{1}-\d{1,2}$/', // Ensure it matches the pattern
                Rule::unique('voitures', 'numero_immatriculation')->ignore($voiture->id)->whereNull('deleted_at'), // Check uniqueness while ignoring current record
            ],
        ]);
        if ($request->hasFile('photo')) {
            // Source image path (temporary uploaded file)
            $sourcePath = $request->file('photo')->getRealPath();
            // Define the output path (store in public storage for access)
            $extension = strtolower($request->file('photo')->getClientOriginalExtension());
            $uniqueName = uniqid() . '_' . time() . '.' . $extension;
            $outputPath = storage_path('app/public/user/voitures/' . $uniqueName);
            // Load the image based on its type
            $image = null;
            if (in_array($extension, ['jpg', 'jpeg'])) {
                $image = imagecreatefromjpeg($sourcePath);
                imagejpeg($image, $outputPath, 25); // Compress JPEG/JPG
            } elseif ($extension === 'png') {
                $image = imagecreatefrompng($sourcePath);
                imagepng($image, $outputPath, 6);
            }
            imagedestroy($image);
            $compressedImagePath = '/user/voitures/' . $uniqueName;
            $data['photo'] = $compressedImagePath;
        }
        // Add user ID and combined numero_immatriculation
        $data['user_id'] = $user_id;
        $data['numero_immatriculation'] = $numeroImmatriculation;
        // Remove temporary fields to avoid unnecessary database columns
        unset($data['part1'], $data['part2'], $data['part3']);
        $voiture->update($data);
        // Flash message to the session
        session()->flash('success', 'Voiture mise à jour');
        session()->flash('subtitle', 'Votre voiture a été mise à jour avec succès dans la liste.');
        return redirect()->route('voiture.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $voiture = Voiture::find($id);
        if ($voiture) {
            $voiture->papiersVoiture()->delete();
            $voiture->operations()->delete();
            $voiture->delete();
        }
        session()->flash('success', 'Voiture supprimée');
        session()->flash('subtitle', 'Votre voiture a été supprimée avec succès.');
        return redirect()->route('voiture.index');
    }
}

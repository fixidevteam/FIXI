<?php

namespace App\Http\Controllers;

use App\Models\garage;
use App\Models\nom_categorie;
use App\Models\nom_operation;
use App\Models\nom_sous_operation;
use App\Models\Operation;
use App\Models\SousOperation;
use App\Models\Ville;
use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\Foreach_;
use PHPUnit\Framework\Constraint\Operator;
use Illuminate\Support\Str;


class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch the authenticated user's operations & Display 10 operations per page
        $operations = Operation::whereHas('voiture', function ($query) {
            $query->where('user_id', Auth::id());
        })->paginate(10);

        // Get categories,operations and garages for the view
        $operationsAll = nom_operation::all();
        $categories = nom_categorie::all();
        $garages = garage::all();
        return view('userOperations.index', compact('operations', 'operationsAll', 'categories', 'garages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get garages in the user's 'ville', including global garages and user-specific garages
        $userVilleGarages = Garage::where(function ($query) {
            $query->where('ville', Auth::user()->ville) // Garages in the same 'ville'
                ->where(function ($subQuery) {
                    $subQuery->whereNull('user_id') // Global garages only
                        ->orWhere('user_id', Auth::id()); // User-specific garages
                });
        })->get();

        // Get garages outside the user's 'ville' (excluding those already in the user's 'ville')
        $otherGarages = Garage::where(function ($query) {
            $query->where('ville', '!=', Auth::user()->ville) // Garages outside the user's 'ville'
                ->where(function ($subQuery) {
                    $subQuery->whereNull('user_id') // Global garages only
                        ->orWhere('user_id', Auth::id()); // User-specific garages
                });
        })->get();

        // Combine both collections with the user's 'ville' garages on top
        $garages = $userVilleGarages->merge($otherGarages)->groupBy('ville'); // Group garages by 'ville'

        $categories = nom_categorie::all();

        return view('userOperations.create', compact('categories', 'garages'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $voiture = Session::get('voiture_id');
        $request->validate([
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'], // Allow only JPG, PNG, and PDF, max size 2MB
        ]);
        if ($request->hasFile('photo')) {
            // Source image path (temporary uploaded file)
            $sourcePath = $request->file('photo')->getRealPath();
            // Define the output path (store in public storage for access)
            $extension = strtolower($request->file('photo')->getClientOriginalExtension());
            $uniqueName = uniqid() . '_' . time() . '.' . $extension;
            $outputPath = storage_path('app/public/user/operations/' . $uniqueName);
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
            $compressedImagePath = '/user/operations/' . $uniqueName;
            $request->session()->put('temp_photo_operation', $compressedImagePath);
        }

        $data = $request->validate([
            'categorie' => ['required',],
            'nom' => ['nullable'],
            'autre_operation' => ['nullable', 'string', 'max:255'],
            'description' => ['max:255'],
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'], // Allow only JPG, PNG, and PDF, max size 2MB                'date_debut' => ['required', 'date'],
            'date_operation' => ['required', 'date'],
            'garage_id' => ['nullable'],
            'new_garage_name' => ['nullable', 'string', 'max:255'],
        ]);
        // Handle "Autre" for operations
        if ($request->nom === 'autre') {
            $data['nom'] = 'Autre'; // Set 'nom' as 'Autre'
            $data['autre_operation'] = $request->autre_operation; // Store the custom operation name
        } else {
            $data['autre_operation'] = null; // Clear custom name for predefined operations
        }
        // If "Autre" is selected, create a new garage for the current user
        if ($request->filled('new_garage_name')) {
            $newGarage = Garage::create([
                'name' => $request->input('new_garage_name'),
                'ref' => Str::random(8),
                'user_id' => Auth::id(),
                'ville' => Auth::user()->ville, // Assign the current user's city
            ]);
            $data['garage_id'] = $newGarage->id;
        }
        // Use temp_photo_operation if no new file is uploaded
        if (!$request->hasFile('photo') && $request->input('temp_photo_operation')) {
            $data['photo'] = $request->input('temp_photo_operation');
        } elseif ($request->hasFile('photo')) {
            $data['photo'] = $compressedImagePath;
        }
        $data['voiture_id'] = $voiture;
        $data['create_by'] = 'user';
        $operation = Operation::create($data);

        // add sous operation 
        if ($request->filled('sousOperations')) {
            // If sousOperations is not empty, dump and display the data
            foreach ($request->input('sousOperations') as $idSous) {
                $name = nom_sous_operation::find($idSous);
                SousOperation::create(
                    [
                        'nom' => $name->id,
                        'operation_id' => $operation->id
                    ]
                );
            }
        }

        // Flash message to the session

        $request->session()->forget('temp_photo_operation');
        session()->flash('success', 'Operation ajoutée');
        session()->flash('subtitle', 'Votre Operation a été ajoutée avec succès à la liste.');
        return redirect()->route('voiture.show', $voiture);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $operation = Operation::find($id);
        if ($operation) {
            $voiture = $operation->voiture;
            $operations = nom_operation::all();
            $categories = nom_categorie::all();
            $sousOperation = nom_sous_operation::all();
            if (!$operation || $operation->voiture_id != $operation->voiture->id) {
                abort(403);
            }
            return view('userOperations.show', compact('voiture', 'operation', 'operations', 'categories', 'sousOperation'));
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = nom_categorie::all();

        // Get garages in the user's 'ville', including global garages and user-specific garages
        $userVilleGarages = Garage::where(function ($query) {
            $query->where('ville', Auth::user()->ville) // Garages in the same 'ville'
                ->where(function ($subQuery) {
                    $subQuery->whereNull('user_id') // Global garages only
                        ->orWhere('user_id', Auth::id()); // User-specific garages
                });
        })->get();

        // Get garages outside the user's 'ville' (excluding those already in the user's 'ville')
        $otherGarages = Garage::where(function ($query) {
            $query->where('ville', '!=', Auth::user()->ville) // Garages outside the user's 'ville'
                ->where(function ($subQuery) {
                    $subQuery->whereNull('user_id') // Global garages only
                        ->orWhere('user_id', Auth::id()); // User-specific garages
                });
        })->get();

        // Combine both collections with the user's 'ville' garages on top
        $garages = $userVilleGarages->merge($otherGarages)->groupBy('ville'); // Group garages by 'ville'
        $operation = Operation::find($id);
        $sousOperation = nom_sous_operation::all();
        if (!$operation || $operation->voiture_id != $operation->voiture_id) {
            abort(403);
        }
        return view('userOperations.edit', compact('operation', 'categories', 'garages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $operation = Operation::find($id);
        // dd($operation->voiture_id);
        $voiture = $operation->voiture_id;
        $data = $request->validate([
            'categorie' => [
                'required',
            ],
            'nom' => ['nullable'],
            'autre_operation' => ['nullable', 'string', 'max:255'],
            'description' => ['max:255'],
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'], // Allow only JPG, PNG, and PDF, max size 2MB                'date_debut' => ['required', 'date'],
            'date_operation' => ['required', 'date'],
            'garage_id' => ['nullable'],
            'new_garage_name' => ['nullable', 'string', 'max:255',],
        ]);
        // Check if "Autre" is selected and handle it
        if ($request->nom === 'autre') {
            $data['nom'] = 'Autre'; // Set 'nom' as 'Autre'
            $data['autre_operation'] = $request->autre_operation; // Store the custom operation name
        } else {
            $data['autre_operation'] = null; // Clear custom name for predefined operations
        }
        // Handle "Autre" option for a new garage
        if ($request->filled('new_garage_name')) {
            $newGarage = Garage::create([
                'name' => $request->input('new_garage_name'),
                'ref' => Str::random(8),
                'user_id' => Auth::id(),
                'ville' => Auth::user()->ville, // Assign the current user's city
            ]);
            $data['garage_id'] = $newGarage->id;
        }
        // compress image
        if ($request->hasFile('photo')) {
            // Source image path (temporary uploaded file)
            $sourcePath = $request->file('photo')->getRealPath();
            // Define the output path (store in public storage for access)
            $extension = strtolower($request->file('photo')->getClientOriginalExtension());
            $uniqueName = uniqid() . '_' . time() . '.' . $extension;
            $outputPath = storage_path('app/public/user/operations/' . $uniqueName);
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
            $compressedImagePath = '/user/operations/' . $uniqueName;
            $data['photo'] = $compressedImagePath;
        }

        // add operation 
        $data['voiture_id'] = $voiture;
        $operation->update($data);


        // update sous operation 
        if ($request->filled('sousOperations')) {
            // Delete existing sousOperations related to this operation
            $operation->sousOperations()->delete();

            // Re-add each sousOperation from the request
            foreach ($request->input('sousOperations') as $idSous) {
                $name = nom_sous_operation::find($idSous);
                SousOperation::create([
                    'nom' => $name->id,
                    'operation_id' => $operation->id
                ]);
            }
        } else {
            // If no sousOperations provided, delete all related sousOperations
            $operation->sousOperations()->delete();
        }
        session()->flash('success', 'Operation modifiée');
        session()->flash('subtitle', 'Votre Operation a été modifiée avec succès à la liste.');
        return redirect()->route('voiture.show', $voiture);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $operation = Operation::find($id);
        $voiture = $operation->voiture_id;
        $operation->sousOperations()->delete();
        $operation->delete();
        session()->flash('success', 'Operation supprimée');
        session()->flash('subtitle', 'Votre Operation a été supprimée avec succès à la liste.');
        return redirect()->route('voiture.show', $voiture);
    }
}

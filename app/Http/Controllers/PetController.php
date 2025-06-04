<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Breed;
use App\Models\Category;
// use Illuminate\Http\Request;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use Illuminate\Support\Facades\Auth;

// use Google\Client as GoogleClient;
// use Google\Service\Drive as GoogleDriveService;
// use Google\Service\Drive\DriveFile;
// use Google\Service\Drive\Permission;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with(['category', 'breed'])->paginate(10);
        foreach ($pets as $pet) {
            $pet->images = json_decode($pet->images, true);
        }
        return view('pet.index', compact('pets'));
    }

    public function create()
    {
        $pet = new Pet();
        $categories = Category::all();
        $breeds = Breed::all();
        return view('pet.create', compact('pet', 'categories', 'breeds'));
    }
    public function store(StorePetRequest $request)
    {
        // if ($request->image) {
        //     $file = $request->image;
        //     $newImageName = "pet_image" . uniqid() . "." . $file->extension();
        //     $file->storeAs("public/PetImage", $newImageName);
        // }
        $newImagesName = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $newImageName = "pet_image" . uniqid() . "." . $file->extension();
                $file->storeAs("public/PetImage", $newImageName);
                $newImagesName[] = $newImageName;
            }
        };
        $pet = new Pet();
        $pet->name = $request->name;
        $pet->breed = $request->breed;
        $pet->category = $request->category;
        $pet->birth_date = $request->birth_date;
        $pet->description = $request->description;
        $pet->images = json_encode($newImagesName);
        $pet->status = $request->status;

        $pet->save();
        return redirect()->route('pets.index');
    }


    public function show(Pet $pet)
    {
        return view('pet.show', compact('pet'));
    }


    public function edit(Pet $pet)
    {
        $categories = Category::all();
        $breeds = Breed::all();
        $pet->images = json_decode($pet->images, true);
        return view('pet.edit', compact('pet', 'categories', 'breeds'));
    }


    public function update(UpdatePetRequest $request, Pet $pet)
    {
        $oldImages = json_decode($pet->images, true);
        if (is_array($oldImages)) {
            foreach ($oldImages as $image) {
                $imagePath = storage_path("app/public/PetImage/" . $image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
        // return $request;
        $newImagesName = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $newImageName = "pet_image" . uniqid() . "." . $file->extension();
                $file->storeAs("public/PetImage", $newImageName);
                $newImagesName[] = $newImageName;
            }
        };
        $pet->name = $request->name;
        $pet->breed = $request->breed;
        $pet->category = $request->category;
        $pet->birth_date = $request->birth_date;
        $pet->description = $request->description;
        // if ($request->image) {
        //     $file = $request->image;
        //     $newImageName = "pet_image" . uniqid() . "." . $file->extension();
        //     $file->storeAs("public/PetImage", $newImageName);
        //     $pet->image = $newImageName; // Update the image field
        // }
        $pet->images = json_encode($newImagesName);
        $pet->status = $request->status;
        $pet->save();
        return redirect()->route('pets.index')->with('success', 'Pet updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        // Decode images from JSON
        $images = json_decode($pet->images, true);

        // Delete images from storage
        if (is_array($images)) {
            foreach ($images as $image) {
                $imagePath = storage_path("app/public/PetImage/" . $image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        // Delete pet from database
        $pet->delete();

        return redirect()
            ->route('pets.index')
            ->with('success', 'Pet deleted successfully!');
    }


    public function getBreedsByCategory($id)
    {
        $breeds = Breed::where('category_id', $id)->get(['id', 'name']);
        return response()->json($breeds);
    }

    public function showPublicPets()
    {
        $user = Auth::user(); // authenticated user
        $pets = Pet::where('status', 'available')->with(['category', 'breed'])->get()->take(4);

        foreach ($pets as $pet) {
            $pet->images = json_decode($pet->images, true);

            // Add is_fav flag
            $pet->is_fav = $user ? $pet->isFavBy($user) : false;
        }

        // return $pets;

        return view('home', compact('pets'));
    }

    public function showPublicPetsPage()
    {
        $user = Auth::user(); // authenticated user
        $pets = Pet::where('status', 'available')->with(['category', 'breed'])->paginate(10);

        foreach ($pets as $pet) {
            $pet->images = json_decode($pet->images, true);

            // Add is_fav flag
            $pet->is_fav = $user ? $pet->isFavBy($user) : false;
        }

        return view('public.pet.index', compact('pets'));
    }
}

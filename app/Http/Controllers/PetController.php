<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Breed;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;

// Google Client Library များ import
use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDriveService;
use Google\Service\Drive\DriveFile;
use Google\Service\Drive\Permission;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Category နှင့် Breed relationship တွေ eager load ပြီး pagination
        $pets = Pet::with(['category', 'breed'])->paginate(10);
        return view('pet.index', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pet = new Pet();
        $categories = Category::all();
        $breeds = Breed::all();
        return view('pet.create', compact('pet', 'categories', 'breeds'));
    }

    public function store(StorePetRequest $request)
    {
        $data = $request->validated();

        $driveFileId = null;
        $shareableLink = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalName = $file->getClientOriginalName();
            $filename = time() . '_' . $originalName;

            $client = new GoogleClient();
            $client->setAuthConfig(storage_path('app/google-service-account.json'));
            $client->addScope(GoogleDriveService::DRIVE);
            $driveService = new GoogleDriveService($client);

            $fileMetadata = new DriveFile([
                'name'    => $filename,
                'parents' => [env('GOOGLE_DRIVE_FOLDER')],
            ]);

            $content = file_get_contents($file->getPathname());
            // $createdFile = $driveService->files->create(
            //     $fileMetadata,
            //     [
            //         'data'       => $content,
            //         'mimeType'   => $file->getMimeType(),
            //         'uploadType' => 'multipart',
            //         'fields'     => 'id, webViewLink',
            //     ]
            // );

            try {
                $createdFile = $driveService->files->create(
                    $fileMetadata,
                    [
                        'data'       => $content,
                        'mimeType'   => $file->getMimeType(),
                        'uploadType' => 'multipart',
                        'fields'     => 'id, webViewLink',
                    ]
                );
            } catch (\Exception $e) {
                dd('Google Drive Upload Error: ' . $e->getMessage());
            }


            $driveFileId = $createdFile->id;

            $permission = new Permission();
            $permission->setType('anyone');
            $permission->setRole('reader');
            $driveService->permissions->create($driveFileId, $permission);

            $shareableLink = $createdFile->getWebViewLink();

            $data['image'] = $shareableLink; // Set Google Drive link to image
        }

        // dd($data);

        Pet::create($data); // ✅ save to DB

        return redirect()->back()->with('success', 'Pet uploaded successfully!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        // single pet details ကိုပြမယ်
        return view('pet.show', compact('pet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        $categories = Category::all();
        $breeds     = Breed::where('category_id', $pet->category_id)->get();
        return view('pet.edit', compact('pet', 'categories', 'breeds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePetRequest $request, Pet $pet)
    {
        $data = $request->validated();

        $driveFileId   = $pet->image;   // ဧ။ျောကိုယ် Image ရှိသေးမလားစစ်
        $shareableLink = null;

        if ($request->hasFile('image')) {
            // ယခင်တင်ထားတဲ့ Drive file ကိုလိုလျှင် ဖျက်လို့ရသလို (optional)
            // ပြီးတော့ နောက်တစ်ခါ upload code ထည့်ပါ

            $file         = $request->file('image');
            $originalName = $file->getClientOriginalName();
            $filename     = time() . '_' . $originalName;

            $client = new GoogleClient();
            $client->setAuthConfig(storage_path('app/google-service-account.json'));
            $client->addScope(GoogleDriveService::DRIVE);
            $driveService = new GoogleDriveService($client);

            $fileMetadata = new DriveFile([
                'name'    => $filename,
                'parents' => [env('GOOGLE_DRIVE_FOLDER')],
            ]);

            $filePath = $file->getPathname();
            $content  = file_get_contents($filePath);

            $createdFile = $driveService->files->create(
                $fileMetadata,
                [
                    'data'       => $content,
                    'mimeType'   => $file->getMimeType(),
                    'uploadType' => 'multipart',
                    'fields'     => 'id, webViewLink'
                ]
            );
            $driveFileId = $createdFile->id;

            $permission = new Permission();
            $permission->setType('anyone');
            $permission->setRole('reader');
            $driveService->permissions->create($driveFileId, $permission);

            $shareableLink = $createdFile->getWebViewLink();
        }

        $pet->update([
            'name'         => $data['name'],
            'category_id'  => $data['category_id'],
            'breed_id'     => $data['breed_id'],
            'birth_date'   => $data['birth_date'] ?? null,
            'image'        => $driveFileId,
            'description'  => $data['description'] ?? null,
            'status'       => $data['status'],
        ]);

        return redirect()
            ->route('pets.index')
            ->with('success', 'Pet updated successfully!')
            ->with('shareableLink', $shareableLink);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        // optional: Google Drive မှာရှိတဲ့ ဖိုင်ကို delete လုပ်ချင်ရင် logic ထည့်နိုင်
        $pet->delete();
        return redirect()
            ->route('pets.index')
            ->with('success', 'Pet deleted successfully!');
    }

    /**
     * AJAX မှတဆင့် category ရဲ့ id ပေါ်မူတည်ပြီး breed များယူရန်
     */
    // public function getBreedsByCategory($id)
    // {
    //     $breeds = Breed::where('category_id', $id)->get();
    //     return response()->json($breeds);
    // }
    public function getBreedsByCategory($id)
    {
        $breeds = Breed::where('category_id', $id)->get(['id', 'name']);
        return response()->json($breeds);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use App\Http\Requests\StoreBreedRequest;
use App\Http\Requests\UpdateBreedRequest;
use App\Models\Category;

class BreedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $breeds = Breed::all();
        return view('breed.index', compact('breeds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('breed.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBreedRequest $request)
    {
        // return $request;
        $breed = new Breed();
        $breed->name = $request->name;
        $breed->category_id = $request->category_id;
        $breed->save();
        return redirect()->route('breeds.index')->with('success', 'Breed created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Breed $breed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Breed $breed)
    {
        $categories = Category::all();
        return view('breed.edit', compact('breed', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBreedRequest $request, Breed $breed)
    {
        // return $request;
        $breed->name = $request->name;
        $breed->category_id = $request->category_id;
        $breed->save();
        return redirect()->route('breeds.index')->with('success', 'Breed updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Breed $breed)
    {
        $breed->delete();
        return redirect()->route('breeds.index')->with('success', 'Breed deleted successfully');
    }
}

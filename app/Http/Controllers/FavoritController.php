<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritController extends Controller
{

    public function toggleFavorite(Pet $pet)
    {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }
        // return $user;
        if ($user->favorites()->where('pet_id', $pet->id)->exists()) {
            $user->favorites()->detach($pet->id); // unfavorite
        } else {
            $user->favorites()->attach($pet->id); // favorite
        }
        return back()->with('success', 'Pet favorite status updated successfully.');
    }

    public function showFavorites()
    {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }
        $favorites = $user->favorites()->with('category', 'breed')->paginate(10);
        foreach ($favorites as $pet) {
            $pet->images = json_decode($pet->images, true);
        }
        // return $favorites;
        return view('favorites.index', compact('favorites'));
    }

}

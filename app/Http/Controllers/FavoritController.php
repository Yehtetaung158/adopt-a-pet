<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritController extends Controller
{

    public function toggleFavorite(Pet $pet)
    {
        $AuthUser = Auth::user();
        if (!$AuthUser) {
            abort(403, 'Unauthorized');
        }
        $user = User::find($AuthUser->id);
        if ($user->favorites()->where('pet_id', $pet->id)->exists()) {
            $user->favorites()->detach($pet->id); // unfavorite
        } else {
            $user->favorites()->attach($pet->id); // favorite
        }
        return back()->with('success', 'Pet favorite status updated successfully.');
    }

    public function showFavorites()
    {
        $AuthUser = Auth::user();
        if (!$AuthUser) {
            abort(403, 'Unauthorized');
        }
        $user = User::find($AuthUser->id);
        $favorites = $user->favorites()->paginate(10);
        foreach ($favorites as $pet) {
            $pet->images = json_decode($pet->images, true);
            $pet->is_fav = $user ? $pet->isFavBy($user) : false;
        }
        // return $favorites;
        return view('favorites.index', compact('favorites'));
    }
}

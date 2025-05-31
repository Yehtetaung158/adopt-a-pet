<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            return response()->json(['message' => 'Profile not found.'], 404);
        }

        $profile->load('user');

        return response()->json([
            'success' => true,
            'data' => $profile
        ]);
    }
}

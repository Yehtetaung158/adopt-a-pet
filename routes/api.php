<?php

use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\BreedController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PetController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 🧪 Authenticated routes
Route::middleware('auth:sanctum')->prefix('dashboard')->group(function () {

    // Profile routes
    // Route::get('/profile', [ProfileController::class, 'edit']);        // GET profile data
    // Route::patch('/profile', [ProfileController::class, 'update']);    // Update profile
    // Route::delete('/profile', [ProfileController::class, 'destroy']);  // Delete profile
    Route::get('/profile/show', [ProfileController::class, 'show']);   // Show profile

    // Resource routes
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('breeds', BreedController::class);
    Route::apiResource('pets', PetController::class);
    Route::apiResource('orders', OrderController::class);

    // Custom endpoints
    Route::get('/breeds-by-category/{id}', [PetController::class, 'getBreedsByCategory']);

    Route::get('/breeds-by-name', function (Request $request) {
        $categoryName = $request->query('category_name');
        $category = App\Models\Category::where('name', $categoryName)->first();

        if (!$category) {
            return response()->json([]);
        }

        return response()->json($category->breeds()->select('name')->get());
    });
});

// 🔐 Admin-only routes
Route::middleware(['auth:sanctum', 'is_admin'])->prefix('dashboard/admin')->group(function () {
    Route::apiResource('users', UserController::class);
});

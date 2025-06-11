<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BreedController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');

    Route::resource('categories', CategoryController::class);
    Route::resource('breeds', BreedController::class);
    Route::resource('pets', PetController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('blogs', BlogController::class);

    Route::get('/breeds-by-category/{id}', [PetController::class, 'getBreedsByCategory']);

    Route::get('/breeds-by-name', function (Illuminate\Http\Request $request) {
        $categoryName = $request->query('category_name');
        $category = App\Models\Category::where('name', $categoryName)->first();

        if (!$category) {
            return response()->json([]);
        }

        return response()->json($category->breeds()->select('name')->get());
    });
});

Route::middleware(['auth', 'is_admin'])->prefix('dashboard/admin')->group(function () {
    Route::resource('users', UserController::class);
});

Route::get('/', [PetController::class, 'showPublicPets'])->name('home');
Route::get('/pets', [PetController::class, 'showPublicPetsPage'])->name('pets');
Route::get('/pets/{pet}', [PetController::class, 'showPublicPetsDetail'])->name('pets.detail');

Route::get('/blogs', [BlogController::class, 'showPublicBlogs'])->name('blogs');
Route::get('/blogs/{blog}', [BlogController::class, 'showPublicBlogsDetail'])->name('blogs.detail');
Route::get('/home-blogs',[BlogController::class, 'showPublicHomeBlogs'])->name('home.blogs');

Route::post('/pets/{pet}/order', [OrderController::class, 'store'])
    ->middleware('auth')
    ->name('pets.order');

Route::delete('/pets/{pet}/cancel', [OrderController::class, 'cancelOrder'])
    ->middleware('auth')
    ->name('pets.order.cancel');

Route::post('/pets/{pet}/favorite', [FavoritController::class, 'toggleFavorite'])
    ->middleware('auth')
    ->name('pets.favorite');

Route::get('/favorites', [FavoritController::class, 'showFavorites'])
    ->middleware('auth')
    ->name('favorites');

require __DIR__ . '/auth.php';

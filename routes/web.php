<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;


Route::get('/', [CardController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'home'])
    ->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.mainpage');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'updateinfo'])
        ->name('profile.info');
    Route::post('/profile/image', [ProfileController::class, 'updateimage'])
        ->name('profile.image');
    Route::post('/profile/profile', [ProfileController::class, 'updateprofile'])
        ->name('profile.profile');
});
Route::get('writerknow/{id}', [UserController::class, 'writerknow'])->name('writerknow');


Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');
Route::get('/Writers', [UserController::class, 'index'])->name('writers');
Route::get('/stories', [CardController::class, 'see_stories'])->middleware('verified')->name('stories');

Route::middleware('auth')->group(function () {
    Route::resource('Card', CardController::class);
});
Route::get('/listen/{Card}',[CardController::class,'listen'])->name('Card.listen');
Route::post('/cards/{card}/rate', [CardController::class, 'rate'])->name('cards.rate');

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::post('/cards/preview', [CardController::class, 'preview'])->name('cards.preview');


Route::get('/favorites', [UserController::class, 'favoritescard'])->name('cards.favorite');
Route::post('/favorites/toggle', [UserController::class, 'toggle'])->name('favorites.toggle');
require __DIR__ . '/Auth.php';

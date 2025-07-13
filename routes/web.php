<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;


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

    Route::get('/listen/{card}', [CardController::class, 'listen'])->name('Card.listen');
    Route::post('/cards/{card}/rate', [CardController::class, 'rate'])->name('cards.rate');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');

    Route::post('/cards/preview', [CardController::class, 'preview'])->name('cards.preview');


    Route::get('/favorites', [UserController::class, 'favoritescard'])->name('cards.favorite');
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');

    Route::post('/favorites/toggle', [UserController::class, 'toggle'])->name('favorites.toggle');
});
Route::middleware(['auth'])
    ->controller(AdminController::class)
    ->group(function () {
        Route::get('/admin', 'index')->name('admin.index');
        Route::get('/userscontrol/{id}', 'userController')->name('admin.userController');
        Route::get('/users', 'show')->name('user.show');
        Route::get('/users/{id}/stories', 'userstories')->name('user.hissotries');
        Route::get('/sotry/{id}', 'showstory')->name('admin.showstory');
        Route::get('/Reports', 'Reports')->name('admin.Reports');

        Route::put('/admin/{user}/role', 'role')->name('admin.role');
        Route::put('/card/{card}/approved', 'approved')->name('admin.approved');


    });
require __DIR__ . '/Auth.php';

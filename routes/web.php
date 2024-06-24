<?php

// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckCurrentUser;


///// authentication required routes ////

Route::middleware('auth')->group(function () {
    // articles routes
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    // comments routes
    Route::post('comments/store', [CommentController::class, 'store'])->name('comments.store');
});

/////////////////////////////////////////

Route::middleware(['CheckCurrentUser'])->group(function () {
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::patch('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}/delete', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

//////////// public routes ///////////////

//home page
Route::get('/', [Controller::class, 'index'])->name('home.index');
// article routes
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

/////////////////////////////////////////
require __DIR__ . '/auth.php';
    
    
    
    // Route::get('/dashboard', function () {
        //     return view('dashboard');
        // })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
// Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
// Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');        
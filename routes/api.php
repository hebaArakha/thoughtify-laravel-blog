<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ArticleController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Auth public routes
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

//Articles public routes
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{articleId}', [ArticleController::class, 'show']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::patch('/articles/{articleId}/update', [ArticleController::class, 'update']);
});

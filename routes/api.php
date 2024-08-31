<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ArticleController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Auth public routes
Route::post('/v1/login', [UserController::class, 'login']);
Route::post('/v1/register', [UserController::class, 'register']);

//Articles public routes
Route::get('/v1/articles', [ArticleController::class, 'index']);
Route::get('/v1/articles/{articleId}', [ArticleController::class, 'show']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/v1/logout', [UserController::class, 'logout']);
    Route::post('/v1/articles', [ArticleController::class, 'store']);
    Route::patch('/v1/articles/{articleId}/update', [ArticleController::class, 'update']);
});

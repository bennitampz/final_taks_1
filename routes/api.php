<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

// Public routes
Route::post("register", [ApiController::class, "register"]);
Route::post("login", [ApiController::class, "login"]);

// Protected routes
Route::middleware('auth:api')->group(function () {
    // User routes
    Route::get("profile", [ApiController::class, "profile"]);
    Route::get("logout", [ApiController::class, "logout"]);

    // Articles routes
    Route::get('articles', [ApiController::class, 'getAllArticles']);
    Route::get('articles/{id}', [ApiController::class, 'getArticle']);
    Route::post('articles', [ApiController::class, 'createArticle']);
    Route::put('articles/{id}', [ApiController::class, 'updateArticle']);
    Route::delete('articles/{id}', [ApiController::class, 'deleteArticle']);

    // Categories routes
    Route::get('categories', [ApiController::class, 'getAllCategories']);
    Route::get('categories/{id}', [ApiController::class, 'getCategory']);
    Route::post('categories', [ApiController::class, 'createCategory']);
    Route::put('categories/{id}', [ApiController::class, 'updateCategory']);
    Route::delete('categories/{id}', [ApiController::class, 'deleteCategory']);
});

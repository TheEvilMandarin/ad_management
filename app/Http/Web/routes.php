<?php

use App\Http\Controllers\HelloController;
use App\Http\Web\Controllers\HealthCheck;
use Illuminate\Support\Facades\Route;

Route::get('health', HealthCheck::class);

Route::get('/', [HelloController::class, 'show']);

// Маршруты для категорий
Route::prefix('api/v1')->namespace('App\Http\ApiV1\Modules\Categories\Controllers')->group(function () {
    Route::middleware(['simple-jwt', 'admin'])->group(function () {
        Route::apiResource('categories', 'CategoriesController')->except(['index', 'show']);
    });

    Route::apiResource('categories', 'CategoriesController')->only(['index', 'show']);
});

// Маршруты для объявлений
Route::prefix('api/v1')->namespace('App\Http\ApiV1\Modules\Advertisements\Controllers')->group(function () {
    Route::middleware(['simple-jwt', 'admin-or-owner'])->group(function () {
        Route::apiResource('advertisements', 'AdvertisementsController')->only(['update', 'destroy']);
    });

    Route::middleware(['simple-jwt'])->group(function () {
        Route::apiResource('advertisements', 'AdvertisementsController')->only(['store']);
    });

    Route::apiResource('advertisements', 'AdvertisementsController')->only(['index', 'show']);
});

// Маршруты для избранного
Route::prefix('api/v1')->namespace('App\Http\ApiV1\Modules\Favorites\Controllers')->group(function () {
    Route::middleware(['simple-jwt'])->group(function () {
        Route::apiResource('favorites', 'FavoritesController')->only(['index', 'store']);
    });

    Route::middleware(['simple-jwt', 'admin-or-owner-of-favorite'])->group(function () {
        Route::apiResource('favorites', 'FavoritesController')->only(['destroy']);
    });
});


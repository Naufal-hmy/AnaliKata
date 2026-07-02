<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Frontend View
Route::get('/', function () {
    return view('welcome');
});

// Sidebar Menus
Route::view('/cleaning', 'pages.cleaning');
Route::view('/eda', 'pages.eda');
Route::view('/insight', 'pages.insight');

// API Routes
Route::prefix('api/dashboard')->group(function () {
    Route::get('summary', [DashboardController::class, 'summary']);
    Route::get('distribution', [DashboardController::class, 'distribution']);
    Route::get('trend', [DashboardController::class, 'trend']);
    Route::get('wordcloud', [DashboardController::class, 'wordcloud']);
    Route::get('top-commenter', [DashboardController::class, 'topCommenter']);
    Route::get('top-phrase', [DashboardController::class, 'topPhrasePerDate']);
});

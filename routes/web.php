<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\YoutubeHighlightController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('youtube-highlights', YoutubeHighlightController::class);

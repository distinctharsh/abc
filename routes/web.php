<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\YoutubeHighlightController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about/{about}', [HomeController::class, 'showAbout'])->name('about.show');
Route::get('/section/{section}', [HomeController::class, 'showSection'])->name('section.show');
Route::get('/section/{section}/{item}', [HomeController::class, 'showSectionItem'])->name('section.item');
Route::resource('youtube-highlights', YoutubeHighlightController::class);

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->remember)) {
        $request->session()->regenerate();
        return redirect()->intended(route('admin.abouts.index'));
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
})->name('login.submit');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Admin Routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::resource('abouts', AdminAboutController::class);
    });

<?php
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\YoutubeHighlightController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
use Illuminate\Support\Facades\File;


Route::get('/gallery', function (Request $request) {
    $pressPath = public_path('images/gallery');
    $items = [];

    if (File::exists($pressPath)) {
        $files = File::files($pressPath);
        foreach ($files as $file) {
            $items[] = [
                'src'      => 'images/gallery/' . $file->getFilename(),
                'title'    => pathinfo($file->getFilename(), PATHINFO_FILENAME),
                'category' => 'gallery',
                'date'     => date('Y-m-d', $file->getMTime()),
            ];
        }
    }

    // paginate so view->hasPages() works
    $perPage = 12;
    $page = LengthAwarePaginator::resolveCurrentPage();
    $collection = collect($items);
    $currentPageItems = $collection->slice(($page - 1) * $perPage, $perPage)->values();
    $paginator = new LengthAwarePaginator($currentPageItems, $collection->count(), $perPage, $page, [
        'path' => LengthAwarePaginator::resolveCurrentPath(),
    ]);

    return view('gallery', ['images' => $paginator]);
})->name('gallery');



Route::get('/press', function () {
    return view('press');
})->name('press');
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

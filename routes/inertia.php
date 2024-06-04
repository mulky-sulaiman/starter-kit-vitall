<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Index');
})->name('home');

// Route::get('/{any}', function (Request $request) {
//     app()->setLocale($request->cookie('site_language') ?: 'id');
//     return view('index');
// })->where('any', '.*');

Route::post('/locale', function () {
    // Validate
    $validated = request()->validate([
        'language' => 'required|string|in:en,id',
    ]);
    // Put Locale into Session
    session()->put('locale', $validated['language']);
    // Response for force reload the locale
    return Inertia::location(url()->previous());
})->name('set.language');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('permission', PermissionController::class)->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';

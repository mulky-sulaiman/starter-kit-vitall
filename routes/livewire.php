<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('home', '/')->name('home');



Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');
    Route::post('logout', LogoutController::class)
        ->name('logout');
});

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
    return redirect()->intended(url()->previous());
})->name('set.language');

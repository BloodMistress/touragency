<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Tour;
use App\Http\Controllers\TourController;
use App\Http\Controllers\CartController;
Route::get('/', function () {
    return view('tours');
});

Route::get('/dashboard', function () {
    $tours = \App\Models\Tour::all();
    return view('dashboard', compact('tours'));
})->middleware(['auth'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

// Route::get('/tours', function () {
//     $tours = Tour::all(); 
//     return view('tours', compact('tours')); 
// })->middleware(['auth'])->name('tours');

Route::get('/tours', [TourController::class, 'index'])->middleware(['auth'])->name('tours');


Route::get('/tours/{id}', [TourController::class, 'show'])->name('tours.show');
Route::post('/tours/{id}/buy', [TourController::class, 'buy'])->name('tours.buy');





Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

require __DIR__.'/auth.php';

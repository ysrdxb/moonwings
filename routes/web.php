<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\FlightSearchResults;

Livewire::setScriptRoute(function($handle) {
    return Route::get('/moonwingx/public/livewire/livewire.js', $handle);
});

Livewire::setUpdateRoute(function($handle) {
    return Route::get('/moonwingx/public/livewire/update', $handle);
});

Route::get('/', Home::class)->name('home');

Route::get('/flight-search-results/{origin}/{destination}/{departureDate}', FlightSearchResults::class)
    ->name('flight.search.results');
Route::get('/flight-booking/{id}', \App\Livewire\FlightBooking::class)->name('flight-booking');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

require __DIR__.'/admin.php';

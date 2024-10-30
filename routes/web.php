<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware([\App\Http\Middleware\GoogleRecaptcha::class])->group(function(){
    Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');
    Route::post('contact_form', [\App\Http\Controllers\IndexController::class, 'index'])->name('contact_form');
});

Route::prefix("news")->middleware([\App\Http\Middleware\GoogleRecaptcha::class])->group(function(){
    Route::post('{id}', [\App\Http\Controllers\IndexController::class, 'index'])->name('post');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

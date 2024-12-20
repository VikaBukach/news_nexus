<?php

use Illuminate\Support\Facades\Route;


//Route::middleware([\App\Http\Middleware\GoogleRecaptcha::class])->group(function(){
//    Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');
//});

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');
Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

Route::middleware("auth")->group(function (){
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::post('/posts/comment/{id}', [\App\Http\Controllers\PostController::class, 'comment'])->name('comment');
});

Route::middleware("guest")->group(function (){
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login_process', [\App\Http\Controllers\AuthController::class, 'login'])->name('login_process');

    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_process', [\App\Http\Controllers\AuthController::class, 'register'])->name('register_process');

    Route::get('/forgot', [\App\Http\Controllers\AuthController::class, 'showForgotForm'])->name('forgot');
    Route::post('/forgot_process', [\App\Http\Controllers\AuthController::class, 'forgot'])->name('forgot_process');


});

Route::get('/contacts', [\App\Http\Controllers\IndexController::class, 'showContactForm'])->name('contacts');
Route::post('/contact_form_process', [\App\Http\Controllers\IndexController::class, 'contactForm'])->name('contact_form_process');


// Routes for admin`s:

// Гостьові маршрути для адміністраторів (без авторизації)
Route::middleware('guest')
    ->prefix('admin')
    ->name('admin.')
    ->group(function() {

        Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'index'])->name('login');
        Route::post('/login_process', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login_process');
    });

//# Маршрути для аутентифікації (без middleware)
//Route::get('admin/login', [\App\Http\Controllers\Admin\AuthController::class, 'index'])->name('admin.login');
//Route::post('admin/login_process', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login_process');


# Група маршрутів для адміністратора з middleware
Route::middleware(['auth:admin', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
        // Ресурсний маршрут для постів
        Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);

    });








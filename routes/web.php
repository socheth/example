<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('jobs', JobController::class);

    Route::controller(PostController::class)->group(function () {
        Route::get('/posts', 'index')->name('posts.index');
        Route::get('/posts/create', 'create')->name('posts.create');
        Route::get('/posts/{slug}', 'showBySlug')->name('posts.slug');
        Route::get('/posts/{post}', 'show')->name('posts.show');
        Route::post('/posts', 'store')->name('posts.store');
        Route::get('/posts/{post}/edit', 'edit')->name('posts.edit');
        Route::put('/posts/{post}', 'update')->name('posts.update');
        Route::delete('/posts/{post}', 'destroy')->name('posts.destroy');
    });

});

require __DIR__ . '/auth.php';
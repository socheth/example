<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ProfileController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::resource('jobs', App\Http\Controllers\JobController::class)->only(['index', 'show']);
Route::resource('posts', App\Http\Controllers\PostController::class)->only(['index', 'show']);
Route::resource('companies', App\Http\Controllers\CompanyController::class)->only(['index', 'show']);

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('index');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('jobs', JobController::class);
    Route::resource('companies', CompanyController::class);

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

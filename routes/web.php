<?php

use App\Models\Job;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['users' => User::latest('id')->get()]);
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/jobs', function () {
    return view('jobs', ['jobs' => Job::latest('id')->paginate(10)]);
})->name('jobs');

Route::get('/jobs/{id}', function ($id) {
    return view('job', ['job' => Job::find($id)]);
})->name('job');

Route::get('/posts', function () {
    return view('posts', ['posts' => Post::latest('id')->cursorPaginate(10)]);
    // $user = User::all()->random();
    // return view('posts', ['posts' => $user->posts()->latest('id')->get()]);
})->name('posts');

Route::get('/posts/{id}', function ($id) {
    $post = Post::find($id);
    return view('post', ['post' => $post]);
})->name('post');
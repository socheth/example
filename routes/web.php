<?php

use App\Models\Job;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
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
    return view('jobs.index', ['jobs' => Job::latest('id')->paginate(10)]);
})->name('jobs');

Route::get('/jobs/create', function () {
    return view('jobs.create');
})->name('job.create');

Route::post('/jobs', function (Request $request) {
    $data = array_merge($request->all(), ['user_id' => User::all()->random()->id]);
    Job::create($data);
    return redirect('/jobs');
})->name('job.store');

Route::get('/jobs/{id}', function ($id) {
    return view('jobs.show', ['job' => Job::find($id)]);
})->name('job');

Route::get('/posts', function () {
    return view('posts.index', ['posts' => Post::latest('id')->simplePaginate(10)]);
    // $user = User::all()->random();
    // return view('posts', ['posts' => $user->posts()->latest('id')->get()]);
})->name('posts');

Route::get('/posts/create', function () {
    return view('posts.create');
})->name('post.create');

Route::get('/posts/{id}', function ($id) {
    $post = Post::find($id);
    return view('posts.show', ['post' => $post]);
})->name('post');
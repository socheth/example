<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', ['posts' => auth()->user()->posts()->latest('id')->simplePaginate(10)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if ($post->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('posts.show', ['post' => $post]);
    }

    public function showBySlug(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        if ($post->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('posts.show', ['post' => $post]);
    }

}
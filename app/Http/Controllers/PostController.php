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
        return view('posts.index', ['posts' => Post::query()->latest('id')->paginate(10)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function showBySlug(string $slug, int $id)
    {
        $post = Post::query()->findOrFail($id);

        return view('posts.show', ['post' => $post]);
    }

}
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request = request()->validate([
            'title' => ['required', 'max:255'],
            'body' => 'required',
            'category' => 'required',
            'image' => 'nullable:image',
        ]);

        if (request('image')) {
            $request['image'] = request('image')->store('posts', 'public');
            $request['image'] = asset('storage/' . $request['image']);
        }

        $request['slug'] = Str::slug(request('title'));

        auth()->user()->posts()->create($request);

        session()->flash('message', 'Your post has been created!');

        return redirect('/posts');
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->user()->id) {
            abort(403);
        }

        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => 'required',
            'category' => 'required',
            'image' => 'nullable:image',
        ]);

        if (isset($request['image'])) {
            $post->image = request()->file('image')->store('posts', 'public');
            $post->image = asset('storage/' . $post->image);
        }

        $post->title = request('title');
        $post->body = request('body');
        $post->category = request('category');
        $post->slug = Str::slug(request('title'));
        $post->save();

        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->user()->id) {
            abort(403);
        }

        $post->delete();
        return redirect('/posts');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index', ['posts' => auth()->user()->posts()->latest('id')->simplePaginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
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

        return to_route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if ($post->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('admin.posts.show', ['post' => $post]);
    }

    public function showBySlug(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        if ($post->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('admin.posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('admin.posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->user()->id) {
            abort(403);
        }

        $request = request()->validate([
            'title' => ['required', 'max:255'],
            'body' => 'required',
            'category' => 'required',
            'image' => 'nullable:image',
        ]);

        if (isset($request['image'])) {
            $request['image'] = request('image')->store('posts', 'public');
            $request['image'] = asset('storage/' . $request['image']);
        }

        $request['slug'] = Str::slug(request('title'));

        $post->update($request);

        session()->flash('message', 'Your post has been updated!');

        return to_route('admin.posts.index');
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

        session()->flash('message', 'Your post has been deleted!');

        return to_route('admin.posts.index');
    }
}
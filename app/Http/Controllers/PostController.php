<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Number;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', ['posts' => Post::latest('id')->simplePaginate(10)]);
        // $user = User::all()->random();
        // return view('posts', ['posts' => $user->posts()->latest('id')->get()]);
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
        }

        $request['slug'] = Str::slug(request('title'));
        $request['user_id'] = random_int(1, 10);
        Post::create($request);
        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => 'required',
            'category' => 'required',
            'image' => 'nullable:image',
        ]);

        if (isset($request['image'])) {
            $post->image = request()->file('image')->store('posts', 'public');
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
        $post->delete();
        return redirect('/posts');
    }
}
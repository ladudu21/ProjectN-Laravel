<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        $validated['total_like'] = 0;
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);

        if (is_null($validated['published_at'])){
            $validated['published_at'] = now();
        }
        else $validated['status'] = 0;

        if ($request->hasFile('thumb')) {
            $path = 'storage/' . $request->file('thumb')->store('thumbnails', 'public');
            $validated['thumb'] = $path;
        }
        else $validated['thumb'] = '/assets/noimg';

        Post::create($validated);

        return back()->with('message', 'Success!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $validated = $request->validated();

        if ($request->hasFile('thumb')) {
            $path = 'storage/' . $request->file('thumb')->store('thumbnails', 'public');
            $validated['thumb'] = $path;
        }

        $post->update($validated);

        return back()->with('message', 'Success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $path = str_replace('storage/', 'public/', $post->thumb);

        Storage::delete($path);
        $post->delete();

        return back()->with('message', 'Deleted');
    }
}
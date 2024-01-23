<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'posts' => Auth::guard('admin')->user()->posts()->paginate(10)
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

        $validated['author_id'] = Auth::guard('admin')->user()->id;
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);

        if (is_null($validated['published_at'])) {
            $validated['published_at'] = now();
        } else
            $validated['status'] = 0;

        if ($request->hasFile('thumb')) {
            $path = $request->file('thumb')->store('thumbnails');

            $validated['thumb'] = $path;
        } else $validated['thumb'] = 'noimg.jpg';

        DB::beginTransaction();

        try {
            $post = Post::create($validated);

            if (!is_null($validated['tags'])) {
                $tags = explode(" ", $validated['tags']);
                foreach ($tags as $tag_name) {
                    $tag = Tag::firstOrCreate([
                        'name' => $tag_name
                    ]);

                    $post->tags()->attach($tag->id);
                }
            }

        } catch (Exception $e) {
            DB::rollback();

            return back()->with('message', 'Fail');
        }

        DB::commit();

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
            $path = $request->file('thumb')->store('thumbnails');
            $validated['thumb'] = $path;
        }

        if ($request->input('delete_image') == 1) {
            $validated['thumb'] = 'noimg.jpg';
        }

        DB::beginTransaction();

        try {
            $post->update($validated);

            if (!is_null($validated['tags'])) {
                $tags = explode(" ", $validated['tags']);
                $tagList= array();

                foreach ($tags as $tag_name) {
                    $tag = Tag::firstOrCreate([
                        'name' => $tag_name
                    ]);
                    $tagList[] = $tag->id;
                }

                $post->tags()->sync($tagList);
            }
            else $post->tags()->detach();

        } catch (Exception $e) {
            DB::rollback();

            return back()->with('message', 'Fail');
        }

        DB::commit();

        return back()->with('message', 'Success!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('message', 'Deleted');
    }
}

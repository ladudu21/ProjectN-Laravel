<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WriterController extends Controller
{
    public function __construct()
    {
        $this->middleware('post-access')->only('edit', 'update', 'destroy');
    }
    public function index()
    {
        return view('writer.list-posts', [
            'posts' => Auth::user()->posts()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('writer.create-post', [
            'categories' => Category::all()
        ]);
    }

    public function edit(Post $post)
    {
        return view('writer.edit-post', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    public function show(Post $post)
    {
        return view('post', [
            'post' => $post,
        ]);
    }
}

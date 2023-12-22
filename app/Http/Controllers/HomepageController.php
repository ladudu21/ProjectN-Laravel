<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'posts' => Post::published()->paginate(10)
        ]);
    }

    function showPost(Post $post) {
        return view('post', [
            'post' => $post,
        ]);
    }
}

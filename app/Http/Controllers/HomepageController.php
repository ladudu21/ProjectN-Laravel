<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('search')) {
            $search = $request->input('search');
            $post = Post::where('title', 'like', '%' . $search . '%')
                ->orWhereHas('user', function (Builder $query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('category', function (Builder $query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->paginate(10);
        } else {
            $post = Post::published()->paginate(10);
        }

        return view('welcome', [
            'posts' => $post
        ]);
    }

    function showPost(Post $post)
    {
        return view('post', [
            'post' => $post,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomepageController extends Controller
{
    public function index(Request $request)
    {
        $post = Post::filter($request->all())->paginate(config('const.admin.paginate'))->withQueryString();

        return view('welcome', [
            'posts' => $post,
            'categories' => Category::all(),
        ]);
    }

    function showPost(Post $post)
    {
        return view('post', [
            'post' => $post,
        ]);
    }

    function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }
}

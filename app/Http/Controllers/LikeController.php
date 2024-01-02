<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $like = $this->getLike($request)->first();
        $message = '';

        if ($like) {
            $this->getLike($request)->delete();
            $message = 'unlike';

        } else {
            $like_trashed = $this->getLike($request)->onlyTrashed()->first();

            if ($like_trashed) {
                $this->getLike($request)->onlyTrashed()->restore();
            } else {
                Like::create([
                    'post_id' => $request->post_id,
                    'user_id' => Auth::user()->id
                ]);
            }

            $message = 'like';
        }

        return response()->json([
            'message' => $message,
        ]);
    }

    function getLike(Request $request)
    {
        return $like = Like::where('post_id', $request->post_id)
            ->where('user_id', Auth::user()->id);
    }
}

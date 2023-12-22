<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $like = $this->getLike($request)->first();

        if ($like) {
            $this->getLike($request)->delete();
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
        }

        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
    }

    function getLike(Request $request)
    {
        return $like = Like::where('post_id', $request->post_id)
            ->where('user_id', Auth::user()->id);
    }
}

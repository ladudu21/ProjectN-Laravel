<?php

namespace App\Observers;

use App\Http\Controllers\LikeController;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        $comments = $post->comments->pluck('id')->toArray();
        Comment::destroy($comments);

        $likes = $post->likes->pluck('user_id')->toArray();
        Like::whereIn('user_id', $likes)->delete();
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}

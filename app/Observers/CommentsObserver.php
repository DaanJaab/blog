<?php

namespace App\Observers;

use App\Models\Comment;

class CommentsObserver
{
    /**
     * Handle the Comment "created" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function creating(Comment $comment)
    {
        $comment->user_id = auth()->user()->id;
        $comment->post_id = request()->post->id;
    }

    /**
     * Handle the Comment "created" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "updated" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function updated(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "saved (created&updated)" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function saved(Comment $comment)
    {
        $user = auth()->user();
        $user->last_action_time = now()->toDateTimeString();
        $user->save();
    }

    /**
     * Handle the Comment "deleted" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function deleted(Comment $comment)
    {
        $user = auth()->user();
        $user->last_action_time = now()->toDateTimeString();
        $user->save();
    }

    /**
     * Handle the Comment "restored" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function restored(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "force deleted" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function forceDeleted(Comment $comment)
    {
        $user = auth()->user();
        $user->last_action_time = now()->toDateTimeString();
        $user->save();
    }
}

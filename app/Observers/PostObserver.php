<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\UserPublicInfo;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        $post->post_activity()->create([]);


        /**
         * Increse Posts count of the user who posts this post
         */
        $userActivity = UserPublicInfo::where('user_id', $post->user_id)->first()->activity;
        $userActivity->increasePosts();
        
    }

    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        $userActivity = UserPublicInfo::where('user_id', $post->user_id)->first()->activity;
        $userActivity->decresePosts();
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        $userActivity = UserPublicInfo::where('user_id', $post->user_id)->first()->activity;
        $userActivity->decresePosts();
    }
}

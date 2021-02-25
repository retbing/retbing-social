<?php

namespace App\Observers;

use App\Models\Follow;
use App\Models\UserPublicInfo;

class FollowObserver
{
    /**
     * Handle the Follow "created" event.
     *
     * @param  \App\Models\Follow  $follow
     * @return void
     */
    public function created(Follow $follow)
    {
        /* Increase the follower count of followed user */
        $followed_user = UserPublicInfo::where('user_id', $follow->following_id)->first();
        $followed_user->activity->increaseFollowers();
        
        
        /* Increase the following count of follower user */
        $follower_user = UserPublicInfo::where('user_id', $follow->follower_id)->first();
        $follower_user->activity->increaseFollowings();
    }


    /**
     * Handle the Follow "updated" event.
     *
     * @param  \App\Models\Follow  $follow
     * @return void
     */
    public function updated(Follow $follow)
    {
        //
    }

    /**
     * Handle the Follow "deleted" event.
     *
     * @param  \App\Models\Follow  $follow
     * @return void
     */
    public function deleted(Follow $follow)
    {
        /* Decrease the follower count of followed user */
        $followed_user = UserPublicInfo::where('user_id', $follow->following_id)->first();
        $followed_user->activity->decreaseFollowers();
                
        /* Decrease the following count of follower user */
        $follower_user = UserPublicInfo::where('user_id', $follow->follower_id)->first();
        $follower_user->activity->decreaseFollowings();
    }

    /**
     * Handle the Follow "restored" event.
     *
     * @param  \App\Models\Follow  $follow
     * @return void
     */
    public function restored(Follow $follow)
    {
        //
    }

    /**
     * Handle the Follow "force deleted" event.
     *
     * @param  \App\Models\Follow  $follow
     * @return void
     */
    public function forceDeleted(Follow $follow)
    {
        //
    }
}
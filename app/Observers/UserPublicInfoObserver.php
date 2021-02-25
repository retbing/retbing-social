<?php

namespace App\Observers;

use App\Models\UserActivity;
use App\Models\UserPublicInfo;

class UserPublicInfoObserver
{
    /**
     * Handle the UserPublicInfo "created" event.
     *
     * @param  \App\Models\UserPublicInfo  $userPublicInfo
     * @return void
     */
    public function created(UserPublicInfo $userPublicInfo)
    {
        $userPublicInfo->activity()->create([]);
        $userPublicInfo->activity->save();
    }

    /**
     * Handle the UserPublicInfo "updated" event.
     *
     * @param  \App\Models\UserPublicInfo  $userPublicInfo
     * @return void
     */
    public function updated(UserPublicInfo $userPublicInfo)
    {
        //
    }

    /**
     * Handle the UserPublicInfo "deleted" event.
     *
     * @param  \App\Models\UserPublicInfo  $userPublicInfo
     * @return void
     */
    public function deleted(UserPublicInfo $userPublicInfo)
    {
        //
    }

    /**
     * Handle the UserPublicInfo "restored" event.
     *
     * @param  \App\Models\UserPublicInfo  $userPublicInfo
     * @return void
     */
    public function restored(UserPublicInfo $userPublicInfo)
    {
        //
    }

    /**
     * Handle the UserPublicInfo "force deleted" event.
     *
     * @param  \App\Models\UserPublicInfo  $userPublicInfo
     * @return void
     */
    public function forceDeleted(UserPublicInfo $userPublicInfo)
    {
        //
    }
}
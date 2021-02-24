<?php

namespace App\Providers;

use App\Models\Follow;
use App\Models\UserPublicInfo;
use App\Observers\FollowObserver;
use App\Observers\UserPublicInfoObserver;
use Illuminate\Support\ServiceProvider;

use App\Services\Concrete\LocalUpload;
use App\Services\Upload;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Upload::class, function () {
            return new LocalUpload();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Follow::observe(FollowObserver::class);
        UserPublicInfo::observe(UserPublicInfoObserver::class);
    }
}
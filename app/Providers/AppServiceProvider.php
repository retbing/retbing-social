<?php

namespace App\Providers;

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
        $this->app->singleton(Upload::class, function ($app) {
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
        //
    }
}
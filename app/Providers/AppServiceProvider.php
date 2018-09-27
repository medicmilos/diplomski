<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\AnonymousLikable;
use Illuminate\Support\Facades\App;
use App\Http\GalleryServiceInstance;
use App\Models\GalleryItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        new class($this->app, "Gallery") extends GalleryServiceInstance{
            public function onServiceDeterminedCallback()
            {
                GalleryItem::setLikeImplementation(new AnonymousLikable());
            }
        };
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

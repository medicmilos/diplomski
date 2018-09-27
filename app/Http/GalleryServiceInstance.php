<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/27/2018
 * Time: 10:23 PM
 */

namespace App\Http;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\GalleryItem;
use App\Models\GalleryItemLike;
use App\Http\Traits\OneTimeLikable;



class GalleryServiceInstance extends ServiceProvider
{
    protected $galleryController = 'GalleryApi';

    protected $type = 'gallery';

    public function onServiceDeterminedCallback()
    {
        GalleryItem::setLikeImplementation(new OneTimeLikable());
    }
}

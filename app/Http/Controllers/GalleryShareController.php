<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 10/20/2018
 * Time: 10:42 PM
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class GalleryShareController extends Controller
{
    public function index($modelId = null)
    {
        return redirect("http://diplomski.milosmedic.com/public/gallery/item/show/$modelId");
    }
}

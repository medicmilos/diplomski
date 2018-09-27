<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/25/2018
 * Time: 10:10 PM
 */

namespace App\Http\Traits;

use App\Models\GalleryItem;


interface LikeableInterface
{
    public function checkCycle(GalleryItem $item);

    public function addLike(GalleryItem $item);

    public function getCanLikeAttribute(GalleryItem $item);

    public function getLikeCountAttribute(GalleryItem $item);

    public function getLikesTable();
}

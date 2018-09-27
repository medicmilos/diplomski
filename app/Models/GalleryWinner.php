<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/25/2018
 * Time: 10:48 PM
 */

namespace App\Models;


use App\Models\GalleryModel;

class GalleryWinner extends GalleryModel
{

    protected $table = 'gallery_winners';

    public function getCreatedAtAttribute(){
        $galleryItem = GalleryItem::find($this->item_id);
        if($galleryItem){
            return $galleryItem->created_at;
        }
        return $this->created_at;
    }

}

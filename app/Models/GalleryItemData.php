<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/25/2018
 * Time: 10:45 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItemData extends Model
{
    protected $table = 'gallery_item_data';

    protected $guarded = ['id'];

    protected $primaryKey = 'item_id';

    public $timestamps = true;

    public function item()
    {
        return $this->belongsTo('App\Models\GalleryItem', 'item_id', 'id');
    }
}

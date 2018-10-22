<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/25/2018
 * Time: 10:47 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItemLike extends Model
{
    protected $table = 'gallery_likes';
    protected $primaryKey = "post_id";
}

<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/25/2018
 * Time: 10:11 PM
 */

namespace App\Models;

use Illuminate\Support\Traits\Macroable;
use PHPUnit\Framework\MockObject\Stub;
use App\Models\UserInputModel;
use App\Http\Traits\TimezonedTimestampsTrait;
use App\Http\Traits\Approvable;
use App\Http\Traits\LikeableInterface;


class GalleryItem extends UserInputModel
{
    /**
     * @var LikeableInterface
     */
    private static $likeImplementation = null;

    protected $table = 'gallery_items';

    use Approvable;
    //use CrudTrait;
    use TimezonedTimestampsTrait;


    protected $fillable = [
        'user_id',
        'cycle_id',
        'approved'
    ];

    protected $appends = ['canLike', 'likeCount', 'imageUrl'];


    public static function setLikeImplementation($likeImpl){
        if($likeImpl instanceof LikeableInterface) {
            static::$likeImplementation = $likeImpl;
            return true;
        } else {
            return false;
        }
    }

    public function likes()
    {
        return $this->hasMany('App\Models\GalleryItemLike', 'item_id', 'id');
    }

    public function item_data()
    {
        return $this->hasOne('App\Models\GalleryItemData', 'item_id', 'id');
    }

    public function getImageUrlAttribute()
    {
        return [
            'upload' => url('storage/gallery/uploads/'.optional($this->item_data)->photo),
            'preview' => url('storage/gallery/preview/' . optional($this->item_data)->photo),
            'thumb' => url('storage/gallery/thumbs/' . optional($this->item_data)->photo),
        ];
    }


    public function checkCycle(): bool
    {
        if(static::$likeImplementation != null) {
            return static::$likeImplementation->checkCycle($this);
        }
        return false;
    }

    public function addLike(): array
    {
        if(static::$likeImplementation != null) {
            return static::$likeImplementation->addLike($this);
        }
        return [];
    }

    public function getCanLikeAttribute(): bool
    {
        if(static::$likeImplementation != null) {
            return static::$likeImplementation->getCanLikeAttribute($this);
        }
        return false;
    }

    public function getLikeCountAttribute(): int
    {
        if(static::$likeImplementation != null) {
            return static::$likeImplementation->getLikeCountAttribute($this);
        }
        return 0;
    }

    public function getLikesTable()
    {
        if(static::$likeImplementation != null) {
            return static::$likeImplementation->getLikesTable();
        }
        return 'gallery_likes';
    }
}

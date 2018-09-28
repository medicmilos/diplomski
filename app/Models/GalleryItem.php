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
use App\Models\GalleryModel;
use App\Http\Traits\TimezonedTimestampsTrait;
use App\Http\Traits\Approvable;
use App\Http\Traits\Likeable;


class GalleryItem extends UserInputModel
{
    /**
     * @var Likeable
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $table = 'gallery_items';

    use Approvable;
    use Likeable;
    use TimezonedTimestampsTrait;

    protected $fillable = [
        'user_id',
        'cycle_id',
        'approved'
    ];

    protected $appends = ['canLike', 'likeCount', 'imageUrl'];
    public $timestamps = true;
    protected $guarded = ['id'];

    public function likes()
    {
        return $this->hasMany('App\Models\GalleryItemLike', 'item_id', 'id');
    }

    public function item_data()
    {
        return $this->hasOne('App\Models\GalleryItemData', 'item_id', 'id');
    }

    public function cycle()
    {
        return $this->hasOne('App\Models\Cycle', 'id', 'cycle_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function getImageUrlAttribute()
    {
        return [
            'upload' => url('storage/gallery/uploads/' . optional($this->item_data)->photo),
            'preview' => url('storage/gallery/preview/' . optional($this->item_data)->photo),
            'thumb' => url('storage/gallery/thumbs/' . optional($this->item_data)->photo),
        ];
    }

    public function getIsWinnerAttribute()
    {
        return GalleryWinner::where('item_id', $this->id)->where('approved', 1)->first() ? true : false;
    }
}
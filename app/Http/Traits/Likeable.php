<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/28/2018
 * Time: 1:23 PM
 */

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use App\Models\GalleryItemLike;
use App\Http\Traits\StubLikeableTrait;
use App\Models\GalleryItem;

trait Likeable
{
    use StubLikeableTrait;

    /**
     * Likeable constructor.
     */
    public function __construct()
    {
        $this->setAppends(array_merge($this->appends, ['userLikeCount']));
    }


    public function checkCycle()
    {
        return true;
    }

    public function getUniqueId()
    {
        $uniqueId = session('unique_id');
        if (!$uniqueId) {
            $uniqueId = uniqid();
            session(['unique_id' => $uniqueId]);
        }
        return $uniqueId;
    }

    public function addLike()
    {
        if(!$this->checkCycle()) return [];
        try {
            $ip = $_SERVER['REMOTE_ADDR'];
            $like = new GalleryItemLike();
            $like->unique_id = $this->getUniqueId();
            $like->item_id = $this->id;
            $like->ip_address = $ip;
            $like->date_liked = date('Y-m-d');

            if ($like->save()) {
                return $like;
            } else {
                return [];
            }
        } catch (\Exception $e){
            return [];
        }
    }

    public function getCanLikeAttribute()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $uniqueId = $this->getUniqueId();
        $itemId = $this->id;
        $dateLiked = Date::parse(date('Y-m-d'))->timezone(config('settings.appTimezone'));

        $query = DB::select(DB::raw("SELECT COUNT(*) as like_count FROM " . $this->likesTable . " WHERE (item_id = ? AND date_liked = ? AND unique_id = ?) OR (item_id = ? AND date_liked = ? AND ip_address = ?)"),
            [$itemId, $dateLiked, $uniqueId, $itemId, $dateLiked, $ip]
        );
        $count = $query[0]->like_count;
        return $count == 0 ? true : false;
    }

    public function getUserLikeCountAttribute()
    {
        $itemId = $this->id;
        $dateLiked = Date::parse(date('Y-m-d'))->timezone(config('settings.appTimezone'));
        $ip = $_SERVER['REMOTE_ADDR'];
        $query = DB::select(DB::raw("SELECT COUNT(*) as like_count FROM " . $this->likesTable . " WHERE (item_id = ? AND date_liked = ? AND unique_id = ?) OR (item_id = ? AND date_liked = ? AND ip_address = ?)"), [$itemId, $dateLiked, $this->getUniqueId(), $itemId, $dateLiked, $ip]);
        $count = $query[0]->like_count;
        return $count == 0 ? true : false;
    }

    public function getLikeCountAttribute()
    {
        $itemId = $this->id;
        $query = DB::select(DB::raw("SELECT COUNT(*) as like_count FROM " . $this->likesTable . " WHERE item_id = ?"), [$itemId]);
        $count = $query[0]->like_count;
        return $count == 0 ? true : false;
    }
}
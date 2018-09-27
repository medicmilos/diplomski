<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/27/2018
 * Time: 10:09 PM
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
use App\Models\GalleryItem;
use App\Models\GalleryItemLike;
use App\Http\Traits\LikeableInterface;

class AnonymousLikable implements LikeableInterface
{

    public function checkCycle(GalleryItem $item)
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

    public function addLike(GalleryItem $item)
    {
        try {
            if($item->getCanLikeAttribute()) {

                $ip = $_SERVER['REMOTE_ADDR'];
                $like = new GalleryItemLike();
                $like->unique_id = $this->getUniqueId();
                $like->item_id = $item->id;
                $like->ip_address = $ip;
                $like->date_liked = Date::parse(date('Y-m-d'))->timezone(config('settings.appTimezone'));
                $like->save();
                return [
                    'item_id' => $this->getUniqueId(),
                ];
            } else {
                return [];
            }
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getCanLikeAttribute(GalleryItem $item)
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $uniqueId = $this->getUniqueId();
        $itemId = $item->id;
        $dateLiked = Date::parse(date('Y-m-d'))->timezone(config('settings.appTimezone'));

        $query = DB::select(DB::raw("SELECT COUNT(*) as like_count FROM " . $this->getLikesTable() . " WHERE (item_id = ? AND date_liked = ? AND unique_id = ?) OR (item_id = ? AND date_liked = ? AND ip_address = ?)"),
            [$itemId, $dateLiked, $uniqueId, $itemId, $dateLiked, $ip]
        );
        $count = $query[0]->like_count;
        return $count == 0 ? true : false;
    }


    public function getLikeCountAttribute(GalleryItem $item)
    {
        $itemId = $item->id;
        $query = DB::select(DB::raw("SELECT COUNT(*) as count FROM " . $this->getLikesTable() . " WHERE item_id = ?"), [$itemId]);
        $count = $query[0]->count;
        return (int)$count;
    }

    public function getLikesTable()
    {
        return 'gallery_likes';
    }

}

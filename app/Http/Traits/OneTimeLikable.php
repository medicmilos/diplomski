<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/27/2018
 * Time: 10:27 PM
 */

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;
use App\Models\GalleryItem;
use App\Models\GalleryItemLike;

class OneTimeLikable implements LikeableInterface
{

    public function checkCycle(GalleryItem $item)
    {
        $currentCycleId = getCurrentCycleId();
        if ($currentCycleId != $item->cycle_id) {
            return false;
        } else {
            return true;
        }
    }

    public function addLike(GalleryItem $item)
    {
        if (!$this->checkCycle($item)) return [];
        try {
            $user = auth()->user();
            $like = new GalleryItemLike();
            $like->user_id = $user->id;
            $like->item_id = $item->id;
            $like->date_liked = date('Y-m-d');
            if ($like->save()) {
                return $like;
            } else {
                return [];
            }
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getCanLikeAttribute(GalleryItem $item)
    {
        $user = auth()->user();
        if (!$user) return false;
        $userId = $user->id;
        $itemId = $item->id;
        $query = DB::select(DB::raw("SELECT COUNT(*) as like_count FROM " . $this->getLikesTable() . " WHERE item_id = ? AND user_id = ?"), [$itemId, $userId]);
        $count = $query[0]->like_count;
        return $count == 0 ? true : false;
    }

    public function getLikeCountAttribute(GalleryItem $item)
    {
        $itemId = $item->id;
        $query = DB::select(DB::raw("SELECT COUNT(*) as count FROM " . $this->getLikesTable() . " WHERE item_id = ?"), [$itemId]);
        $count = $query[0]->count;
        return $count;
    }

    public function getLikesTable()
    {
        return 'gallery_likes';
    }
}

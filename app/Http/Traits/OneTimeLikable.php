<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/28/2018
 * Time: 1:14 PM
 */

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;
use App\Models\GalleryItemLike;

trait OneTimeLikable
{
    protected $likesTable = 'gallery_likes';

    public function checkCycle(){
        $currentCycleId = getCurrentCycleId();
        if($currentCycleId != $this->cycle_id){
            return false;
        } else {
            return true;
        }
    }

    public function addLike()
    {
        if(!$this->checkCycle()) return [];
        try {
            $user = auth()->user();
            $like = new GalleryItemLike();
            $like->user_id = $user->id;
            $like->item_id = $this->id;
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
        $user = auth()->user();
        if(!$user) return false;
        $userId = $user->id;
        $itemId = $this->id;
        $query = DB::select(DB::raw("SELECT COUNT(*) as like_count FROM ". $this->likesTable . " WHERE item_id = ? AND user_id = ?"), [$itemId, $userId]);
        $count = $query[0]->like_count;
        return $count == 0 ? true : false;
    }

    public function getLikeCountAttribute()
    {
        $itemId = $this->id;
        $query = DB::select(DB::raw("SELECT COUNT(*) as count FROM ". $this->likesTable . " WHERE item_id = ?"), [$itemId]);
        $count = $query[0]->count;
        return $count;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/28/2018
 * Time: 1:15 PM
 */

namespace App\Http\Traits;


trait StubLikeableTrait
{
    protected $likesTable = 'gallery_likes';

    public function checkCycle() : bool { return false;}

    public function addLike() : array { return []; }

    public function getCanLikeAttribute() : bool { return false; }

    public function getLikeCountAttribute() : int { return 0; }
}
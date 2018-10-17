<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/25/2018
 * Time: 10:08 PM
 */

namespace App\Http\Traits;


trait Approvable
{
    /**
     * Approves the item
     */
    public function approve()
    {
        $item = $this;
        $item->approved = 1;
        $item->save();
    }
}
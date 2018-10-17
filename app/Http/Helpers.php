<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/27/2018
 * Time: 4:20 PM
 */

namespace App\Http;


class Helpers
{
    static function getCurrentCycleId(){
        if($cycleId = SessionHandler::get('cycleId')){
            return $cycleId;
        }
        $query = \Illuminate\Support\Facades\DB::select(\Illuminate\Support\Facades\DB::raw('SELECT id as cycleId FROM cycles WHERE CURRENT_TIMESTAMP < lasts_until ORDER BY lasts_until asc LIMIT 1'));
        if(isset($query[0])) {
            $cycleId = $query[0]->cycleId;
            SessionHandler::set('cycleId', $cycleId);
            return $cycleId;
        }
        return -1;
    }
}
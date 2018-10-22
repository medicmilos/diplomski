<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/25/2018
 * Time: 10:19 PM
 */

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Jenssegers\Date\Date;
use App\Http\Helpers as Helper;

class UserInputModel extends GalleryModel
{

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->user_id = Auth::user()->id;
            $model->cycle_id = Helper::getCurrentCycleId();
            if ($model->cycle_id == -1) {
                abort(500, 'Došlo je do greške.');
            }
            if (Schema::hasColumn($model->getTable(), 'approved')) {
                $model->approved = 0;
            }
            $cycle = Cycle::find(Helper::getCurrentCycleId());
            if ($cycle && $cycle->allow_input == 0) {
                abort(403, 'Aktivacija je završena.');
            }
            if ($cycle && $cycle->begun == 0) {
                $cycle->begun = 1;
                $cycle->save();
            }
        });
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function cycle()
    {
        return $this->hasOne('App\Models\Cycle', 'id', 'cycle_id');
    }
}

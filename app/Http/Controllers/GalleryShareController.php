<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 10/20/2018
 * Time: 10:42 PM
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Facades\Agent;
use App\Models\GalleryItem;

class GalleryShareController extends Controller
{
    public function index($modelId = null)
    {
        if (Agent::isRobot()) {
            return $this->page($modelId);
        } else {
            return redirect("https://diplomski.milosmedic.com/public/gallery/item/show/$modelId");
        }
    }

    public function page($modelId)
    {
        if ($modelId != null) {
            $model = GalleryItem::find($modelId);
            return view('shareLayout')->with($this->shareData($model));
        } else {
            return view('shareLayout')->with($this->shareData(null));
        }
    }

    protected function shareData($model)
    {
        if ($model != null) {
            return [
                'og_image' => url('storage/gallery/uploads/' . $model->item_data->photo),
                'og_url' => url('gallery/item/show/' . $model->id)
            ];
        } else {
            return [];
        }
    }
}

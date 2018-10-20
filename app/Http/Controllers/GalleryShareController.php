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
use Intervention\Image\Facades\Image;
use App\Models\GalleryItem;

class GalleryShareController extends Controller
{
    public function index($modelId = null)
    {
        if (Agent::isRobot()) {
            return $this->page($modelId);
        } else {
            return redirect("http://diplomski.milosmedic.com/public/gallery/item/show/$modelId");
        }
    }

    public function page($modelId)
    {
        if ($modelId != null) {
            $model = GalleryItem::find($modelId);
            return view('layout')->with($this->shareData($model));
        } else {
            return view('layout')->with($this->shareData(null));
        }
    }

    protected function shareData($model)
    {
        $img = Image::make('storage/gallery/share/' . $model->item_data->photo);

        if ($model != null && $img != null) {
            return [
                'og_image' => url('storage/gallery/share/' . $model->item_data->photo),
                'og_image_width' => $img->width(),
                'og_image_height' => $img->height()
            ];
        } else {
            return [];
        }
    }
}

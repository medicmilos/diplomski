<?php
/**
 * Created by PhpStorm.
 * User: milos
 * Date: 9/25/2018
 * Time: 10:04 PM
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\Models\Cycle;
use App\Models\GalleryItem;
use App\Models\GalleryItemData;
use App\Models\GalleryWinner;
use App\Models\UserData;
use App\Http\Traits\FileUploadTrait;
use App\Http\Helpers as Helper;
use Illuminate\Support\Facades\Auth;


class GalleryApi extends Controller
{
    protected $serviceName;

    use FileUploadTrait;

    protected $disabled = false;

    public function apiIndex(Request $request)
    {
        if (isset($request->itemLimit)) {
            $limit = $request->itemLimit;
        } else {
            $limit = 20;
        }
        if (isset($request->itemOffsetId) && $request->itemOffsetId != -1) {
            $offset = $this->getSequentialPosition($request->itemOffsetId);
        } else {
            $offset = 0;
        }
        if (isset($request->itemLimitId) && $request->itemLimitId != -1) {
            $limit = $this->getSequentialPosition($request->itemLimitId);
            $limit--;
            if ($limit > 20) {
                $offset = $limit - 20;
            }
        }
        $items = GalleryItem::query()->where('cycle_id', Helper::getCurrentCycleId())->where('approved', 1)->take($limit)->offset($offset)->orderBy('created_at', 'desc')->orderBy('id', 'desc')->get();
        return response()->json($items, 200);
    }

    public function apiWinners()
    {
        return GalleryWinner::query()->where('approved', '=', 1)->orderBy('gallery_winners.created_at', 'desc')->join('gallery_item_data', 'gallery_item_data.item_id', '=', 'gallery_winners.item_id')->get();
    }

    public function apiShow($id)
    {
        $galleryItem = GalleryItem::query()->findOrFail($id);
        return view('show')->with(['galleryItem' => $galleryItem->toArray()]);
    }

    public function apiStore(Request $request)
    {
        $galleryItem = null;
        $status = 0;
        $response = null;
        try {
            if ($this->disabled) {
                $response = response()->json(['message' => 'Konkurs je zavrsen.'], $status = 403);
                throw new \Exception();
            }

            $this->validate($request, [
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:10000'
            ]);

            $request->request->add(['photo_max_width' => 1440, 'photo_max_height' => 1440]);
            $request = $this->saveFiles($request);

            $galleryItem = GalleryItem::create();

            $user = Auth::user();

            $itemData = [
                'item_id' => $galleryItem->id,
                'photo' => $request->photo,
                'name' => explode(' ', $user->name)[0] . " " . explode(' ', $user->name, 2)[1]
            ];

            GalleryItemData::insert($itemData);

            $response = response()->json($galleryItem, $status = 200);
        } catch (\Exception $e) {
            throw $e;
        } finally {
            if (!$response) {
                $response = response()->json(['message' => 'Aktivacija nije aktivna.'], 403);
            }
            return $response;
        }
    }

    public function apiLike($id)
    {
        if (!auth()->user())
            return response()->json(['message' => 'Morate biti prijavljeni kako biste glasali.'], 403);
        $galleryItem = GalleryItem::findOrFail($id);
        if ($galleryItem) {

            if ($like = $galleryItem->addLike()) {
                return response()->json($like, 200);
            }
            return response()->json(['message' => 'Operacija nije dozvoljena.'], 403);
        }
        return response()->json(['message' => 'Trazena stavka nije pronadjena.'], 404);
    }


    protected function getSequentialPosition($itemId)
    {
        return DB::select(
            DB::raw('SELECT x.position
                          FROM
                            (
                              SELECT t.id,@rownum := @rownum + 1 AS position
                                FROM gallery_items t
                                JOIN (SELECT @rownum := 0) r
                                WHERE t.approved = 1
                                ORDER BY t.created_at DESC, t.id DESC
                            ) x
                          WHERE x.id = :item_id'),
            ['item_id' => $itemId]
        )[0]->position;
    }
}

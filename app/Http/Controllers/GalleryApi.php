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

    public function __construct(Route $route)
    {
        if (!in_array($route->getActionMethod(), [
            'apiIndex',
            'index',
            'show',
            'landing',
            'register',
            'registerForm',
            'winners'
        ])) {
            $this->middleware('registered')->except(['getReport']);
        }
    }

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

    public function apiIndexPaginate(Request $request)
    {
        return GalleryItem::query()->where('cycle_id', Helper::getCurrentCycleId())->where('approved', 1)->orderBy('created_at', 'desc')->orderBy('id', 'desc')->jsonPaginate(5);
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
        //toDo salje 500 gresku kada je ciklus setovan na allow_input = 0;
        try {
            if ($this->disabled) {
                $response = response()->json(['message' => 'Konkurs je zavrsen.'], $status = 403);//ToDo fix this
                throw new \Exception();
            }
            $this->beforeStoreCallback($request);

            $this->validate($request, $this->validationRules());

            $request->request->add(['photo_max_width' => 1440, 'photo_max_height' => 1440]);
            $request = $this->saveFiles($request);


            $galleryItem = GalleryItem::create();


            $itemData = $this->createItemData($request, $galleryItem->id);

            $galleryItemData = new GalleryItemData();
            $galleryItemData->fill($itemData)->save();

            $response = response()->json($galleryItem, $status = 200);
        } catch (\Exception $e) {
            $this->onException($e);
            throw $e;
        } finally {
            $this->afterStoreCallback($response);
            if (!$response) {
                $response = response()->json(['message' => 'Doslo je do greske.'], 500);//ToDo fix this
            }
            return $response;
        }
    }

    public function returnUploadedImage()//ToDo is this even working? nesessery?
    {
        if (!empty ($_GET['id'])) {
            $galleryItem = GalleryItem::query()->findOrFail($_GET['id']);
        } else {
            $galleryItem = "error";
            return view('hvala')->with(['galleryItem']);
        }
        return view('hvala')->with(['galleryItem' => $galleryItem->toArray()]);

    }

    public function apiLike($id)
    {
        $galleryItem = GalleryItem::findOrFail($id);
        $user = auth()->user();
        if ($galleryItem) {

            if ($like = $galleryItem->addLike()) {
                return response()->json($like, 200);
            }
            return response()->json(['message' => 'Operacija nije dozvoljena.'], 403);
        }
        return response()->json(['message' => 'Trazena stavka nije pronadjena.'], 404);
    }

    public function apiIsActive()//ToDo is this even working? nesessery?
    {
        $cycleId = getCurrentCycleId();
        return Cycle::query()->findOrFail($cycleId)->allow_input;
    }

    public function index()
    {
        return view('index');
    }

    public function indexWithModalShown($modelId)//ToDo is this even working? nesessery?
    {
        $model = GalleryItem::find($modelId);
        return view('index')->with(['modalData' => $model]);
    }


    public function winners()
    {
        return view('winners');
    }

    protected function getSequentialPosition($itemId)//ToDo is this even working? nesessery?
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

    protected function validationRules()
    {
        return [
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:10000'
        ];
    }

    protected function createItemData($request, $item_id)
    {
        $user = auth()->user();
        return [
            'item_id' => $item_id,
            'photo' => $request->photo,
            'name' => explode(' ', $user->name)[0] . " " . explode(' ', $user->name, 2)[1]
        ];
    }

    public function landing()
    {
        return view('landingpage');
    }

    public function register()
    {
        $user = auth()->user();
        if (!$user) return redirect('login');

        if ($user->userData) {
            return redirect('gallery');
        }

        return view('registration');
    }

    public function registerForm(Request $request)
    {
        $this->validate($request, [
            'livingPlace' => 'required|string|max:191',
            'firstName' => 'required|string|max:191',
            'lastName' => 'required|string|max:191',
        ]);

        $name = $request->firstName . " " . $request->lastName;

        $user = auth()->user();
        if (!$user) abort(400);

        $user->name = $name;
        $user->save();

        $userData = new UserData();
        $userData->user_id = $user->id;
        $userData->completed = 1;
        $userData->livingPlace = $request->post('livingPlace');
        $userData->save();

        return redirect('home');
    }

    public function participate()
    {
        return view('participate');
    }

    protected function afterStoreCallback($response)
    {
        return;//toDo remove unnessesery functions.. Like this one...
    }

    protected function beforeStoreCallback($request)
    {
        return;//toDo remove unnessesery functions.. Like this one...
    }

    protected function onException($e)
    {
        return;//toDo remove unnessesery functions.. Like this one...
    }

    protected function uploadPath()
    {
        return base_path(afw_service_config('gallery.uploadPath'));//ToDo paste relative path
    }//toDo remove unnessesery functions.. Like this one...


    protected function thumbsPath()
    {
        return base_path(afw_service_config('gallery.thumbsPath'));//ToDo paste relative path
    }//toDo remove unnessesery functions.. Like this one...

    protected function previewPath()
    {
        return base_path(afw_service_config('gallery.previewPath'));//ToDo paste relative path
    }//toDo remove unnessesery functions.. Like this one...
}

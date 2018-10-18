<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryItemData;
use App\Models\GalleryItem;
use App\Models\GalleryWinner;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers as Helper;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items = GalleryItem::with('item_data')->paginate(5);


        //dd($items->all());
        return view("admin.gallery.index", compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert()
    {
        //
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $item = GalleryItem::findOrFail($request["data"][0]);
        $item->approved = $request["data"][1];
        $item->save();

        return redirect()->back();
    }

    public function updateToggle(Request $request)
    {
        $value = (int)$request->post('value');
        $type = $request->post('type');
        if (!is_numeric($value) || ($value != 0 && $value != 1)) abort(403);
        $id = (int)$request->post('id');
        if (!is_numeric($id)) abort(403);
        $galleryItem = GalleryItem::findOrFail($id);

        switch ($type) {
            case 'winner' :
                {
                    $galleryWinner = GalleryWinner::where('item_id', $galleryItem->id)->first();
                    if (!$galleryWinner) {
                        $galleryWinner = new GalleryWinner();
                        $galleryWinner->user_id = $galleryItem->user_id;
                        $galleryWinner->item_id = $galleryItem->id;
                        $galleryWinner->cycle_id = $galleryItem->cycle_id;
                    }
                    $galleryWinner->approved = $value;
                    $galleryWinner->save();
                    break;
                }
            case 'approve' :
            default :
                {
                    $galleryItem->approved = $value;
                    $galleryItem->save();
                    break;
                }
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = GalleryItem::findOrFail($id);
        $item->delete();
        return redirect('admin/gallery/index');
    }
}

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
        $items = GalleryItem::with('item_data')->get();

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

    public function winner(Request $request)
    {
        //toDo implement atuomatic approve of item after setting it to winner state
        $is_winner = $request["data"][1];

        $item_id = $request["data"][0];
        $item = GalleryItem::findOrFail($item_id);
        $user_id = $item["user_id"];
        $created_at = $item["created_at"];
        $cycle_id = Helper::getCurrentCycleId();

        if ((bool)$is_winner) {
            if (!(bool)$item['approved']) {
                $item->approved = 1;
                $item->save();
            }
            $winner = new GalleryWinner();
            $winner->user_id = $user_id;
            $winner->item_id = $item_id;
            $winner->cycle_id = $cycle_id;
            $winner->approved = 1;
            $winner->created_at = $created_at;
            $winner->save();
        } else {
            $winner = GalleryWinner::where('item_id', $item_id)->firstOrFail();
            $winner->delete();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);

        //toDo delete from all related tables

        $item = GalleryItem::findOrFail($id);
        $item->delete();
        return redirect('admin/gallery/index');

    }
}

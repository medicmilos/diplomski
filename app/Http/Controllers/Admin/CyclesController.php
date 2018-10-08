<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cycle;
use App\Models\GalleryItem;
use Illuminate\Support\Carbon;
use Prologue\Alerts\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers as Helper;
use Session;

class CyclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Cycle::paginate(5);


        return view("admin.cycles.index", compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert()
    {
        return view("admin.cycles.insert");
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
        //check if last_until is after now()
        $tz = new \DateTime($request->lasts_until);
        $tz = $tz->getTimezone();
        $time = \Carbon\Carbon::instance(new \DateTime($request->lasts_until));

        if (Carbon::now($tz)->gte($time)) {
            Session::flash('message', 'Lasts until value ' . $time . ' must be greater than current time ' . Carbon::now($tz) . '.');
            return redirect()->back();
        }

        //check if new cycle is slicing current cycle
        $currentCycleId = Helper::getCurrentCycleId();
        $currentCycle = Cycle::find($currentCycleId);
        if ($currentCycle) {
            $requestTime = Carbon::createFromTimestamp(strtotime($request->lasts_until));
            $currentCycleTime = Carbon::createFromTimestamp(strtotime($currentCycle->lasts_until));

            if ($currentCycleTime->gte($requestTime)) {
                if ($currentCycle->begun == 1) {
                    Session::flash('message', 'Timespan for this cycle intersects with another cycle that was already started.');

                    return redirect()->back();
                }
            }
        }

        Cycle::create($request->all());

        return redirect('admin/cycle/index');
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
        $cycle = DB::table("cycles")->where('id', $id)->first();
        return view('admin.cycles.update', compact('cycle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //check if new cycle is slicing current cycle
        //TODO: this should work
        $currentCycleId = Helper::getCurrentCycleId();
        $currentCycle = Cycle::find($currentCycleId);
        if ($request->lasts_until < $currentCycle->lasts_until) {
            if ($currentCycle->begun == 1) {
                Session::flash('message', 'Timespan for this cycle intersects with another cycle that was already started.');

                return redirect()->back();
            }
        }

        $cycle = Cycle::findOrFail($id);
        $cycle->update($request->all());

        return redirect('admin/cycle/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cycle = Cycle::findOrFail($id);
        $cycle->delete();
        return redirect('admin/cycle/index');
    }
}

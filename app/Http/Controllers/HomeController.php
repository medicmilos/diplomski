<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserData;
use App\Models\GalleryItem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('auth', ['only' => [
            'participate'
        ]]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('index');
    }

    public function winners()
    {
        return view('winners');
    }

    public function landing()
    {
        return view('landingpage');
    }

    public function participate()
    {
        $user = auth()->user();
        $userData = $user->userData;

        if ($userData && $userData->completed == 1) {
            return view('participate');
        } else {
            return view('registration');
        }

    }

    public function registerForm(Request $request)
    {
        $this->validate($request, [
            'livingPlace' => 'required|string|min:2|max:191',
            'firstName' => 'required|string|min:2|max:191',
            'lastName' => 'required|string|min:2|max:191',
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

        return redirect(route('participate'));
    }

    public function show($id)
    {
        $galleryItem = GalleryItem::query()->findOrFail($id);
        return view('show')->with(['galleryItem' => $galleryItem->toArray()]);
    }
}

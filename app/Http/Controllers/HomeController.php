<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserData;

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
        if ($user = auth()->user()) {
            $userData = $user->userData;

            if ($userData && $userData->completed == 1) {
                return view('participate');
            } else {
                if (!$user) {
                    return redirect('login');
                }

                if ($user->userData) {
                    return redirect('gallery');
                }

                return view('registration');
            }
        }
        return redirect(route('login'));
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
}

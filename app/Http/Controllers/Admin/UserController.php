<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->paginate(5);
        //dd($users->all());
        return view("admin.user.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert()
    {
        return view("admin.user.insert");
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
        $password = bcrypt($request['password']);
        $request['password'] = $password;

        $user = User::create($request->all());

        if (!empty($request->role)) {
            DB::table('role_users')->insert(
                ['role_id' => $request->role, 'user_id' => $user->id]
            );
        }


        return redirect('admin/user/index');

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
        $user = User::with('roles')->where('id', $id)->first();
        return view('admin.user.update', compact('user'));
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
        $userRole = DB::table('role_users')->where('user_id', $id)->first();

        if ($userRole) {
            if (empty($request->role)) {
                DB::table('role_users')->where('user_id', '=', $id)->delete();
            } else {
                DB::table('role_users')
                    ->where('user_id', $id)
                    ->update(['role_id' => $request->role]);
            }
        } else {
            DB::table('role_users')->insert(
                ['role_id' => $request->role, 'user_id' => $id]
            );
        }

        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect('admin/user/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('admin/user/index');
    }
}

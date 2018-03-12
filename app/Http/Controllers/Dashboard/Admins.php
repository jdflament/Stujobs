<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class Admins extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the admins page (only accessible by the super admins)
     */
    public function index(Request $request) {
        $roles = ['superadmin', 'admin'];

        $admins = DB::table('users')
            ->leftJoin('admins', 'users.id', '=', 'admins.user_id')
            ->whereIn('role', $roles)
            ->select('users.id', 'users.email', 'users.role', 'admins.user_id', 'admins.firstname', 'admins.lastname', 'admins.phone', 'admins.office')
            ->get();

        return view('dashboard/admins/index', ['admins' => $admins]);
    }

    /**
     * @return mixed
     *
     * Create an admin
     */
    public function create()
    {
        $data = Input::only('create_email', 'create_password', 'create_role');

        $user = new User();
        $user->setAttribute('email', $data['email']);
        $user->setAttribute('password', Hash::make($data['password']));
        $user->setAttribute('role', $data['role']);
        $user->save();

        return $user;
    }

    /**
     * @param $id
     *
     * Edit an admin
     */
    public function edit($id)
    {
        $data = Input::only('edit_email', 'edit_role');
        $admin = User::where('id', '=', $id)->first();

        $admin->setAttribute('email', $data['edit_email']);
        $admin->setAttribute('role', $data['edit_role']);
        $admin->save();
    }

    /**
     * @param $id
     *
     * Delete an admin (user)
     */
    public function delete($id)
    {
        User::where('id', $id)->delete();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show an admin (infos)
     */
    public function show($id)
    {
        $admin = DB::table('users')->where('users.id', $id)
            ->leftJoin('admins', 'users.id', '=', 'admins.user_id')
            ->select('users.id', 'users.email', 'users.role', 'users.created_at', 'admins.user_id', 'admins.firstname', 'admins.lastname', 'admins.phone', 'admins.office')
            ->get()
            ->first();

        return view('dashboard/admins/actions/show', ['admin' => $admin]);
    }
}

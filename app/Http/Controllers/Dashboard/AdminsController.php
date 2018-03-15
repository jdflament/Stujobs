<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
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
        $user_data = Input::only('create_email', 'create_password', 'create_role');
        $admin_data = Input::only('create_firstname', 'create_lastname', 'create_phone', 'create_office');

        $user = new User();
        $user->setAttribute('email', $user_data['create_email']);
        $user->setAttribute('password', Hash::make($user_data['create_password']));
        $user->setAttribute('role', $user_data['create_role']);
        $user->save();

        $admin = new Admin();
        $admin->setAttribute('user_id', $user->getAttribute('id'));
        $admin->setAttribute('firstname', $admin_data['create_firstname']);
        $admin->setAttribute('lastname', $admin_data['create_lastname']);
        $admin->setAttribute('phone', $admin_data['create_phone']);
        $admin->setAttribute('office', $admin_data['create_office']);
        $admin->save();

        $user->admin_firstname = $admin->firstname;
        $user->admin_lastname = $admin->lastname;
        $user->admin_phone = $admin->phone;
        $user->admin_office = $admin->office;

        return $user;
    }

    /**
     * @param $id
     *
     * Edit an admin
     */
    public function edit($id)
    {
        $user_data = Input::only('edit_email', 'edit_role');
        $admin_data = Input::only('edit_firstname', 'edit_lastname', 'edit_phone', 'edit_office');

        $user = User::where('id', '=', $id)->first();
        $user->setAttribute('email', $user_data['edit_email']);
        $user->setAttribute('role', $user_data['edit_role']);
        $user->save();

        $admin = Admin::firstOrNew(['user_id' => $id]);
        $admin->setAttribute('firstname', $admin_data['edit_firstname']);
        $admin->setAttribute('lastname', $admin_data['edit_lastname']);
        $admin->setAttribute('phone', $admin_data['edit_phone']);
        $admin->setAttribute('office', $admin_data['edit_office']);
        $admin->save();
    }

    /**
     * @param $id
     *
     * Delete an admin
     */
    public function delete($id)
    {
        User::where('id', $id)->delete();
        $admin = Admin::where('user_id', '=', $id)->get()->first();
        if ($admin) {
            $admin->delete();
        }
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

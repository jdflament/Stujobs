<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = Auth::user()->id;
        $admin = DB::table('users')->where('users.id', $id)
            ->leftJoin('admins', 'users.id', '=', 'admins.user_id')
            ->select('users.id', 'users.email', 'users.role', 'users.created_at', 'admins.user_id', 'admins.firstname', 'admins.lastname', 'admins.phone', 'admins.office')
            ->get()
            ->first();

        return view('dashboard/profile/index', ['admin' => $admin]);
    }

    /**
     *
     * Edit profile
     */
    public function edit()
    {
        $id = Auth::user()->id;
        $user_data = Input::only('edit_email');              
        $admin_data = Input::only('edit_lastname', 'edit_firstname', 'edit_phone', 'edit_office');

        $user = User::where('id', $id)->first();
        $user->setAttribute('email', $user_data['edit_email']);
        $user->save();
        
        $admin = Admin::where(['user_id' => $id])->first();        
        $admin->setAttribute('firstname', $admin_data['edit_firstname']);
        $admin->setAttribute('lastname', $admin_data['edit_lastname']);
        $admin->setAttribute('phone', $admin_data['edit_phone']);
        $admin->setAttribute('office', $admin_data['edit_office']);
        $admin->save();

        $admin = DB::table('users')->where('users.id', $id)
            ->leftJoin('admins', 'users.id', '=', 'admins.user_id')
            ->select('users.id', 'users.email', 'users.role', 'users.created_at', 'admins.user_id', 'admins.firstname', 'admins.lastname', 'admins.phone', 'admins.office')
            ->get()
            ->first();

        return view('dashboard/profile/index', ['admin' => $admin]);
    }
        /**
     *
     * Create Edit page
     */
    public function editPage()
    {
        $id = Auth::user()->id;
        $admin = DB::table('users')->where('users.id', $id)
            ->leftJoin('admins', 'users.id', '=', 'admins.user_id')
            ->select('users.id', 'users.email', 'users.role', 'users.created_at', 'admins.user_id', 'admins.firstname', 'admins.lastname', 'admins.phone', 'admins.office')
            ->get()
            ->first();

        return view('dashboard/profile/actions/edit', ['admin' => $admin]);
    }
}

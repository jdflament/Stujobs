<?php

namespace App\Http\Controllers\Adminpanel;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class Dashboard extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the dashboard index
     */
    public function indexDashboard() {
        return view('dashboard/index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the companies page
     */
    public function indexCompanies() {
        return view('dashboard/companies/index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the admins page (only accessible by the super admins)
     */
    public function indexAdmins(Request $request) {
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
    public function createAdmin()
    {
        $data = Input::only('email', 'password', 'role');

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
     * Delete an admin (user)
     */
    public function deleteAdmin($id)
    {
        User::where('id', $id)->delete();
    }
}

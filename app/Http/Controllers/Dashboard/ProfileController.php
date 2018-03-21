<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
}

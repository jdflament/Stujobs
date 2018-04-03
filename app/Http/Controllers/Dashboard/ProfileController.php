<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Display the current user profile
     */
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Edit the admin/super admin profile
     */
    public function edit()
    {
        $id = Auth::user()->id;
        $user_data = Input::only('edit_email');              
        $admin_data = Input::only('edit_lastname', 'edit_firstname', 'edit_phone', 'edit_office');

        $user = User::where('id', $id)->first();
        $user->setAttribute('email', $user_data['edit_email']);
        $user->save();
        
        $admin = Admin::firstOrNew(['user_id' => $id]);
        $admin->setAttribute('firstname', $admin_data['edit_firstname']);
        $admin->setAttribute('lastname', $admin_data['edit_lastname']);
        $admin->setAttribute('phone', $admin_data['edit_phone']);
        $admin->setAttribute('office', $admin_data['edit_office']);
        $admin->save();

        return redirect('dashboard/profile');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Display the profile edit page
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

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Change the current user password
     */
    public function changePassword(Request $request)
    {

        // Inputs errors
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string|min:6|max:255',
            'new_password' => 'required|string|min:6',
            'new_password_confirm' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->getMessages()], 422);
        }

        $pass = Auth::user()->password;
        $current_password = Input::only('current_password');
        $new_password = Input::only('new_password', 'new_password_confirm');

        if(Hash::check($current_password["current_password"], $pass)) {

            if(!strcmp($current_password["current_password"], $new_password["new_password"]) == 0){

                if(strcmp($new_password["new_password"], $new_password["new_password_confirm"]) == 0){
                    //Change Password
                    $user = Auth::user();
                    $user->password = bcrypt($new_password["new_password"]);
                    $user->save();
                } else {
                    // New passwords don't match
//                    return response()->json(['error' => Lang::get('errors.' . 468)], 468);
                    return response()->json(['error' => Lang::get('errors.' . 468)], 468);
                }
            }
            else {
                // New password like the current
                return response()->json(['error' => Lang::get('errors.' . 469)], 469);
            }

        }
        else {
            // User password invalid
            return response()->json(['error' => Lang::get('errors.' . 470)], 470);
        }

        return redirect('dashboard/profile');
        
    }

}

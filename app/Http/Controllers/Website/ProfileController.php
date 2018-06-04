<?php

namespace App\Http\Controllers\Website;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

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
        $company = DB::table('users')->where('users.id', $id)
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('users.id', 'users.email', 'users.role', 'users.created_at', 'companies.user_id', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone', 'companies.description', 'companies.logo_filename', 'companies.logo_size')
            ->get()
            ->first();

        return view('website/profile/index', ['company' => $company]);
    }


    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Edit the company profile
     */
    public function edit(Request $request)
    {
        $id = Auth::user()->id;
        
        // Inputs errors
        $validator = Validator::make($request->all(), [
            'edit_email' => 'required|email|min:6|max:255|unique:users,email,'.$id,
            'edit_name' => 'required',
            'edit_logo' => 'image|mimes:jpg,jpeg,png,gif,svg,bmp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('profile/edit')
            ->withErrors($validator)
            ->withInput()
            ->with('danger', "Vos changements n'ont pas été pris en compte. Veuillez vérifier vos champs.");
        }

        if (isset(request()->edit_logo)) {
            $logoName = "logo_" . time() . '.' . request()->edit_logo->getClientOriginalExtension();
            $logoSize = $request->edit_logo->getClientSize();

            $request->edit_logo->storeAs('public/logos', $logoName);
        }

        $user_data = Input::only('edit_email');
        $company_data = Input::only('edit_name', 'edit_siret', 'edit_address', 'edit_phone', 'edit_description');

        $user = User::where('id', $id)->first();
        $user->setAttribute('email', $user_data['edit_email']);
        $user->save();

        $company = Company::where(['user_id' => $id])->first();
        $company->setAttribute('name', $company_data['edit_name']);
        $company->setAttribute('siret', $company_data['edit_siret']);
        $company->setAttribute('address', $company_data['edit_address']);
        $company->setAttribute('phone', $company_data['edit_phone']);

        if (isset(request()->edit_logo)) {
            if (isset($company->logo_filename)) {
                File::delete(storage_path('app/public/logos') . '/' . $company->logo_filename);
            }
            $company->setAttribute('logo_filename', $logoName);
            $company->setAttribute('logo_size', $logoSize);
        }

        $company->setAttribute('description', $company_data['edit_description']);
        $company->save();

        return redirect()->route('indexProfile')->with('success', 'Votre profil a été correctement modifié.');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Display the profile edit page
     */
    public function editPage()
    {
        $id = Auth::user()->id;
        $company = DB::table('users')->where('users.id', $id)
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('users.id', 'users.email', 'users.role', 'users.created_at', 'companies.user_id', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone', 'companies.description', 'companies.logo_filename', 'companies.logo_size')
            ->get()
            ->first();

        return view('website/profile/actions/edit', ['company' => $company]);
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

        return redirect()->route('indexProfile');

    }
    public function settings()
    {
        return view('website/profile/settings');
    }
}

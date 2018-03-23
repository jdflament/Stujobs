<?php

namespace App\Http\Controllers\Auth;

use App\Models\Company;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
//        $user = User::create([
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//        ]);
//
//        $company = Input::only('name', 'siret', 'phone', 'address');

        $user_data = Input::only('email', 'password', 'password_confirmation');
        $company_data = Input::only('name', 'siret', 'address', 'phone');

        $user = new User();
        $user->setAttribute('email', $user_data['email']);
        $user->setAttribute('password', Hash::make($data['password']));
        $user->save();

        $company = new Company();
        $company->setAttribute('user_id', $user->getAttribute('id'));
        $company->setAttribute('name', $company_data['name']);
        $company->setAttribute('siret', $company_data['siret']);
        $company->setAttribute('address', $company_data['address']);
        $company->setAttribute('phone', $company_data['phone']);
        $company->save();

        $user->company_name = $company->name;
        $user->company_siret = $company->siret;
        $user->company_address = $company->address;
        $user->company_phone = $company->phone;

        return $user;
    }
}

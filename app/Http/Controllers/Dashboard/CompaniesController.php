<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Company;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the companies page
     */
    public function index(Request $request) {
        $roles = ['company'];

        $companies = DB::table('users')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->whereIn('role', $roles)
            ->select('users.id', 'users.email', 'users.role', 'companies.user_id', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->get();

        return view('dashboard/companies/index', ['companies' => $companies]);
    }

    /**
     * @return mixed
     *
     * Create a company
     */
    public function create(Request $request)
    {
        // Inputs errors
        $validator = Validator::make($request->all(), [
            'create_email' => 'required|email',
            'create_password' => 'required|string|min:6',
            'create_role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => Lang::get('errors.' . 467)], 467);
        }

        $user_data = Input::only('create_email', 'create_password', 'create_role');
        $company_data = Input::only('create_name', 'create_siret', 'create_address', 'create_phone');

        $user = new User();
        $user->setAttribute('email', $user_data['create_email']);
        $user->setAttribute('password', Hash::make($user_data['create_password']));
        $user->setAttribute('role', $user_data['create_role']);
        $user->save();

        $company = new Company();
        $company->setAttribute('user_id', $user->getAttribute('id'));
        $company->setAttribute('name', $company_data['create_name']);
        $company->setAttribute('siret', $company_data['create_siret']);
        $company->setAttribute('address', $company_data['create_address']);
        $company->setAttribute('phone', $company_data['create_phone']);
        $company->save();

        $user->company_name = $company->name;
        $user->company_siret = $company->siret;
        $user->company_address = $company->address;
        $user->company_phone = $company->phone;

        return $user;
    }

    /**
     * @param $id
     *
     * Edit a company
     */
    public function edit($id, Request $request)
    {

        // Inputs errors
        $validator = Validator::make($request->all(), [
            'edit_email' => 'required|email',
            'edit_role' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => Lang::get('errors.' . 467)], 467);
        }

        $user_data = Input::only('edit_email', 'edit_role');
        $company_data = Input::only('edit_name', 'edit_siret', 'edit_address', 'edit_phone');

        $user = User::where('id', '=', $id)->first();
        $user->setAttribute('email', $user_data['edit_email']);
        $user->setAttribute('role', $user_data['edit_role']);
        $user->save();

        $company = Company::firstOrNew(['user_id' => $id]);
        $company->setAttribute('name', $company_data['edit_name']);
        $company->setAttribute('siret', $company_data['edit_siret']);
        $company->setAttribute('address', $company_data['edit_address']);
        $company->setAttribute('phone', $company_data['edit_phone']);
        $company->save();
    }

    /**
     * @param $id
     *
     * Delete a company (user)
     */
    public function delete($id)
    {
        User::where('id', $id)->delete();

        // Delete the associated company info if exist
        $company = Company::where('user_id', '=', $id)->get()->first();
        if ($company) {
            $company->delete();
        }

        // Delete the associated offers if exist
        $offers = Offer::where('company_id', '=', $id)->get();
        if ($offers) {
            foreach ($offers as $offer) {
                $offer->delete();
            }
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show a company
     */
    public function show($id)
    {
        $company = DB::table('users')->where('users.id', $id)
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('users.id', 'users.email', 'users.role', 'users.created_at', 'companies.user_id', 'companies.name', 'companies.siret', 'companies.phone', 'companies.address')
            ->get()
            ->first();

        return view('dashboard/companies/actions/show', ['company' => $company]);
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class OffersController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the offers page
     */
    public function index(Request $request) {
        $offers = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->get();

        return view('dashboard/offers/index', ['offers' => $offers]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the offer creation page
     */
    public function createPage()
    {
        $roles = ['company'];

        $companies = DB::table('users')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->whereIn('role', $roles)
            ->select('users.id', 'users.email', 'users.role', 'companies.user_id', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->get();

        return view('dashboard/offers/actions/create', ['companies' => $companies]);
    }

//    /**
//     * @return mixed
//     *
//     * Create a company
//     */
//    public function create()
//    {
//        $data = Input::only('create_email', 'create_password', 'create_role');
//
//        $company = new User();
//        $company->setAttribute('email', $data['create_email']);
//        $company->setAttribute('password', Hash::make($data['create_password']));
//        $company->setAttribute('role', $data['create_role']);
//        $company->save();
//
//        return $company;
//    }
//
//    /**
//     * @param $id
//     *
//     * Edit a company
//     */
//    public function edit($id)
//    {
//        $data = Input::only('edit_email', 'edit_role');
//        $company = User::where('id', '=', $id)->first();
//
//        $company->setAttribute('email', $data['edit_email']);
//        $company->setAttribute('role', $data['edit_role']);
//        $company->save();
//    }
//
//    /**
//     * @param $id
//     *
//     * Delete an offer
//     */
//    public function delete($id)
//    {
//        Offer::where('id', $id)->delete();
//    }
//
//    /**
//     * @param $id
//     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
//     *
//     * Show a company
//     */
//    public function show($id)
//    {
//        $company = DB::table('users')->where('users.id', $id)
//            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
//            ->select('users.id', 'users.email', 'users.role', 'users.created_at', 'companies.user_id', 'companies.name', 'companies.siret', 'companies.phone', 'companies.address')
//            ->get()
//            ->first();
//
//        return view('dashboard/companies/actions/show', ['company' => $company]);
//    }
}

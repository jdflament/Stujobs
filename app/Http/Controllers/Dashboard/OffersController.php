<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

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
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->orderBy('offers.created_at', 'DESC')
            ->get();

        $offersType = [
            "all" => "Toutes",
            "valid" => "Validées",
            "invalid" => "Invalidées",
            "complete" => "Clôturées",
            "incomplete" => "En cours"
        ];

        return view('dashboard/offers/index', ['offers' => $offers, 'offersType' => $offersType]);
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

    /**
     * @return mixed
     *
     * Create an offer
     */
    public function create(Request $request)
    {
        // Inputs errors
        $validator = Validator::make($request->all(), [
            'create_company_id' => 'required',
            'create_title' => 'required|string|max:255',
            'create_description' => 'required|string',
            'create_contract_type' => 'required',
            'create_duration' => 'required|string|max:100',
            'create_remuneration' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/offers/create')
            ->withErrors($validator)
            ->withInput();
        }

        $data = Input::only('create_company_id', 'create_title', 'create_description', 'create_contract_type', 'create_duration', 'create_remuneration', 'create_valid');

        $offer = new Offer();
        $offer->setAttribute('company_id', $data['create_company_id']);
        $offer->setAttribute('title', $data['create_title']);
        $offer->setAttribute('description', $data['create_description']);
        $offer->setAttribute('contract_type', $data['create_contract_type']);
        $offer->setAttribute('duration', $data['create_duration']);
        $offer->setAttribute('remuneration', $data['create_remuneration']);
        $offer->setAttribute('valid', filter_var($data['create_valid'], FILTER_VALIDATE_BOOLEAN));
        $offer->save();

        $offers = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->orderBy('offers.created_at', 'DESC')
            ->get();

        return redirect()->route('dashboardIndexOffers')->with('offers', $offers);
    }

    /**
     * @param $id
     * @return int
     *
     * Approve an offer and return the total not approve
     */
    public function approve($id)
    {
        $offer = Offer::where('id', $id)->first();
        $offer->setAttribute('valid', 1);
        $offer->save();

        $offers = DB::table('offers')
            ->where('valid', '=', 0)
            ->get();

        $total = count($offers);

        return $total;
    }

    /**
     * @param $id
     * @return int
     *
     * Disapprove an offer and return the total not approve
     */
    public function disapprove($id)
    {
        $offer = Offer::where('id', $id)->first();
        $offer->setAttribute('valid', 0);
        $offer->save();

        $offers = DB::table('offers')
            ->where('valid', '=', 0)
            ->get();

        $total = count($offers);

        return $total;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the offer edit page
     */
    public function editPage($id)
    {
        $offer = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'users.email', 'users.id as user_id', 'users.role','offers.company_id' , 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->where('offers.id', '=', $id)
            ->get()
            ->first();

        $roles = ['company'];

        $companies = DB::table('users')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->whereIn('role', $roles)
            ->select('users.id', 'users.email', 'users.role', 'companies.user_id', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->get();

        return view('dashboard/offers/actions/edit', ['companies' => $companies, 'offer' => $offer]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Edit an offer
     */
    public function edit($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'edit_company_id' => 'required',
            'edit_title' => 'required|string|max:255',
            'edit_description' => 'required|string',
            'edit_contract_type' => 'required',
            'edit_duration' => 'required|string|max:100',
            'edit_remuneration' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/offers/create')
            ->withErrors($validator)
            ->withInput();
        }

        $data = Input::only('edit_company_id', 'edit_title', 'edit_description', 'edit_contract_type', 'edit_duration', 'edit_remuneration');

        $offer = Offer::where('id', $id)->first();
        $offer->setAttribute('company_id', $data['edit_company_id']);
        $offer->setAttribute('title', $data['edit_title']);
        $offer->setAttribute('description', $data['edit_description']);
        $offer->setAttribute('contract_type', $data['edit_contract_type']);
        $offer->setAttribute('duration', $data['edit_duration']);
        $offer->setAttribute('remuneration', $data['edit_remuneration']);
        $offer->save();

        $offers = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->get();

        return redirect()->route('dashboardIndexOffers')->with('offers', $offers);
    }

    /**
     * @param $id
     * @return int
     *
     * Delete an offer and return total offers to valid
     */
    public function delete($id)
    {
        Offer::where('id', $id)->delete();

        $offers = DB::table('offers')
            ->where('valid', '=', 0)
            ->get();

        $total = count($offers);

        return $total;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show an offer on Dashboard
     */
    public function show($id)
    {
        $offer = DB::table('offers')->where('offers.id', $id)
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('users.id as user_id', 'users.email as user_email', 'users.role as user_role', 'users.created_at as user_created_at', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.phone as company_phone', 'companies.address as company_address', 'offers.id as offer_id', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete')
            ->get()
            ->first();

        return view('dashboard/offers/actions/show', ['offer' => $offer]);
    }

    public function filter($type)
    {
        $mapping = [
            "all" => ["offers.id", '!=', 0],
            "valid" => ["offers.valid", '=', 1],
            "invalid" => ["offers.valid", '=', 0],
            "complete" => ["offers.complete", '=', 1],
            "incomplete" => ["offers.complete", '=', 0]
        ];

        $offers = DB::table('offers')->where($mapping[$type][0], $mapping[$type][1], $mapping[$type][2])
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->orderBy('offers.created_at', 'DESC')
            ->get();

        $offersType = [
            "all" => "Toutes",
            "valid" => "Validées",
            "invalid" => "Invalidées",
            "complete" => "Clôturées",
            "incomplete" => "En cours"
        ];

        return view('dashboard/offers/index', ['offers' => $offers, 'offersType' => $offersType]);
    }
}

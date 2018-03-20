<?php

namespace App\Http\Controllers\Website;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class OffersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function index()
    {
        $offers = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->orderBy('offers.created_at', 'DESC')
            ->get();

        return view('website/offers/index', ['offers' => $offers]);
    }

    /**
     * Show the website create offer page.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPage()
    {
        return view('website/offers/actions/create');
    }

    /**
     * @return Offer
     *
     * Create a job offer
     */
    public function create()
    {
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
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->orderBy('offers.created_at', 'DESC')
            ->get();

        return view('website/offers/index', ['offers' => $offers]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show a job offer
     */
    public function show($id)
    {
        $offer = DB::table('offers')->where('offers.id', $id)
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('users.id as user_id', 'users.email as user_email', 'users.role as user_role', 'users.created_at as user_created_at', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.phone as company_phone', 'companies.address as company_address', 'offers.id as offer_id', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid')
            ->get()
            ->first();
        
        if ($offer->valid == 1) {
            return view('website/offers/actions/show', ['offer' => $offer]);
        } else {
            abort(404);
        }
    }
}

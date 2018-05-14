<?php

namespace App\Http\Controllers\Website;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class OffersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['showValid', 'search', 'filterOffers', 'searchByCompany']]);
    }

    public function index()
    {
        $id = Auth::user()->id;

        $offers = DB::table('offers')->where('offers.company_id', $id)
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.city', 'offers.valid', 'offers.complete', 'offers.sector', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->orderBy('offers.created_at', 'DESC')
            ->get();

        return view('website/profile/offers/index', ['offers' => $offers]);
    }

    /**
     * Show the website create offer page.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPage()
    {
        return view('website/profile/offers/actions/create');
    }

    /**
     * @return Offer
     *
     * Create a job offer
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
            'create_remuneration' => 'required',
            'create_city' => 'required|string|max:255',
            'create_contact_email' => 'required|email',
            'create_contact_phone' => 'required|phone',
            'create_sector' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('profile/offer/create')
            ->withErrors($validator)
            ->withInput()
            ->with('danger', "Une erreur est survenue. Veuillez vérifier vos champs.");
        }

        $data = Input::only('create_title', 'create_description', 'create_contract_type', 'create_duration', 'create_remuneration', 'create_city','create_contact_email', 'create_contact_phone', 'create_valid', 'create_sector');

        $offer = new Offer();
        $offer->setAttribute('company_id', Auth::user()->id);
        $offer->setAttribute('title', $data['create_title']);
        $offer->setAttribute('description', $data['create_description']);
        $offer->setAttribute('contract_type', $data['create_contract_type']);
        $offer->setAttribute('duration', $data['create_duration']);
        $offer->setAttribute('remuneration', $data['create_remuneration']);
        $offer->setAttribute('city', $data['create_city']);
        $offer->setAttribute('valid', filter_var($data['create_valid'], FILTER_VALIDATE_BOOLEAN));
        $offer->setAttribute('contact_email', $data['create_contact_email']);
        $offer->setAttribute('contact_phone', $data['create_contact_phone']);
        $offer->setAttribute('sector', $data['create_sector']);
        $offer->save();

        $offers = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.city', 'offers.valid', 'offers.contact_email', 'offers.contact_phone', 'offers.complete', 'offers.sector', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->orderBy('offers.created_at', 'DESC')
            ->get();

        return redirect()->route('indexOffers')->with('offers', $offers);
    }

    /**
     * @param $id
     * @return int
     *
     * Complete an offer
     */
    public function complete($id)
    {
        $offer = Offer::where('id', $id)->first();
        $offer->setAttribute('complete', true);
        $offer->save();

        $offers = DB::table('offers')
            ->where('complete', '=', true)
            ->get();

        $total = count($offers);

        return $total;
    }


    /**
     * @param $id
     * @return int
     *
     * Uncomplete a complete offer
     */
    public function uncomplete($id)
    {
        $offer = Offer::where('id', $id)->first();
        $offer->setAttribute('complete', false);
        $offer->setAttribute('valid', false);
        $offer->save();

        $offers = DB::table('offers')
            ->where('complete', '=', false)
            ->get();

        $total = count($offers);

        return $total;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show a valid job offer on website
     */
    public function showValid($id)
    {
        $offer = DB::table('offers')->where('offers.id', $id)
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('users.id as user_id', 'users.email as user_email', 'users.role as user_role', 'users.created_at as user_created_at', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.phone as company_phone', 'companies.address as company_address', 'companies.logo_filename as company_logo_filename', 'offers.id as offer_id', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.city', 'offers.valid', 'offers.complete', 'offers.sector')
            ->get()
            ->first();
        
        if ($offer->valid == 1) {
            return view('website/offers/actions/show', ['offer' => $offer]);
        } else {
            abort(404);
        }
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
            ->select('offers.id', 'users.email', 'users.id as user_id', 'users.role','offers.company_id' , 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.city', 'offers.valid', 'offers.complete', 'offers.contact_email', 'offers.contact_phone', 'offers.sector', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->where('offers.id', '=', $id)
            ->get()
            ->first();

        return view('website/profile/offers/actions/edit', ['offer' => $offer]);
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
            'edit_title' => 'required|string|max:255',
            'edit_description' => 'required|string',
            'edit_contract_type' => 'required',
            'edit_duration' => 'required|string|max:100',
            'edit_remuneration' => 'required',
            'edit_city' => 'required|string|max:255',
            'edit_contact_email' => 'required|email',
            'edit_contact_phone' => 'required|phone',
            'edit_sector' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('profile/offers/'.$id.'/edit')
            ->withErrors($validator)
            ->withInput()
            ->with('danger', "Une erreur est survenue. Veuillez vérifier vos champs.");
        }

        $data = Input::only('edit_title', 'edit_description', 'edit_contract_type', 'edit_duration', 'edit_remuneration', 'edit_city', 'edit_contact_email', 'edit_contact_phone', 'edit_sector');

        $offer = Offer::where('id', $id)->first();
        $offer->setAttribute('company_id', Auth::user()->id);
        $offer->setAttribute('title', $data['edit_title']);
        $offer->setAttribute('description', $data['edit_description']);
        $offer->setAttribute('contract_type', $data['edit_contract_type']);
        $offer->setAttribute('duration', $data['edit_duration']);
        $offer->setAttribute('remuneration', $data['edit_remuneration']);
        $offer->setAttribute('contact_email', $data['edit_contact_email']);
        $offer->setAttribute('contact_phone', $data['edit_contact_phone']);
        $offer->setAttribute('city', $data['edit_city']);
        $offer->setAttribute('sector', $data['edit_sector']);
        $offer->save();

        $offers = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.city', 'offers.valid', 'offers.complete', 'offers.contact_email', 'offers.contact_phone', 'offers.sector', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->get();

        return redirect()->route('indexOffers')->with('offers', $offers);
    }

    /**
     * @param $id
     *
     * Delete an offer
     */
    public function delete($id)
    {
        Offer::where('id', $id)->delete();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show an offer on Profile
     */
    public function show($id)
    {
        $offer = DB::table('offers')->where('offers.id', $id)
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('users.id as user_id', 'users.email as user_email', 'users.role as user_role', 'users.created_at as user_created_at', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.phone as company_phone', 'companies.address as company_address', 'companies.logo_filename as company_logo_filename', 'offers.id as offer_id', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.city', 'offers.valid', 'offers.complete', 'offers.contact_email', 'offers.contact_phone', 'offers.sector')
            ->get()
            ->first();

        return view('website/profile/offers/actions/show', ['offer' => $offer]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Search an offer and return id + title
     */
    public function search($result)
    {
        $term = $result;

        if ($term) {
            $offers = DB::table('offers')
                ->leftJoin('users', 'offers.company_id', '=', 'users.id')
                ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
                ->select('offers.id as id_offer', 'users.id as id_company', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete', 'offers.created_at', 'offers.city', 'offers.sector', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
                ->where([
                    ['offers.title', 'LIKE', '%' . $term . '%'],
                    ['offers.valid', '=', true],
                    ['offers.complete', '=', false],
                ])
                ->orderBy('offers.created_at', 'DESC')
                ->get();

            return view('website/index', ['offers' => $offers, 'term' => $term]);
        } else {
            return redirect()->back()->withErrors();
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Search companies
     */
    public function searchByCompany(Request $request)
    {
        $term = Input::get('term');

        $results = array();

        $queries = DB::table('companies')
            ->leftJoin('users', 'companies.user_id', '=', 'users.id')
            ->select('users.id as id_company', 'users.email', 'users.role', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->where('companies.name', 'LIKE', '%'.$term.'%')
            ->distinct()
            ->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id_company,'name' => $query->name ];
        }

        return response()->json($results);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Filter offers
     */
    public function filterOffers(Request $request)
    {
        $contracts = Input::only('contract_type');
        $sectors = Input::only('sectors');
        $company_name = Input::only('companyFilter');
        $offer_title = Input::only('offerFilter');

        if (isset($contracts['contract_type'])) {
            $contracts = $contracts['contract_type'];
        }

        if (isset($sectors['sectors'])) {
            $sectors = $sectors['sectors'];
        }

        if (isset($company_name['companyFilter'])) {
            $company_name = $company_name['companyFilter'];
        } else {
            $company_name = "";
        }

        if (isset($offer_title['offerFilter'])) {
            $offer_title = $offer_title['offerFilter'];
        } else {
            $offer_title = "";
        }

        if (in_array("all", $contracts)) {
            $contractsFile = Lang::get('vocabulary.contract_type');
            $contractsKey = array();
            foreach ($contractsFile as $key => $value) {
                array_push($contractsKey, $key);
            }
            $contracts = $contractsKey;
        }

        if (in_array("all", $sectors)) {
            $sectorsFile = Lang::get('vocabulary.sector_activity');
            $sectorsKeys = array();
            foreach ($sectorsFile as $key => $value) {
                array_push($sectorsKeys, $key);
            }
            $sectors = $sectorsKeys;
        }

        $offers = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id as id_offer', 'users.id as id_company', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete', 'offers.created_at', 'offers.city', 'offers.sector', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->whereIn('offers.contract_type', $contracts)
            ->whereIn('offers.sector', $sectors)
            ->where([
                ['companies.name', 'LIKE', '%'.$company_name.'%'],
                ['offers.title', 'LIKE', '%'.$offer_title.'%'],
                ['offers.valid', '=', true],
                ['offers.complete', '=', false],
            ])
            ->orderBy('offers.created_at', 'DESC')
            ->get();

        return view('website/index', ['offers' => $offers]);
    }
}

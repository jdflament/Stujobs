<?php

namespace App\Http\Controllers\Website;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $this->middleware('auth', ['except' => ['showValid']]);
    }

    public function index()
    {
        $id = Auth::user()->id;

        $offers = DB::table('offers')->where('offers.company_id', $id)
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
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
    public function create()
    {
        $data = Input::only('create_title', 'create_description', 'create_contract_type', 'create_duration', 'create_remuneration', 'create_valid');

        $offer = new Offer();
        $offer->setAttribute('company_id', Auth::user()->id);
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
            ->select('users.id as user_id', 'users.email as user_email', 'users.role as user_role', 'users.created_at as user_created_at', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.phone as company_phone', 'companies.address as company_address', 'offers.id as offer_id', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete')
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
            ->select('offers.id', 'users.email', 'users.id as user_id', 'users.role','offers.company_id' , 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
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
    public function edit($id)
    {
        $data = Input::only('edit_title', 'edit_description', 'edit_contract_type', 'edit_duration', 'edit_remuneration');

        $offer = Offer::where('id', $id)->first();
        $offer->setAttribute('company_id', Auth::user()->id);
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
            ->select('users.id as user_id', 'users.email as user_email', 'users.role as user_role', 'users.created_at as user_created_at', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.phone as company_phone', 'companies.address as company_address', 'offers.id as offer_id', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete')
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
    public function search(Request $request)
    {
        $term = Input::get('term');

        $results = array();

        $queries = DB::table('offers')
            ->where([['offers.title', 'LIKE', '%'.$term.'%'], ['offers.valid', '=', 1]])
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('users.id as user_id', 'users.email as user_email', 'users.role as user_role', 'users.created_at as user_created_at', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.phone as company_phone', 'companies.address as company_address', 'offers.id as offer_id', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete')
            ->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->offer_id, 'title' => $query->title ];
        }

        return response()->json($results);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Filter offers
     */
    public function filterOffers()
    {
        $checkboxes = Input::only('contract_type');

        if (isset($checkboxes['contract_type'])) {
            $checkboxes = $checkboxes['contract_type'];
        }

        if (in_array("all", $checkboxes)) {
            $checkboxes = ["nc", "sj", "interim", "stage", "ca", "cp", "cdd", "cdi"];
        }

        $offers = DB::table('offers')
            ->whereIn('offers.contract_type', $checkboxes)
            ->where([
                ['offers.valid', '=', true],
                ['offers.complete', '=', false],
            ])
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id as id_offer', 'users.id as id_company', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete', 'offers.created_at', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->orderBy('offers.created_at', 'DESC')
            ->get();

        return view('website/index', ['offers' => $offers]);
    }
}

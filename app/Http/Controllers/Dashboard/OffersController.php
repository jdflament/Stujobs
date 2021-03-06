<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Apply;
use App\Models\Offer;
use App\Mail\OfferValidated;
use App\Jobs\SendEmailOfferValidated;
use App\Models\OffersHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

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
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.created_at', 'offers.remuneration', 'offers.city', 'offers.valid', 'offers.complete', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->orderBy('offers.created_at', 'DESC')
            ->paginate(10);

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
            'create_remuneration' => 'required',
            'create_city' => 'required|string|max:255',
            'create_contact_email' => 'required|email',
            'create_contact_phone' => 'required|phone',
            'create_sector' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/offers/create')
            ->withErrors($validator)
            ->withInput()
            ->with('danger', "Une erreur est survenue. Veuillez vérifier vos champs.");
        }

        $data = Input::only('create_company_id', 'create_title', 'create_description', 'create_contract_type', 'create_duration', 'create_remuneration', 'create_city', 'create_contact_email', 'create_contact_phone', 'create_valid', 'create_sector');

        $offer = new Offer();
        $offer->setAttribute('company_id', $data['create_company_id']);
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
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.city', 'offers.valid', 'offers.complete', 'offers.contact_email', 'offers.contact_phone', 'offers.sector', 'offers.created_at', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
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
    public function approve($id, Request $request)
    {
        $data = Input::only('approve_reason');

        $user_id = Auth::user()->id;

        $offer = Offer::where('id', $id)->first();
        $offer->setAttribute('valid', 1);
        $offer->save();

        // Update history of this offer
        $history = new OffersHistory();
        $history->setAttribute('offer_id', $id);
        $history->setAttribute('user_id', $user_id);
        $history->setAttribute('column_change', 'valid');
        $history->setAttribute('column_value', 1);
        $history->setAttribute('reason', $data['approve_reason']);
        $history->save();

        $users = DB::table('newsletter')
                    ->whereIn('params_sector', ['all',$offer->sector])
                    ->whereIn('params_contract', ['all',$offer->contract_type])
                    ->get();

        foreach($users as $user){
            SendEmailOfferValidated::dispatch($offer, $user)
                ->delay(now()->addMinutes(1));
        }

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
    public function disapprove($id, Request $request)
    {
        // Inputs errors
        $validator = Validator::make($request->all(), [
            'disapprove_reason' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->getMessages()], 500);
        }

        $data = Input::only('disapprove_reason');

        $user_id = Auth::user()->id;

        $offer = Offer::where('id', $id)->first();
        $offer->setAttribute('valid', 0);
        $offer->save();

        // Update history of this offer
        $history = new OffersHistory();
        $history->setAttribute('offer_id', $id);
        $history->setAttribute('user_id', $user_id);
        $history->setAttribute('column_change', 'valid');
        $history->setAttribute('column_value', 0);
        $history->setAttribute('reason', $data['disapprove_reason']);
        $history->save();

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
            ->select('offers.id', 'users.email', 'users.id as user_id', 'users.role','offers.company_id' , 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.city', 'offers.valid', 'offers.complete', 'offers.contact_email', 'offers.contact_phone', 'offers.sector', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
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
            'edit_remuneration' => 'required',
            'edit_city' => 'required|string|max:255',
            'edit_contact_email' => 'required|email',
            'edit_contact_phone' => 'required|phone',
            'edit_sector' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/offers/'.$id.'/edit')
            ->withErrors($validator)
            ->withInput()
            ->with('danger', "Une erreur est survenue. Veuillez vérifier vos champs.");
        }

        $data = Input::only('edit_company_id', 'edit_title', 'edit_description', 'edit_contract_type', 'edit_duration', 'edit_remuneration', 'edit_city', 'edit_contact_email', 'edit_contact_phone', 'edit_sector');

        $offer = Offer::where('id', $id)->first();
        $offer->setAttribute('company_id', $data['edit_company_id']);
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
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.city', 'offers.valid', 'offers.complete', 'offers.contact_email', 'offers.contact_phone', 'offers.sector','offers.created_at', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->get();

        return redirect()->route('dashboardIndexOffers')->with('offers', $offers);
    }

    /**
     * @param $id
     * @return array
     *
     * Delete an offer and return total offers to valid
     */
    public function delete($id)
    {
        Offer::where('id', $id)->delete();

        // Delete the associated applies if exist (and the CV if exist)
        $applies = Apply::where('offer_id', '=', $id)->get();
        if ($applies) {
            foreach ($applies as $apply) {
                if (isset($apply->cv_filename)) {
                    File::delete(storage_path('app/public/cv') . '/' . $apply->cv_filename);
                }

                $apply->delete();
            }
        }

        $history = OffersHistory::where('offer_id', '=', $id)->get();
        if ($history) {
            foreach ($history as $value) {
                $value->delete();
            }
        }

        $offers = DB::table('offers')
            ->where('valid', '=', 0)
            ->get();

        $applies = DB::table('applies')
            ->where('valid', '=', 0)
            ->get();


        $totalOffers = count($offers);
        $totalApplies = count($applies);

        return [$totalOffers, $totalApplies];
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
            ->select('users.id as user_id', 'users.email as user_email', 'users.role as user_role', 'users.created_at as user_created_at', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.phone as company_phone', 'companies.address as company_address', 'offers.id as offer_id', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.city', 'offers.valid', 'offers.complete', 'offers.contact_email', 'offers.contact_phone', 'offers.created_at')
            ->get()
            ->first();

        $totalApplies = DB::table('applies')
            ->leftJoin('offers', 'applies.offer_id', '=', 'offers.id')
            ->select('applies.id')
            ->where('offers.id', $id)
            ->get()
            ->all();

        return view('dashboard/offers/actions/show', ['offer' => $offer, 'totalApplies' => $totalApplies]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the offer history page
     */
    public function historyPage($id)
    {
        $offer = DB::table('offers')->where('offers.id', $id)
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('users.id as user_id', 'users.email as user_email', 'users.role as user_role', 'users.created_at as user_created_at', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.phone as company_phone', 'companies.address as company_address', 'offers.id as offer_id', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.city', 'offers.valid', 'offers.complete', 'offers.contact_email', 'offers.contact_phone', 'offers.created_at')
            ->get()
            ->first();

        $history = DB::table('offers_history')
            ->leftJoin('users', 'offers_history.user_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->leftJoin('admins', 'users.id', '=', 'admins.user_id')
            ->select('offers_history.id as history_id', 'offers_history.column_change as history_column_change', 'offers_history.column_value as history_column_value', 'offers_history.reason as history_reason', 'offers_history.created_at as history_created_at', 'users.email as history_user_email', 'users.id as history_user_id', 'users.role as history_user_role', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.phone as company_phone', 'companies.address as company_address', 'admins.firstname as admin_firstname', 'admins.lastname as admin_lastname', 'admins.phone as admin_phone', 'admins.office as admin_office')
            ->where('offers_history.offer_id', '=', $id)
            ->orderBy('offers_history.created_at', 'ASC')
            ->get();

        return view('dashboard/offers/actions/history', ['offer' => $offer, 'history' => $history]);
    }

    /**
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Filter offers by status
     */
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
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.city', 'offers.valid', 'offers.complete', 'offers.contact_email', 'offers.contact_phone', 'offers.created_at', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->orderBy('offers.created_at', 'DESC')
            ->paginate(10);

        return view('dashboard/offers/index', ['offers' => $offers, 'typeOffer' => $type]);
    }
}

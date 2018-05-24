<?php

namespace App\Http\Controllers\Dashboard;

use App\Mail\SendApply;
use App\Models\Apply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class AppliesController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the applies page
     */
    public function index(Request $request) {
        $applies = DB::table('applies')
            ->leftJoin('offers', 'applies.offer_id', '=', 'offers.id')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('applies.id as apply_id', 'applies.firstname as apply_firstname', 'applies.lastname as apply_lastname', 'applies.email as apply_email', 'applies.phone as apply_phone', 'applies.cv_filename as apply_cv_filename', 'applies.subject as apply_subject', 'applies.message as apply_message', 'applies.valid as apply_valid', 'applies.created_at as apply_created_at','offers.id as offer_id', 'users.email as company_email', 'users.role as company_role', 'offers.title as offer_title', 'offers.description as offer_description', 'offers.contract_type as offer_contract_type', 'offers.duration as offer_duration', 'offers.remuneration as offer_remuneration', 'offers.valid as offer_valid', 'offers.complete as offer_complete', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.address as company_address', 'companies.phone as company_phone')
            ->orderBy('applies.created_at', 'DESC')
            ->paginate(10);

        $offers = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'offers.title', 'offers.created_at', 'users.email as company_email', 'companies.name as company_name')
            ->join('applies', 'offers.id', '=', 'applies.offer_id')
            ->orderBy('offers.title')
            ->distinct()
            ->get()
            ->all();

        return view('dashboard/applies/index', ['applies' => $applies, 'offers' => $offers]);
    }

    /**
     * @param $id
     * @return int
     *
     * Delete an apply and the attach file (if exist) and return total applies
     */
    public function delete($id)
    {
        $apply = Apply::where('applies.id', '=', $id)
            ->get()
            ->first();

        if (isset($apply->cv_filename)) {
            File::delete(storage_path('app/public/cv') . '/' . $apply->cv_filename);
        }

        $apply->delete();

        $applies = DB::table('applies')
            ->where('valid', '=', 0)
            ->get();

        $totalApplies = count($applies);

        return $totalApplies;
    }

    public function accept($id)
    {
        $apply = DB::table('applies')->where('applies.id', $id)
            ->leftJoin('offers', 'applies.offer_id', '=', 'offers.id')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('applies.id as apply_id', 'applies.firstname as apply_firstname', 'applies.lastname as apply_lastname', 'applies.email as apply_email', 'applies.phone as apply_phone', 'applies.cv_filename as apply_cv_filename', 'applies.subject as apply_subject', 'applies.message as apply_message', 'applies.valid as apply_valid', 'applies.created_at as apply_created_at','offers.id as offer_id', 'users.email as company_email', 'users.role as company_role', 'offers.title as offer_title', 'offers.description as offer_description', 'offers.contract_type as offer_contract_type', 'offers.duration as offer_duration', 'offers.remuneration as offer_remuneration', 'offers.valid as offer_valid', 'offers.complete as offer_complete', 'offers.contact_email as offer_contact_email', 'offers.contact_phone as offer_contact_phone', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.address as company_address', 'companies.phone as company_phone')
            ->orderBy('applies.created_at', 'DESC')
            ->get()
            ->first();

        //Send the email to company with apply informations
        Mail::to($apply->offer_contact_email)->send(new SendApply((array)$apply));

        // Save on db that the apply is now valid
        $apply_db = Apply::where('id', $id)->first();
        $apply_db->setAttribute('valid', 1);
        $apply_db->save();

        // Count the total applies who need to be manage
        $applies = DB::table('applies')
            ->where('valid', '=', 0)
            ->get();

        $totalApplies = count($applies);

        return $totalApplies;
    }

    /**
     * @param $id
     * @return int
     *
     * Refuse an apply and return the total to manage
     */
    public function refuse($id)
    {
        $apply = Apply::where('id', $id)->first();

        if (isset($apply->cv_filename)) {
            File::delete(storage_path('app/public/cv') . '/' . $apply->cv_filename);
        }

        $apply->setAttribute('cv_filename', null);
        $apply->setAttribute('cv_size', null);
        $apply->setAttribute('valid', 2);
        $apply->save();

        $applies = DB::table('applies')
            ->where('valid', '=', 0)
            ->get();

        $totalApplies = count($applies);

        return $totalApplies;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show an apply on Dashboard
     */
    public function show($id)
    {
        $apply = DB::table('applies')->where('applies.id', $id)
            ->leftJoin('offers', 'applies.offer_id', '=', 'offers.id')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('applies.id as apply_id', 'applies.firstname as apply_firstname', 'applies.lastname as apply_lastname', 'applies.email as apply_email', 'applies.phone as apply_phone', 'applies.cv_filename as apply_cv_filename', 'applies.subject as apply_subject', 'applies.message as apply_message', 'applies.valid as apply_valid', 'applies.created_at as apply_created_at','offers.id as offer_id', 'users.email as company_email', 'users.role as company_role', 'offers.title as offer_title', 'offers.description as offer_description', 'offers.contract_type as offer_contract_type', 'offers.duration as offer_duration', 'offers.remuneration as offer_remuneration', 'offers.valid as offer_valid', 'offers.complete as offer_complete', 'offers.contact_email as offer_contact_email', 'offers.contact_phone as offer_contact_phone', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.address as company_address', 'companies.phone as company_phone')
            ->orderBy('applies.created_at', 'DESC')
            ->get()
            ->first();

        return view('dashboard/applies/actions/show', ['apply' => $apply]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Filter by offer id
     */
    public function filter($id)
    {
        if ("all" !== $id) {
            $offerIdFilter = intval($id);
            $applies = DB::table('applies')
                ->leftJoin('offers', 'applies.offer_id', '=', 'offers.id')
                ->leftJoin('users', 'offers.company_id', '=', 'users.id')
                ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
                ->select('applies.id as apply_id', 'applies.firstname as apply_firstname', 'applies.lastname as apply_lastname', 'applies.email as apply_email', 'applies.phone as apply_phone', 'applies.cv_filename as apply_cv_filename', 'applies.subject as apply_subject', 'applies.message as apply_message', 'applies.valid as apply_valid', 'applies.created_at as apply_created_at','offers.id as offer_id', 'users.email as company_email', 'users.role as company_role', 'offers.title as offer_title', 'offers.description as offer_description', 'offers.contract_type as offer_contract_type', 'offers.duration as offer_duration', 'offers.remuneration as offer_remuneration', 'offers.valid as offer_valid', 'offers.complete as offer_complete', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.address as company_address', 'companies.phone as company_phone')
                ->where('offers.id', '=', $id)
                ->orderBy('applies.created_at', 'DESC')
                ->paginate(10);

        } else {
            $offerIdFilter = null;
            $applies = DB::table('applies')
                ->leftJoin('offers', 'applies.offer_id', '=', 'offers.id')
                ->leftJoin('users', 'offers.company_id', '=', 'users.id')
                ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
                ->select('applies.id as apply_id', 'applies.firstname as apply_firstname', 'applies.lastname as apply_lastname', 'applies.email as apply_email', 'applies.phone as apply_phone', 'applies.cv_filename as apply_cv_filename', 'applies.subject as apply_subject', 'applies.message as apply_message', 'applies.valid as apply_valid', 'applies.created_at as apply_created_at','offers.id as offer_id', 'users.email as company_email', 'users.role as company_role', 'offers.title as offer_title', 'offers.description as offer_description', 'offers.contract_type as offer_contract_type', 'offers.duration as offer_duration', 'offers.remuneration as offer_remuneration', 'offers.valid as offer_valid', 'offers.complete as offer_complete', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.address as company_address', 'companies.phone as company_phone')
                ->orderBy('applies.created_at', 'DESC')
                ->paginate(10);

        }

        $offers = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'offers.title', 'offers.created_at', 'users.email as company_email', 'companies.name as company_name')
            ->join('applies', 'offers.id', '=', 'applies.offer_id')
            ->orderBy('offers.title')
            ->distinct()
            ->get()
            ->all();

        return view('dashboard/applies/index', ['applies' => $applies, 'offers' => $offers, 'offerIdFilter' => $offerIdFilter]);
    }
}

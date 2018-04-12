<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Apply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AppliesController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the applies page
     */
    public function index() {
        $applies = DB::table('applies')
            ->leftJoin('offers', 'applies.offer_id', '=', 'offers.id')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('applies.id as apply_id', 'applies.firstname as apply_firstname', 'applies.lastname as apply_lastname', 'applies.email as apply_email', 'applies.phone as apply_phone', 'applies.cv_filename as apply_cv_filename', 'applies.subject as apply_subject', 'applies.message as apply_message', 'applies.valid as apply_valid', 'applies.created_at as apply_created_at','offers.id as offer_id', 'users.email as company_email', 'users.role as company_role', 'offers.title as offer_title', 'offers.description as offer_description', 'offers.contract_type as offer_contract_type', 'offers.duration as offer_duration', 'offers.remuneration as offer_remuneration', 'offers.valid as offer_valid', 'offers.complete as offer_complete', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.address as company_address', 'companies.phone as company_phone')
            ->orderBy('applies.created_at', 'DESC')
            ->get();

        return view('dashboard/applies/index', ['applies' => $applies]);
    }

    /**
     * @param $id
     *
     * Delete an apply
     */
    public function delete($id)
    {
        Apply::where('id', $id)->delete();
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
            ->select('applies.id as apply_id', 'applies.firstname as apply_firstname', 'applies.lastname as apply_lastname', 'applies.email as apply_email', 'applies.phone as apply_phone', 'applies.cv_filename as apply_cv_filename', 'applies.subject as apply_subject', 'applies.message as apply_message', 'applies.valid as apply_valid', 'applies.created_at as apply_created_at','offers.id as offer_id', 'users.email as company_email', 'users.role as company_role', 'offers.title as offer_title', 'offers.description as offer_description', 'offers.contract_type as offer_contract_type', 'offers.duration as offer_duration', 'offers.remuneration as offer_remuneration', 'offers.valid as offer_valid', 'offers.complete as offer_complete', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.address as company_address', 'companies.phone as company_phone')
            ->orderBy('applies.created_at', 'DESC')
            ->get()
            ->first();

        return view('dashboard/applies/actions/show', ['apply' => $apply]);
    }
}

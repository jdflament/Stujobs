<?php
/**
 * Created by PhpStorm.
 * User: jean-davidflament
 * Date: 15/05/2018
 * Time: 09:05
 */

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CompaniesController extends Controller
{
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
            ->select('users.id', 'users.email', 'users.role', 'users.created_at', 'users.verified', 'companies.user_id', 'companies.name', 'companies.siret', 'companies.phone', 'companies.address', 'companies.description', 'companies.logo_filename', 'companies.logo_size')
            ->get()
            ->first();

        $offers = DB::table('offers')->where('company_id', $id)
            ->select('offers.id', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.created_at', 'offers.remuneration', 'offers.city', 'offers.valid', 'offers.complete')
            ->where('offers.valid', '=', 1)
            ->orderBy('offers.created_at', 'DESC')
            ->paginate(10);

        return view('website/companies/actions/show', ['company' => $company, 'offers' => $offers]);
    }
}
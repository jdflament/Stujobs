<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->where([
                ['offers.valid', '=', true],
                ['offers.complete', '=', false],
            ])
            ->select('offers.id as id_offer', 'users.id as id_company', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete', 'offers.created_at', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->get();

        return view('website/index', ['offers' => $offers]);
    }
}

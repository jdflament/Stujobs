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
    public function index(Request $request)
    {
        $offers = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->where([
                ['offers.valid', '=', true],
                ['offers.complete', '=', false],
            ])
            ->select('offers.id as id_offer', 'users.id as id_company', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete', 'offers.created_at', 'offers.city', 'offers.sector', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->orderBy('offers.created_at', 'DESC')
            ->paginate(5);

        if ($request->ajax()) {
            $view = view('website/offers/actions/load',compact('offers'))->render();
            return response()->json(['html' => $view]);
        }

        return view('website/index', ['offers' => $offers]);
    }
}

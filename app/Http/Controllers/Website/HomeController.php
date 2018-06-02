<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

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
            $contracts = $request->get('contract_type');
            $sectors = $request->get('sectors');
            $company_name = $request->get('companyFilter');
            $offer_title = $request->get('offerFilter');
            $page = $request->get('page');

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
                ->forPage($page, 5)
                ->get();

            $view = view('website/offers/actions/load', ['offers' => $offers])->render();
            return response()->json(['html' => $view]);
        }

        return view('website/index', ['offers' => $offers]);
    }
}

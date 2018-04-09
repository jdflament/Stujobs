<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the dashboard index
     */
    public function index() {
        $offersToValid = DB::table('offers')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'users.email', 'users.role', 'offers.title', 'offers.description', 'offers.contract_type', 'offers.duration', 'offers.remuneration', 'offers.valid', 'offers.complete', 'offers.created_at', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone')
            ->orderBy('offers.created_at', 'DESC')
            ->where('offers.valid', '=', 0)
            ->get()
            ->all();

        $totalEmailNewsletter = DB::table('newsletter')->count();

        $totalCompanies = DB::table('users')
            ->where([
                ['users.role', '=', 'company'],
                ['users.verified', '=', 1]
            ])
            ->count();

        $totalAdmins = DB::table('users')
            ->where([
                ['users.role', '=', 'superadmin'],
                ['users.verified', '=', 1]
            ])
            ->orWhere([
                ['users.role', '=', 'admin'],
                ['users.verified', '=', 1]
            ])
            ->count();

        return view('dashboard/index', [
            'offersToValid' => $offersToValid,
            'totalEmailNewsletter' => $totalEmailNewsletter,
            'totalCompanies' => $totalCompanies,
            'totalAdmins' => $totalAdmins,
        ]);
    }

    /**
     * @return mixed
     *
     * Get contracts type
     */
    public function contractType() {
        $contracts_type = DB::table('offers')
            ->select('offers.contract_type')
            ->get()
            ->all();

        $data = [];

        foreach($contracts_type as $contract_type) {
            if (!isset($data[$contract_type->contract_type])) {
                $data[$contract_type->contract_type] = 1;
            } else {
                $data[$contract_type->contract_type] += 1;
            }
        }

        return $data;
    }

    public function offersInformations() {
        $offers = DB::table('offers')
            ->select('offers.valid', 'offers.complete')
            ->get()
            ->all();

        $data = [
            'total' => 0,
            'valid' => 0,
            'invalid' => 0,
            'complete' => 0,
            'incomplete' => 0,
        ];

        foreach ($offers as $offer) {
            $data['total'] += 1;

            if ($offer->valid === 1) {
                $data['valid'] += 1;
            } else {
                $data['invalid'] += 1;
            }

            if ($offer->complete === 1) {
                $data['complete'] += 1;
            } else {
                $data['incomplete'] += 1;
            }
        }

        return $data;
    }

    public function offersRates() {
        $offers = DB::table('offers')
            ->select('offers.created_at')
            ->get()
            ->all();

        $data = [];

        foreach($offers as $offer) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $offer->created_at)->format('d/m/Y');
            if (!isset($data[$date])) {
                $data[$date] = 1;
            } else {
                $data[$date] += 1;
            }
        }

        return $data;
    }
}

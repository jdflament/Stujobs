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

        $appliesToValid = DB::table('applies')
            ->leftJoin('offers', 'applies.offer_id', '=', 'offers.id')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('applies.id as apply_id', 'applies.firstname as apply_firstname', 'applies.lastname as apply_lastname', 'applies.email as apply_email', 'applies.phone as apply_phone', 'applies.cv_filename as apply_cv_filename', 'applies.subject as apply_subject', 'applies.message as apply_message', 'applies.valid as apply_valid', 'applies.created_at as apply_created_at','offers.id as offer_id', 'users.email as company_email', 'users.role as company_role', 'offers.title as offer_title', 'offers.description as offer_description', 'offers.contract_type as offer_contract_type', 'offers.duration as offer_duration', 'offers.remuneration as offer_remuneration', 'offers.valid as offer_valid', 'offers.complete as offer_complete', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.address as company_address', 'companies.phone as company_phone')
            ->orderBy('applies.created_at', 'DESC')
            ->where('applies.valid', '=', 0)
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
            'appliesToValid' => $appliesToValid,
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

    /**
     * @return array
     *
     * Return offers informations
     */
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

    /**
     * @return array
     *
     * Return applies informations
     */
    public function appliesInformations() {
        $applies = DB::table('applies')
            ->select('applies.valid')
            ->get()
            ->all();

        $data = [
            'total' => 0,
            'pending' => 0,
            'valid' => 0,
            'refuse' => 0,
        ];

        foreach ($applies as $apply) {
            $data['total'] += 1;

            if ($apply->valid === 0) {
                $data['pending'] += 1;
            } else if ($apply->valid === 1) {
                $data['valid'] += 1;
            } else {
                $data['refuse'] += 1;
            }
        }

        return $data;
    }

    /**
     * @return array
     *
     * Return offers rates
     */
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

    /**
     * @return array
     *
     * Return applies rates
     */
    public function appliesRates() {
        $applies = DB::table('applies')
            ->select('applies.created_at')
            ->get()
            ->all();

        $data = [];

        foreach($applies as $apply) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $apply->created_at)->format('d/m/Y');
            if (!isset($data[$date])) {
                $data[$date] = 1;
            } else {
                $data[$date] += 1;
            }
        }

        return $data;
    }
}

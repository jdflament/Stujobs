<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
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
        return view('dashboard/index');
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
}

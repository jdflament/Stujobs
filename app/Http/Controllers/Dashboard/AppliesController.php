<?php

namespace App\Http\Controllers\Dashboard;

use App\Mail\SendApply;
use App\Mail\SendCandidateApplyAlert;
use App\Models\AppliesHistory;
use App\Models\Apply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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

        $history = AppliesHistory::where('apply_id', '=', $id)->get();
        if ($history) {
            foreach ($history as $value) {
                $value->delete();
            }
        }

        $applies = DB::table('applies')
            ->where('valid', '=', 0)
            ->get();

        $totalApplies = count($applies);

        return $totalApplies;
    }

    /**
     * @param $id
     * @param Request $request
     * @return int
     *
     * Accept an apply and return the total not valid
     */
    public function accept($id, Request $request)
    {
        $data = Input::only('accept_reason');

        $user_id = Auth::user()->id;

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
        
        // Alert the candidate that his apply was sent
        Mail::to($apply->apply_email)->send(new SendCandidateApplyAlert((array)$apply));        

        // Save on db that the apply is now valid
        $apply_db = Apply::where('id', $id)->first();
        $apply_db->setAttribute('valid', 1);
        $apply_db->save();

        // Update history of this apply
        $history = new AppliesHistory();
        $history->setAttribute('apply_id', $id);
        $history->setAttribute('user_id', $user_id);
        $history->setAttribute('column_change', 'valid');
        $history->setAttribute('column_value', 1);
        $history->setAttribute('reason', $data['accept_reason']);
        $history->save();

        // Count the total applies who need to be manage
        $applies = DB::table('applies')
            ->where('valid', '=', 0)
            ->get();


        $totalApplies = count($applies);

        return $totalApplies;
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|int
     *
     * Refuse an apply and return the total to manage
     */
    public function refuse($id, Request $request)
    {
        // Inputs errors
        $validator = Validator::make($request->all(), [
            'refuse_reason' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->getMessages()], 500);
        }

        $data = Input::only('refuse_reason');

        $user_id = Auth::user()->id;

        $apply = Apply::where('id', $id)->first();

        if (isset($apply->cv_filename)) {
            File::delete(storage_path('app/public/cv') . '/' . $apply->cv_filename);
        }

        $apply->setAttribute('cv_filename', null);
        $apply->setAttribute('cv_size', null);
        $apply->setAttribute('valid', 2);
        $apply->save();

        // Update history of this apply
        $history = new AppliesHistory();
        $history->setAttribute('apply_id', $id);
        $history->setAttribute('user_id', $user_id);
        $history->setAttribute('column_change', 'valid');
        $history->setAttribute('column_value', 2);
        $history->setAttribute('reason', $data['refuse_reason']);
        $history->save();

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
     * Show the apply history page
     */
    public function historyPage($id)
    {
        $apply = DB::table('applies')->where('applies.id', $id)
            ->leftJoin('offers', 'applies.offer_id', '=', 'offers.id')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('applies.id as apply_id', 'applies.firstname as apply_firstname', 'applies.lastname as apply_lastname', 'applies.email as apply_email', 'applies.phone as apply_phone', 'applies.cv_filename as apply_cv_filename', 'applies.subject as apply_subject', 'applies.message as apply_message', 'applies.valid as apply_valid', 'applies.created_at as apply_created_at','offers.id as offer_id', 'users.email as company_email', 'users.role as company_role', 'offers.title as offer_title', 'offers.description as offer_description', 'offers.contract_type as offer_contract_type', 'offers.duration as offer_duration', 'offers.remuneration as offer_remuneration', 'offers.valid as offer_valid', 'offers.complete as offer_complete', 'offers.contact_email as offer_contact_email', 'offers.contact_phone as offer_contact_phone', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.address as company_address', 'companies.phone as company_phone')
            ->orderBy('applies.created_at', 'DESC')
            ->get()
            ->first();

        $history = DB::table('applies_history')
            ->leftJoin('users', 'applies_history.user_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->leftJoin('admins', 'users.id', '=', 'admins.user_id')
            ->select('applies_history.id as history_id', 'applies_history.column_change as history_column_change', 'applies_history.column_value as history_column_value', 'applies_history.reason as history_reason', 'applies_history.created_at as history_created_at', 'users.email as history_user_email', 'users.id as history_user_id', 'users.role as history_user_role', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.phone as company_phone', 'companies.address as company_address', 'admins.firstname as admin_firstname', 'admins.lastname as admin_lastname', 'admins.phone as admin_phone', 'admins.office as admin_office')
            ->where('applies_history.apply_id', '=', $id)
            ->orderBy('applies_history.created_at', 'ASC')
            ->get();

        return view('dashboard/applies/actions/history', ['apply' => $apply, 'history' => $history]);
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

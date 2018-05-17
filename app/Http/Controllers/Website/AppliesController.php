<?php

namespace App\Http\Controllers\Website;

use App\Models\Apply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AppliesController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Show the applies page
     */
    public function index(Request $request) {
        $id = Auth::user()->id;

        $applies = DB::table('applies')
            ->leftJoin('offers', 'applies.offer_id', '=', 'offers.id')
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('applies.id as apply_id', 'applies.firstname as apply_firstname', 'applies.lastname as apply_lastname', 'applies.email as apply_email', 'applies.phone as apply_phone', 'applies.cv_filename as apply_cv_filename', 'applies.subject as apply_subject', 'applies.message as apply_message', 'applies.valid as apply_valid', 'applies.created_at as apply_created_at','offers.id as offer_id', 'users.id as user_id', 'users.email as company_email', 'users.role as company_role', 'offers.title as offer_title', 'offers.description as offer_description', 'offers.contract_type as offer_contract_type', 'offers.duration as offer_duration', 'offers.remuneration as offer_remuneration', 'offers.valid as offer_valid', 'offers.complete as offer_complete', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.address as company_address', 'companies.phone as company_phone')
            ->where('offers.company_id', $id)
            ->where('applies.valid', 1)
            ->orderBy('applies.created_at', 'DESC')
            ->paginate(10);

        $offers = DB::table('offers')->where('offers.company_id', $id)
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'offers.title', 'offers.created_at', 'users.id as user_id', 'users.email as company_email', 'companies.name as company_name')
            ->join('applies', 'offers.id', '=', 'applies.offer_id')
            ->orderBy('offers.title')
            ->distinct()
            ->get()
            ->all();

        return view('website/profile/applies/index', ['applies' => $applies, 'offers' => $offers]);
    }

    public function apply($id, Request $request)
    {
        // Inputs errors
        $validator = Validator::make($request->all(), [
            'apply_firstname' => 'required|string|max:100',
            'apply_lastname' => 'required|string|max:100',
            'apply_email' => 'required|email',
            'apply_phone' => 'required|numeric|phone',
            'apply_cv' => 'file|mimes:doc,docx,pdf,zip|max:1024',
            'apply_subject' => 'required|string|max:255',
            'apply_message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->getMessages()], 422);
        }

        if (isset(request()->apply_cv)) {
            $fileName = "cv_" . time() . '.' . request()->apply_cv->getClientOriginalExtension();
            $fileSize = $request->apply_cv->getClientSize();

            $request->apply_cv->storeAs('public/cv', $fileName);
        }

        $data = Input::only('apply_firstname', 'apply_lastname', 'apply_email', 'apply_phone', 'apply_subject', 'apply_message');

        $apply = new Apply();
        $apply->setAttribute('offer_id', $id);
        $apply->setAttribute('firstname', $data['apply_firstname']);
        $apply->setAttribute('lastname', $data['apply_lastname']);
        $apply->setAttribute('email', $data['apply_email']);
        $apply->setAttribute('phone', $data['apply_phone']);

        if (isset(request()->apply_cv)) {
            $apply->setAttribute('cv_filename', $fileName);
            $apply->setAttribute('cv_size', $fileSize);
        }

        $apply->setAttribute('subject', $data['apply_subject']);
        $apply->setAttribute('message', $data['apply_message']);
        $apply->save();

        return redirect('/offers/' . $id)->with('success', 'Votre candidature a bien été envoyée.');
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

        return view('website/profile/applies/actions/show', ['apply' => $apply]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Filter by offer id
     */
    public function filter($id)
    {
        $company_id = Auth::user()->id;

        if ("all" !== $id) {
            $offerIdFilter = intval($id);
            $applies = DB::table('applies')
                ->leftJoin('offers', 'applies.offer_id', '=', 'offers.id')
                ->leftJoin('users', 'offers.company_id', '=', 'users.id')
                ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
                ->select('applies.id as apply_id', 'applies.firstname as apply_firstname', 'applies.lastname as apply_lastname', 'applies.email as apply_email', 'applies.phone as apply_phone', 'applies.cv_filename as apply_cv_filename', 'applies.subject as apply_subject', 'applies.message as apply_message', 'applies.valid as apply_valid', 'applies.created_at as apply_created_at','offers.id as offer_id', 'users.email as company_email', 'users.role as company_role', 'offers.title as offer_title', 'offers.description as offer_description', 'offers.contract_type as offer_contract_type', 'offers.duration as offer_duration', 'offers.remuneration as offer_remuneration', 'offers.valid as offer_valid', 'offers.complete as offer_complete', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.address as company_address', 'companies.phone as company_phone')
                ->where('offers.id', '=', $id)
                ->where('applies.valid', 1)
                ->orderBy('applies.created_at', 'DESC')
                ->paginate(10);
        } else {
            $offerIdFilter = null;
            $applies = DB::table('applies')
                ->leftJoin('offers', 'applies.offer_id', '=', 'offers.id')
                ->leftJoin('users', 'offers.company_id', '=', 'users.id')
                ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
                ->select('applies.id as apply_id', 'applies.firstname as apply_firstname', 'applies.lastname as apply_lastname', 'applies.email as apply_email', 'applies.phone as apply_phone', 'applies.cv_filename as apply_cv_filename', 'applies.subject as apply_subject', 'applies.message as apply_message', 'applies.valid as apply_valid', 'applies.created_at as apply_created_at','offers.id as offer_id', 'users.id as user_id', 'users.email as company_email', 'users.role as company_role', 'offers.title as offer_title', 'offers.description as offer_description', 'offers.contract_type as offer_contract_type', 'offers.duration as offer_duration', 'offers.remuneration as offer_remuneration', 'offers.valid as offer_valid', 'offers.complete as offer_complete', 'companies.name as company_name', 'companies.siret as company_siret', 'companies.address as company_address', 'companies.phone as company_phone')
                ->where('offers.company_id', $company_id)
                ->where('applies.valid', 1)
                ->orderBy('applies.created_at', 'DESC')
                ->paginate(10);

        }

        $offers = DB::table('offers')->where('offers.company_id', $company_id)
            ->leftJoin('users', 'offers.company_id', '=', 'users.id')
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('offers.id', 'offers.title', 'offers.created_at', 'users.id as user_id', 'users.email as company_email', 'companies.name as company_name')
            ->join('applies', 'offers.id', '=', 'applies.offer_id')
            ->orderBy('offers.title')
            ->distinct()
            ->get()
            ->all();

        return view('website/profile/applies/index', ['applies' => $applies, 'offers' => $offers, 'offerIdFilter' => $offerIdFilter]);
    }
}

<?php

namespace App\Http\Controllers\Website;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function getEmail(Request $request)
    {
        // Inputs errors
        $validator = Validator::make($request->all(), [
            'newsletter_email' => 'required|email',
            'newsletter_terms' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->getMessages()], 422);
        }
        
        $newsletter = new Newsletter();

        $data = Input::only('newsletter_email','newsletter_sectors','newsletter_contract_type');

        $newsletter->setAttribute('email', $data["newsletter_email"]);
        
        if(is_array($data["newsletter_sectors"])){
            $newsletter_sectors = implode(',', $data['newsletter_sectors']);
            $newsletter->setAttribute('params_sector', $newsletter_sectors);
        }
        else {
            $newsletter->setAttribute('params_sector', $data['newsletter_sectors']);
        }
        if(is_array($data["newsletter_contract_type"])){
            $newsletter_contract = implode(',', $data['newsletter_contract_type']);
            $newsletter->setAttribute('params_contract', $newsletter_contract);
        }
        else {
            $newsletter->setAttribute('params_contract', $data['newsletter_contract_type']);
        }
        $newsletter->save();

        return redirect('/')->with('success', 'Votre inscription à la newsletter a bien été prise en compte');
        
    }
}
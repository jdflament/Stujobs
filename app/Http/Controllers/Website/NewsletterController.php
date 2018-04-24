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
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->getMessages()], 422);
        }

        $data = Input::only('newsletter_email');

        $newsletter = new Newsletter();
        $newsletter->setAttribute('email', $data["newsletter_email"]);
        $newsletter->save();
        
    }
}
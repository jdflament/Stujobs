<?php

namespace App\Http\Controllers\Website;

use App\Models\Apply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AppliesController extends Controller
{
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
            return redirect('/offers/' . $id)
                ->withErrors($validator)
                ->withInput();
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
}

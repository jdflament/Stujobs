<?php

namespace App\Http\Controllers\Website;

use App\Models\Company;
use App\Models\User;
use App\Models\Offer;
use App\Models\Apply;
use App\Models\OffersHistory;
use App\Models\AppliesHistory;
use App\Models\GuestData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\DownloadDataVerify;
use App\Mail\DeleteDataVerify;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DataController extends Controller
{
    public function index()
    {
        return view('website/informations/index');
    }

    public function downloadData(Request $request)
    {
        // Inputs errors
        $validator = Validator::make($request->all(), [
            'download_email' => 'required|email|',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->getMessages()], 422);
        }
        $download_email = Input::only('download_email');
        $code = $this->generateRandomString(5);

        $guestData = new GuestData();
        $guestData->setAttribute('email', $download_email['download_email']);
        $guestData->setAttribute('code', $code);
        $guestData->save(); 

        Mail::to($download_email['download_email'])->send(new DownloadDataVerify($code, $download_email['download_email']));

        return redirect()->route('informations')->with('success', 'Votre code de vérification à été envoyé');
        
    }
    public function deleteData(Request $request)
    {
        // Inputs errors
        $validator = Validator::make($request->all(), [
            'delete_email' => 'required|email|',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->getMessages()], 422);
        }
        $delete_email = Input::only('delete_email');
        $code = $this->generateRandomString(5);

        $guestData = new GuestData();
        $guestData->setAttribute('email', $delete_email['delete_email']);
        $guestData->setAttribute('code', $code);
        $guestData->save(); 

        Mail::to($delete_email['delete_email'])->send(new DeleteDataVerify($code, $delete_email['delete_email']));

        return redirect()->route('informations')->with('success', 'Votre code de vérification à été envoyé');
        
    }

    public function generateRandomString($length = 10) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function outputCSV($data_applies,$data_applies_history,$file_name = 'export_stujobs.csv') 
    {
         # Start the ouput
         $output = fopen("php://output", "w");
         
         if(!empty($data_applies)){
            fputcsv($output, array("Vos candidatures :"));
            fputcsv($output, array("\n"));
            fputcsv($output, array('ID', 'Offer_id', 'Prénom', 'Nom', 'Email', 'CV', 'Taille du CV', 'Sujet', 'Message', 'Validée', 'Date de création', 'Date de modification'));
            # Then loop through the rows
            foreach ($data_applies as $row) {
                # Add the rows to the body
                fputcsv($output, $row); // here you can change delimiter/enclosure
            }
         }
         else {
            fputcsv($output, array("Aucune données vous concernant"));
         }
         if(!empty($data_applies_history)){
            fputcsv($output, array("\n"));
            fputcsv($output, array("Historique de vos candidatures :"));
            fputcsv($output, array("\n"));
            fputcsv($output, array('ID', 'Apply_id', 'User_id', 'Colonne modifiée', 'Valeur de changement', 'Date de création', 'Date de modification','Motif'));
            # Then loop through the rows
            foreach ($data_applies_history as $row) {
                # Add the rows to the body
                fputcsv($output, $row); // here you can change delimiter/enclosure
            }
         }
         # Close the stream off
         fclose($output);
     }
     public function checkPageDownload()
     {
        return view('website/informations/check/download');

     }
     public function checkPageDelete()
     {
        return view('website/informations/check/delete');

     }
     public function checkCodeDownload(Request $request)
     {
        // Inputs errors
        $validator = Validator::make($request->all(), [
            'code_check' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->getMessages()], 422);
        }
        $code = Input::only('code_check');
        $guest_email= Input::only('guest_email');

        $check = GuestData::where('email', '=', $guest_email['guest_email'])->first();
        $data_applies = array();
        $data_applies_history = array();
        if (strcmp($code['code_check'], $check->code) == 0) {
            $applies = Apply::where('email', '=', $check->email)->get()->toArray();
            foreach($applies as $apply){
                $apply_history = AppliesHistory::where('apply_id', '=', $apply["id"])->get()->toArray();
                    if ($apply_history) {
                        foreach ($apply_history as $val) {
                            array_push($data_applies_history, $val);
                        }
                    }
                array_push($data_applies, $apply);
            }
            $check->delete();

            $response = new StreamedResponse();
            $response->setCallback(function() use ($data_applies, $data_applies_history) {
                $this->outputCSV($data_applies,$data_applies_history);
            });
            $response->setStatusCode(200);
            $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
            $response->headers->set('Content-Disposition','attachment; filename=export_stujobs.csv');
        }
        else {
            dd('Le code ne correspond pas');
        }
        
        return $response;
        
     }
     public function checkCodeDelete(Request $request)
     {
        // Inputs errors
        $validator = Validator::make($request->all(), [
            'code_check' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->getMessages()], 422);
        }
        $code = Input::only('code_check');
        $guest_email= Input::only('guest_email');

        $check = GuestData::where('email', '=', $guest_email['guest_email'])->first();

        if (strcmp($code['code_check'], $check->code) == 0) {
            $applies = Apply::where('email', '=', $check->email)->get();
            foreach($applies as $apply){
                $apply_history = AppliesHistory::where('apply_id', '=', $apply["id"])->get();
                    if ($apply_history) {
                        foreach ($apply_history as $val) {
                            $val->delete();
                        }
                    }
                    $apply->delete();
            }
            $check->delete();
            $response = "ok";

        }
        else {
            dd('Le code ne correspond pas');
        }

        return $response;
        
     }

}
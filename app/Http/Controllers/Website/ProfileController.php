<?php

namespace App\Http\Controllers\Website;

use App\Models\Company;
use App\Models\User;
use App\Models\Offer;
use App\Models\Apply;
use App\Models\OffersHistory;
use App\Models\AppliesHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = Auth::user()->id;
        $company = DB::table('users')->where('users.id', $id)
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('users.id', 'users.email', 'users.role', 'users.created_at', 'companies.user_id', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone', 'companies.description', 'companies.logo_filename', 'companies.logo_size')
            ->get()
            ->first();

        return view('website/profile/index', ['company' => $company]);
    }


    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Edit the company profile
     */
    public function edit(Request $request)
    {
        $id = Auth::user()->id;
        
        // Inputs errors
        $validator = Validator::make($request->all(), [
            'edit_email' => 'required|email|min:6|max:255|unique:users,email,'.$id,
            'edit_name' => 'required',
            'edit_logo' => 'image|mimes:jpg,jpeg,png,gif,svg,bmp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('profile/edit')
            ->withErrors($validator)
            ->withInput()
            ->with('danger', "Vos changements n'ont pas été pris en compte. Veuillez vérifier vos champs.");
        }

        if (isset(request()->edit_logo)) {
            $logoName = "logo_" . time() . '.' . request()->edit_logo->getClientOriginalExtension();
            $logoSize = $request->edit_logo->getClientSize();

            $request->edit_logo->storeAs('public/logos', $logoName);
        }

        $user_data = Input::only('edit_email');
        $company_data = Input::only('edit_name', 'edit_siret', 'edit_address', 'edit_phone', 'edit_description');

        $user = User::where('id', $id)->first();
        $user->setAttribute('email', $user_data['edit_email']);
        $user->save();

        $company = Company::where(['user_id' => $id])->first();
        $company->setAttribute('name', $company_data['edit_name']);
        $company->setAttribute('siret', $company_data['edit_siret']);
        $company->setAttribute('address', $company_data['edit_address']);
        $company->setAttribute('phone', $company_data['edit_phone']);

        if (isset(request()->edit_logo)) {
            if (isset($company->logo_filename)) {
                File::delete(storage_path('app/public/logos') . '/' . $company->logo_filename);
            }
            $company->setAttribute('logo_filename', $logoName);
            $company->setAttribute('logo_size', $logoSize);
        }

        $company->setAttribute('description', $company_data['edit_description']);
        $company->save();

        return redirect()->route('indexProfile')->with('success', 'Votre profil a été correctement modifié.');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Display the profile edit page
     */
    public function editPage()
    {
        $id = Auth::user()->id;
        $company = DB::table('users')->where('users.id', $id)
            ->leftJoin('companies', 'users.id', '=', 'companies.user_id')
            ->select('users.id', 'users.email', 'users.role', 'users.created_at', 'companies.user_id', 'companies.name', 'companies.siret', 'companies.address', 'companies.phone', 'companies.description', 'companies.logo_filename', 'companies.logo_size')
            ->get()
            ->first();

        return view('website/profile/actions/edit', ['company' => $company]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Change the current user password
     */
    public function changePassword(Request $request)
    {

        // Inputs errors
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string|min:6|max:255',
            'new_password' => 'required|string|min:6',
            'new_password_confirm' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->getMessages()], 422);
        }

        $pass = Auth::user()->password;
        $current_password = Input::only('current_password');
        $new_password = Input::only('new_password', 'new_password_confirm');

        if(Hash::check($current_password["current_password"], $pass)) {

            if(!strcmp($current_password["current_password"], $new_password["new_password"]) == 0){

                if(strcmp($new_password["new_password"], $new_password["new_password_confirm"]) == 0){
                    //Change Password
                    $user = Auth::user();
                    $user->password = bcrypt($new_password["new_password"]);
                    $user->save();
                } else {
                    // New passwords don't match
//                    return response()->json(['error' => Lang::get('errors.' . 468)], 468);
                    return response()->json(['error' => Lang::get('errors.' . 468)], 468);
                }
            }
            else {
                // New password like the current
                return response()->json(['error' => Lang::get('errors.' . 469)], 469);
            }

        }
        else {
            // User password invalid
            return response()->json(['error' => Lang::get('errors.' . 470)], 470);
        }

        return redirect()->route('indexProfile');

    }
    public function settings()
    {
        return view('website/profile/settings/index');
    }
    public function deleteData(Request $request)
    {
        
        // Inputs errors
        $validator = Validator::make($request->all(), [
            'delete_password' => 'required|string|min:6|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->getMessages()], 422);
        }
        $id = Auth::user()->id;    
        $pass = Auth::user()->password;
        $delete_password = Input::only('delete_password');


        if(Hash::check($delete_password["delete_password"], $pass)) {
            // Password correct, delete all data form all tables in DB
            $company = Company::where('user_id', $id)->get()->first();
            $id_company = $company->id;
            $offers = Offer::where('company_id', '=', $id)->get();
            if ($offers) {
                foreach ($offers as $value) {
                    $offer_history = OffersHistory::where('offer_id', '=', $value->id)->get();
                    if ($offer_history) {
                        foreach ($offer_history as $line) {
                            // Delete offer history
                            $line->delete();
                        }
                    }
                    $applies = Apply::where('offer_id', '=', $value->id)->get();
                    if ($applies) {
                        foreach ($applies as $apply) {
                            if (isset($apply->cv_filename)) {
                                // Delete CV file
                                File::delete(storage_path('app/public/cv') . '/' . $apply->cv_filename);
                            }
                            $apply_history = AppliesHistory::where('apply_id', '=', $apply->id)->get();
                            if ($apply_history) {
                                foreach ($apply_history as $val) {
                                    // Delete apply history
                                    $val->delete();
                                }
                            }
                            // Delete apply
                            $apply->delete();
                        }
                    }
                    // Delete offer
                    $value->delete();
                }
            }
            // Delete form company table
            Company::where('user_id', $id)->delete();
            // Delete form verify_users table            
            DB::table('verify_users')->where('user_id', $id)->delete();
            // Delete form users table
            User::where('id', $id)->delete();

        }
        else {
            // User password invalid
            return response()->json(['error' => Lang::get('errors.' . 470)], 470);
        }

        return response()->json("ok");
    }
    public function downloadData(Request $request)
    {
        // Inputs errors
        $validator = Validator::make($request->all(), [
            'download_password' => 'required|string|min:6|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->getMessages()], 422);
        }
        $id = Auth::user()->id;    
        $pass = Auth::user()->password;
        $download_password = Input::only('download_password');


        if(Hash::check($download_password["download_password"], $pass)) {
            // Password correct, delete all data form all tables in DB
            $data_user = array();
            $data_company = array();
            $data_offers = array();
            $data_offers_history = array();
            $data_applies = array();
            $data_applies_history = array();
            
            $user = Auth::user()->toArray();
            array_push($data_user, $user);            
            $company = Company::where('user_id', $id)->get()->first()->toArray();
            array_push($data_company, $company);            
            $id_company = $company["id"];
            $offers = Offer::where('company_id', '=', $id)->get()->toArray();
            if($offers){
                foreach($offers as $offer){
                    array_push($data_offers, $offer);
                    $offer_history = OffersHistory::where('offer_id', '=', $offer["id"])->get()->toArray();
                    if ($offer_history) {
                        foreach ($offer_history as $line) {
                            array_push($data_offers_history, $line);
                        }
                    }
                    $applies = Apply::where('offer_id', '=', $offer["id"])->get()->toArray();
                    if ($applies) {
                        foreach ($applies as $apply) {
                            $apply_history = AppliesHistory::where('apply_id', '=', $apply["id"])->get()->toArray();
                            if ($apply_history) {
                                foreach ($apply_history as $val) {
                                    array_push($data_applies_history, $val);
                                }
                            }
                            array_push($data_applies, $apply);
                        }
                    }
                }
            }
            $response = new StreamedResponse();
            $response->setCallback(function() use ($data_user, $data_company, $data_offers, $data_offers_history, $data_applies, $data_applies_history) {
                $this->outputCSV($data_user,$data_company,$data_offers,$data_offers_history,$data_applies,$data_applies_history,'export_stujobs.csv');
            });
            $response->setStatusCode(200);
            $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
            $response->headers->set('Content-Disposition','attachment; filename=export_stujobs.csv');

            return $response;

        }
        else {
            // User password invalid
            return response()->json(['error' => Lang::get('errors.' . 470)], 470);
        }

    }
    public function outputCSV($data_user,$data_company,$data_offers,$data_offers_history,$data_applies,$data_applies_history,$file_name = 'export_stujobs.csv') 
    {  
        # Start the ouput
         $output = fopen("php://output", "w");
         fputcsv($output, array("Informations utilisateur :"));
         fputcsv($output, array("\n"));

         if(!empty($data_user)){
            fputcsv($output, array('ID', 'Email', 'Date de création', 'Date de modification', 'Rôle','Vérifié'));
            # Then loop through the rows
            foreach ($data_user as $row) {
                # Add the rows to the body
                fputcsv($output, $row); // here you can change delimiter/enclosure
            }
         }
         fputcsv($output, array("\n"));
         fputcsv($output, array("Informations entreprise :"));
         fputcsv($output, array("\n"));
         if(!empty($data_company)){
            fputcsv($output, array('ID', 'User_id', 'Nom', 'Siret', 'Adresse', 'Téléphone', 'Date de création', 'Date de modification', 'Description'));
            # Then loop through the rows
            foreach ($data_company as $row) {
                # Add the rows to the body
                fputcsv($output, $row); // here you can change delimiter/enclosure
            }
         }

         if(!empty($data_offers)){
            fputcsv($output, array("\n"));
            fputcsv($output, array("Vos offres :"));
            fputcsv($output, array("\n"));
            fputcsv($output, array('ID', 'Company_id', 'Titre', 'Description', 'Type de contrat', 'Durée', 'Rémunération', 'Validée', 'Date de création', 'Date de modification', 'Terminée', 'Contact Email', 'Contact Téléphone', 'Ville', 'Domaine activité'));
            # Then loop through the rows
            foreach ($data_offers as $row) {
                # Add the rows to the body
                fputcsv($output, $row); // here you can change delimiter/enclosure
            }
         }

         if(!empty($data_offers_history)){
            fputcsv($output, array("\n"));
            fputcsv($output, array("Historique de vos offres :"));
            fputcsv($output, array("\n"));
            fputcsv($output, array('ID', 'Offer_id', 'User_id', 'Colonne modifiée', 'Valeur de changement', 'Date de création', 'Date de modification','Motif'));
            # Then loop through the rows
            foreach ($data_offers_history as $row) {
                # Add the rows to the body
                fputcsv($output, $row); // here you can change delimiter/enclosure
            }
         }

         if(!empty($data_applies)){
            fputcsv($output, array("\n"));
            fputcsv($output, array("Candidatures à vos offres :"));
            fputcsv($output, array("\n"));
            fputcsv($output, array('ID', 'Offer_id', 'Prénom', 'Nom', 'Email', 'CV', 'Taille du CV', 'Sujet', 'Message', 'Validée', 'Date de création', 'Date de modification'));
            # Then loop through the rows
            foreach ($data_applies as $row) {
                # Add the rows to the body
                fputcsv($output, $row); // here you can change delimiter/enclosure
            }
         }

         if(!empty($data_applies_history)){
            fputcsv($output, array("\n"));
            fputcsv($output, array("Historique des candidatures à vos offres :"));
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
}

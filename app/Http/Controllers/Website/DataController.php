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

class DataController extends Controller
{
    public function index()
    {
        return view('website/informations/index');
    }
    public function deleteData(Request $request)
    {
    }

    public function downloadData(Request $request)
    {
    }
    public function outputCSV($data,$file_name = 'data_stujobs.csv') {
        # output headers so that the file is downloaded rather than displayed
         header("Content-Type: text/csv");
         header("Content-Disposition: attachment; filename=$file_name");
         # Disable caching - HTTP 1.1
         header("Cache-Control: no-cache, no-store, must-revalidate");
         # Disable caching - HTTP 1.0
         header("Pragma: no-cache");
         # Disable caching - Proxies
         header("Expires: 0");
     
         # Start the ouput
         $output = fopen("php://output", "w");
         
          # Then loop through the rows
         foreach ($data as $row) {
             # Add the rows to the body
             fputcsv($output, $row); // here you can change delimiter/enclosure
         }
         # Close the stream off
         fclose($output);
     }

}
<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LegalsController extends Controller
{
    public function index(Request $request)
    {
        return view('website/legals');
    }
}

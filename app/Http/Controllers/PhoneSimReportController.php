<?php

namespace App\Http\Controllers;

use App\Exports\PhoneSimReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PhoneSimReportController extends Controller
{
    public function index(){
        $sites = DB::table('sites')->orderBy('name', 'asc')->get();
        $departments = DB::table('departments')->where('id', '!=', 1)->orderBy('name', 'asc')->get();

        return view('inventory.phone-sim-report', compact('sites', 'departments'));
    }

    public function generate(Request $request){
        $formInput = $request->only(['item', 'sites', 'departments']);

        $filename = date('m_hi_s').'_PHONE_SIM_REPORT';

        return Excel::download(new PhoneSimReport($formInput), $filename.'.xlsx');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index(){
        $sites = DB::table('sites')->get();

        return view('admin.system-management.sites', compact('sites'));
    }

    public function add(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $name = strtoupper($request->name);

        $IT = new Site();
        $IT->name = $name;
        $IT->save();

        return redirect()->back();
    }

    public function edit(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $IT_id = $request->id;
        $IT_name = strtoupper($request->name);

        DB::update('UPDATE sites SET name=? WHERE id = ?', [$IT_name, $IT_id]);

        return redirect()->back();
    }

    public function delete(Request $request){
        $IT_id = $request->id;

        DB::delete('delete FROM sites where id = ?', [$IT_id]);

        return redirect()->back();
    }
}

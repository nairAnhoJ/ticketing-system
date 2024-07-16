<?php

namespace App\Http\Controllers;

use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketCategoryController extends Controller
{
    public function index(){
        $inCharge = DB::table('dept_in_charges')->first();
        $deptInCharge = $inCharge->dept_id;
        $categories = TicketCategory::with('user')->get();
        $dics = DB::table('users')->where('dept_id', $deptInCharge)->orderBy('name', 'asc')->get();
        $depts = DB::table('departments')->orderBy('name', 'asc')->get();

        return view('admin.system-management.ticket-category', compact('categories', 'depts', 'deptInCharge', 'dics'));
    }

    public function add(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $name = strtoupper($request->name);

        $cat = new TicketCategory();
        $cat->name = $name;
        $cat->in_charge = $request->inchargeUser;
        $cat->save();

        return redirect()->back();
    }

    public function edit(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $cat_id = $request->id;
        $cat_name = strtoupper($request->name);

        $cat = TicketCategory::where('id', $cat_id)->first();
        $cat->name = $cat_name;
        $cat->in_charge = $request->inchargeUser;
        $cat->save();

        return redirect()->back();
    }

    public function delete(Request $request){
        $cat_id = $request->id;

        DB::delete('delete FROM ticket_categories where id = ?', [$cat_id]);

        return redirect()->back();
    }
}

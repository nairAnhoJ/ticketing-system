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
        $categories = DB::table('ticket_categories')->get();
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
        $cat->save();

        return redirect()->back();
    }

    public function edit(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $cat_id = $request->id;
        $cat_name = strtoupper($request->name);

        DB::update('UPDATE ticket_categories SET name=? WHERE id = ?', [$cat_name, $cat_id]);

        return redirect()->back();
    }

    public function delete(Request $request){
        $cat_id = $request->id;

        DB::delete('delete FROM ticket_categories where id = ?', [$cat_id]);

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        $inCharge = DB::table('dept_in_charges')->first();
        $deptInCharge = $inCharge->dept_id;
        $depts = DB::table('departments')->orderBy('name', 'asc')->where('id','!=','1')->get();
        $users = DB::table('users')->where('id','!=','1')->get();
        $dics = DB::table('users')->where('dept_id', $deptInCharge)->where('id', '!=', '1')->orderBy('name', 'asc')->get();
        return view('admin.system-management.department', compact('depts', 'dics', 'deptInCharge','users'));
    }

    public function add(Request $request){
        $dept_name = strtoupper($request->name);

        $request->validate([
            'name' => 'required',
            'inchargeUser' => 'required',
        ]);

        $dept = new Department();
        $dept->name = $dept_name;
        $dept->in_charge = $request->inchargeUser;
        $dept->save();

        return redirect()->back();
    }

    public function edit(Request $request){
        $dept_id = $request->id;
        $dept_name = strtoupper($request->name);

        $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);

        DB::update('update departments set name = ?, in_charge = ? where id = ?', [$dept_name, $request->inchargeUser, $dept_id]);

        return redirect()->route('department.index');
    }

    public function delete(Request $request){
        $deptInCharge = (DB::table('dept_in_charges')->where('id', '1')->get())[0]->dept_id;
        $dept_id = $request->id;

        if($deptInCharge != $dept_id){
            DB::delete('delete FROM departments where id = ?', [$dept_id]);
        }
        return redirect()->route('department.index');
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\ItemType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemTypeController extends Controller
{
    
    public function index(){
        $itemTypes = DB::table('item_types')->get();

        return view('admin.system-management.item-type', compact('itemTypes'));
    }

    public function add(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $name = strtoupper($request->name);

        $IT = new ItemType();
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

        DB::update('UPDATE item_types SET name=? WHERE id = ?', [$IT_name, $IT_id]);

        return redirect()->back();
    }

    public function delete(Request $request){
        $IT_id = $request->id;

        DB::delete('delete FROM item_types where id = ?', [$IT_id]);

        return redirect()->back();
    }
}

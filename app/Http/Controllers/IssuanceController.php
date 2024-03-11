<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IssuanceController extends Controller
{
    public function store(Request $request){
        $id = $request->id;

        $res = array(
            "cost" => '1',
            "color" => '1',
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PhoneSim;
use App\Models\PhoneSimRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhoneSimRequestController extends Controller
{
    public function index(){
        $reqs = DB::select('SELECT phone_sim_requests.id, phone_sim_requests.pr_no, phone_sim_requests.item, phone_sim_requests.description, phone_sim_requests.remarks, phone_sim_requests.req_by, sites.name AS site, phone_sim_requests.status, phone_sim_requests.date_req, phone_sim_requests.date_del FROM phone_sim_requests INNER JOIN sites ON phone_sim_requests.site = sites.id ORDER BY phone_sim_requests.id DESC');

        return view('request.phone-sim', compact('reqs'));
    }

    public function add(){
        $sites = DB::table('sites')->orderBy('name', 'asc')->get();
        $Action = "add";
        $Item = '';
        $ItemID = '';
        $PRNo = '';
        $Description = '';
        $Remarks = '';
        $Req_by = '';
        $Status = '';
        $Site = '';
        $DateRequested = date('m/d/Y');
        $DateDelivered = date('m/d/Y');

        return view('request.phone-sim-add-edit', compact('Action', 'ItemID', 'Item', 'PRNo', 'Description', 'Remarks', 'Req_by', 'Status', 'DateRequested', 'DateDelivered', 'sites', 'Site'));
    }

    public function store(Request $request){
        $pr_no = strtoupper($request->pr_no);
        $item = $request->item;
        $description = strtoupper($request->description);
        $remarks = $request->remarks;
        $req_by = strtoupper($request->req_by);
        $site = $request->site;
        $status = $request->status;
        $date_req = $request->date_req;
        $date_del = 'N/A';
        if($status == 'DELIVERED'){
            $date_del = $request->date_del;
        }

        $request->validate([
            'pr_no' => 'required',
            'description' => 'required',
            'remarks' => 'required',
            'req_by' => 'required',
        ]);

        $req = new PhoneSimRequest();
        $req->pr_no = $pr_no;
        $req->item = $item;
        $req->description = $description;
        $req->remarks = $remarks;
        $req->req_by = $req_by;
        $req->site = $site;
        $req->status = $status;
        $req->date_req = $date_req;
        $req->date_del = $date_del;
        $req->save();

        return redirect()->route('reqPhoneSim.index');
    }

    public function edit($id){
        $req = PhoneSimRequest::find($id);
        $sites = DB::table('sites')->orderBy('name', 'asc')->get();

        $Action = "edit";
        $ItemID = $req->id;
        $PRNo = $req->pr_no;
        $Item = $req->item;
        $Description = $req->description;
        $Remarks = $req->remarks;
        $Req_by = $req->req_by;
        $Site = $req->site;
        $Status = $req->status;
        $DateRequested = $req->date_req;
        $DateDelivered = $req->date_del;

        return view('request.phone-sim-add-edit', compact('Action', 'ItemID', 'PRNo', 'Item', 'Description', 'Remarks', 'Req_by', 'Site', 'Status', 'DateRequested', 'DateDelivered', 'sites'));
    }

    public function update(Request $request){
        $itemID = $request->itemID;
        $pr_no = strtoupper($request->pr_no);
        $description = strtoupper($request->description);
        $remarks = $request->remarks;
        $req_by = strtoupper($request->req_by);
        $site = $request->site;
        $date_req = $request->date_req;

        $request->validate([
            'pr_no' => 'required',
            'description' => 'required',
            'remarks' => 'required',
            'req_by' => 'required',
        ]);

        DB::update('UPDATE phone_sim_requests SET phone_sim_requests.pr_no=?, phone_sim_requests.description=?, phone_sim_requests.remarks=?, phone_sim_requests.req_by=?, phone_sim_requests.site=?, phone_sim_requests.date_req=? WHERE phone_sim_requests.id=?', [$pr_no, $description, $remarks, $req_by, $site, $date_req, $itemID]);

        return redirect()->route('reqPhoneSim.index');
    }

    public function delete(Request $request){
        DB::delete('DELETE FROM phone_sim_requests WHERE phone_sim_requests.id=?', [$request->deleteID]);
        return redirect()->route('reqPhoneSim.index');
    }

    public function statusUpdate(Request $request){
        $id = $request->reqID;
        $status = $request->updateStatus;
        if($status == 'DELIVERED'){
            $st = (DB::table('phone_sim_requests')->where('id', $id)->first())->status;
            if($st == 'REQUESTED'){
                return redirect( url('/request/phone-sim/delivered/'.$id) );
            }else{
                return redirect()->route('reqPhoneSim.index');
            }
        }else if($status == 'DECLINED'){
            DB::update('UPDATE item_requests SET item_requests.status=? WHERE item_requests.id=?', [$status, $id]);
            return redirect()->route('reqPhoneSim.index');
        }
    }

    public function statusD($id){
        $st = (DB::table('phone_sim_requests')->where('id', $id)->first())->status;
        if($st == 'REQUESTED'){
            $req = DB::select('SELECT phone_sim_requests.id, phone_sim_requests.pr_no, phone_sim_requests.item, phone_sim_requests.description, phone_sim_requests.remarks, phone_sim_requests.req_by, phone_sim_requests.site, sites.name AS site_name, phone_sim_requests.status, phone_sim_requests.date_req, phone_sim_requests.date_del FROM phone_sim_requests INNER JOIN sites ON phone_sim_requests.site = sites.id WHERE phone_sim_requests.id = ?', [$id]);
    
            return view('request.phone-sim-delivered', compact('id', 'req'));
        }else{
            return redirect()->route('reqPhoneSim.index');
        }
    }

    public function statusDelivered(Request $request){
        $reqID = $request->reqID;
        $item = $request->item;
        $serial_no = $request->serial_no;
        $description = $request->description;
        // $invoice = $request->invoice;
        $date_del = $request->date_del;
        $user = $request->req_by;
        $site = $request->site;

        $request->validate([
            'serial_no' => 'required',
            // 'invoice' => 'required',
            'date_del' => 'required'
        ]);

        $invoicePath = 'N/A';
        // $newDate_del = date("mdY", strtotime($date_del));
        // $newID = (DB::table('phone_sims')->orderByDesc('id')->first())->id + 1;
        // $invoicePath = $request->file('invoice')->storeAs('invoice/phone-sim/'.date('mY'), $newID.'-'.$newDate_del.'.'.$request->file('invoice')->getClientOriginalExtension(), 'public');

        $PhoneSim = new PhoneSim();
        $PhoneSim->item = $item;
        $PhoneSim->user = $user;
        $PhoneSim->desc = strtoupper($description);
        $PhoneSim->serial_no = strtoupper($serial_no);
        $PhoneSim->remarks = 'Not yet deployed';
        $PhoneSim->site = $site;
        $PhoneSim->status = 'Delivered';
        $PhoneSim->invoice = $invoicePath;
        $PhoneSim->date_del = $date_del;
        $PhoneSim->save();

        DB::update('UPDATE phone_sim_requests SET phone_sim_requests.status=?, phone_sim_requests.date_del=? WHERE phone_sim_requests.id=?', ['DELIVERED', $date_del, $reqID]);

        return redirect()->route('reqPhoneSim.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PhoneSim;
use App\Models\PhoneSimHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PhoneSimController extends Controller
{
    // public function index(){
    //     $items = DB::select('SELECT phone_sims.id, phone_sims.item, phone_sims.user, phone_sims.desc, phone_sims.serial_no, phone_sims.remarks, phone_sims.site, sites.name AS site_name, phone_sims.status, phone_sims.invoice, phone_sims.date_del, phone_sims.is_Defective FROM phone_sims INNER JOIN sites ON phone_sims.site = sites.id WHERE phone_sims.is_Defective = 0 ORDER BY phone_sims.id desc');
    //     return view('inventory.phone-sim', compact('items'));
    // }

    public function index(){
        $items = DB::table('phone_sims')
            ->select('phone_sims.id', 'phone_sims.item', 'phone_sims.user', 'departments.name as dept', 'phone_sims.desc', 'phone_sims.serial_no', 'phone_sims.remarks', 'phone_sims.site', 'sites.name AS site_name', 'phone_sims.status', 'phone_sims.invoice', 'phone_sims.date_del', 'phone_sims.date_issued', 'phone_sims.is_Defective')
            ->join('sites', 'phone_sims.site', '=', 'sites.id')
            ->join('departments', 'phone_sims.department', '=', 'departments.id')
            ->where('phone_sims.is_Defective', '0')
            ->orderBy('phone_sims.id', 'desc')
            ->paginate(100);

        $sites = DB::table('sites')->orderBy('name', 'ASC')->get();
        $departments = DB::table('departments')->orderBy('name', 'ASC')->where('id','!=','1')->get();

        $itemCount = DB::table('phone_sims')->where('phone_sims.is_Defective', '0')->count();
        $search = "";
        $page = 1;

        return view('inventory.phone-sim', compact('items', 'itemCount', 'search', 'page', 'departments', 'sites'));
    }

    public function phoneSimPaginate($page){
        $items = DB::table('phone_sims')
            ->select('phone_sims.id', 'phone_sims.item', 'phone_sims.user', 'departments.name as dept', 'phone_sims.desc', 'phone_sims.serial_no', 'phone_sims.remarks', 'phone_sims.site', 'sites.name AS site_name', 'phone_sims.status', 'phone_sims.invoice', 'phone_sims.date_del', 'phone_sims.date_issued', 'phone_sims.is_Defective')
            ->join('sites', 'phone_sims.site', '=', 'sites.id')
            ->join('departments', 'phone_sims.department', '=', 'departments.id')
            ->where('phone_sims.is_Defective', '0')
            ->orderBy('phone_sims.id', 'desc')
            ->paginate(100,'*','page',$page);

        $sites = DB::table('sites')->orderBy('name', 'ASC')->get();
        $departments = DB::table('departments')->orderBy('name', 'ASC')->where('id','!=','1')->get();

        $itemCount = DB::table('phone_sims')->where('phone_sims.is_Defective', '0')->count();
        $search = "";
        return view('inventory.phone-sim', compact('items', 'itemCount', 'search', 'page', 'departments', 'sites'));
    }

    public function phoneSimSearch($page, $search){
        $items = DB::table('phone_sims')
            ->select('phone_sims.id', 'phone_sims.item', 'phone_sims.user', 'departments.name as dept', 'phone_sims.desc', 'phone_sims.serial_no', 'phone_sims.remarks', 'phone_sims.site', 'sites.name AS site_name', 'phone_sims.status', 'phone_sims.invoice', 'phone_sims.date_del', 'phone_sims.date_issued', 'phone_sims.is_Defective')
            ->join('sites', 'phone_sims.site', '=', 'sites.id')
            ->join('departments', 'phone_sims.department', '=', 'departments.id')
            ->whereRaw("CONCAT_WS(' ', phone_sims.item, phone_sims.user, phone_sims.desc, phone_sims.serial_no, phone_sims.status, departments.name) LIKE '%{$search}%'")
            ->where('phone_sims.is_Defective', '0')
            ->orderBy('phone_sims.id', 'desc')
            ->paginate(100,'*','page',$page);

        $itemCount = DB::table('phone_sims')
            ->select('phone_sims.id', 'phone_sims.item', 'phone_sims.user', 'phone_sims.desc', 'phone_sims.serial_no', 'phone_sims.remarks', 'phone_sims.site', 'sites.name AS site_name', 'phone_sims.status', 'phone_sims.invoice', 'phone_sims.date_del', 'phone_sims.date_issued', 'phone_sims.is_Defective')
            ->join('sites', 'phone_sims.site', '=', 'sites.id')
            ->join('departments', 'phone_sims.department', '=', 'departments.id')
            ->whereRaw("CONCAT_WS(' ', phone_sims.item, phone_sims.user, phone_sims.desc, phone_sims.serial_no, phone_sims.status, departments.name) LIKE '%{$search}%'")
            ->where('phone_sims.is_Defective', '0')
            ->orderBy('phone_sims.id', 'desc')
            ->count();


        $sites = DB::table('sites')->orderBy('name', 'ASC')->get();
        $departments = DB::table('departments')->orderBy('name', 'ASC')->where('id','!=','1')->get();

            return view('inventory.phone-sim', compact('items', 'itemCount', 'search', 'page', 'departments', 'sites'));
    }

    public function view(Request $request){
        $thisSP = DB::table('phone_sims')
            ->select('phone_sims.id', 'phone_sims.item', 'phone_sims.user', 'departments.name as dept', 'phone_sims.desc', 'phone_sims.serial_no', 'phone_sims.remarks', 'sites.name AS site_name', 'phone_sims.status', 'phone_sims.invoice', 'phone_sims.date_del', 'phone_sims.date_issued', 'phone_sims.is_Defective')
            ->join('sites', 'phone_sims.site', '=', 'sites.id')
            ->join('departments', 'phone_sims.department', '=', 'departments.id')
            ->where('phone_sims.id', $request->id)
            ->first();

        $result = '';
        $his = '';
        $thisSPHs = PhoneSimHistory::select('phone_sim_histories.*', 'users.name as user_name', 'departments.name as dept_name', 'sites.name as site_name')
        ->join('users', 'phone_sim_histories.to', '=', 'users.id')
        ->join('sites', 'phone_sim_histories.site', '=', 'sites.id')
        ->join('departments', 'phone_sim_histories.department', '=', 'departments.id')
        ->where('phone_sim_histories.ps_id', $request->id) 
        ->get();

        if($thisSPHs->count() > 0){
            foreach($thisSPHs as $thisSPH){
                $his .= '
                    <tr class="text-left border-b border-gray-500">
                        <td class="">
                            '.date('F j, Y', strtotime($thisSPH->date_issued)).'
                        </td>
                        <td>
                            '.$thisSPH->user.'
                        </td>
                        <td>
                            '.$thisSPH->dept_name.'
                        </td>
                        <td>
                            '.$thisSPH->site_name.'
                        </td>
                        <td>
                            '.$thisSPH->remakrs.'
                        </td>
                        <td>
                            '.$thisSPH->user_name.'
                        </td>
                        <td>
                            '.date('F j, Y', strtotime($thisSPH->created_at)).'
                        </td>
                    </tr>
                ';
            }
        }else{
            $his .= '
                <tr class="text-left border-b border-gray-500">
                    <td colspan="7" class="text-center">
                        No Data.
                    </td>
                </tr>
            ';
        }

        $result = array(
            'id' => $thisSP,
            'item' => $thisSP->item,
            'user' => $thisSP->user,
            'dept' => $thisSP->dept,
            'desc' => $thisSP->desc,
            'serial_no' => $thisSP->serial_no,
            'remarks' => $thisSP->remarks,
            'site' => $thisSP->site_name,
            'status' => $thisSP->status,
            'invoice' => $thisSP->invoice,
            'date_del' => $thisSP->date_del,
            'date_issued' => $thisSP->date_issued,
            'is_Defective' => $thisSP->is_Defective,
            'his' => $his,
        );

        echo json_encode($result);
    }

    public function add(){
        $sites = DB::table('sites')->orderBy('name', 'ASC')->get();
        $departments = DB::table('departments')->orderBy('name', 'ASC')->where('id','!=','1')->get();

        $Item = "";
        $User = "";
        $Department = "";
        $SerialNo = "";
        $Cost = "";
        $Color = "";
        $Description = "";
        $DateIssued = date('m-d-Y');
        $DateDelivered = date('m-d-Y');
        $Action = "add";
        $Remarks = '';
        $Site = '';
        $Status = '';
        $ItemID = '';
        // $Invoice = '';

        return view('inventory.phone-sim-add-edit', compact('Item', 'sites', 'User', 'SerialNo', 'Description', 'DateDelivered', 'Action', 'ItemID', 'Remarks', 'Site', 'Status', 'departments', 'Department', 'Cost', 'Color', 'DateIssued'));
    }

    public function store(Request $request){
        $item = $request->item;
        $user = $request->user;
        $description = $request->description;
        $serial_no = $request->serial_no;
        $remarks = $request->remarks;
        $site = $request->site;
        $status = $request->status;
        $date_del = $request->date_del;
        $department = $request->department;
        $cost = $request->cost;
        $color = $request->color;
        $date_issued = $request->date_issued;

        $request->validate([
            'user' => 'required',
            'description' => 'required',
            'serial_no' => 'required',
            'remarks' => 'required',
            'status' => 'required',
            // 'invoice' => 'required',
        ]);

        $invoicePath = 'N/A';
        // $newDate_del = date("mdY", strtotime($date_del));
        // $newID = (DB::table('phone_sims')->orderByDesc('id')->first())->id + 1;
        // $invoicePath = $request->file('invoice')->storeAs('invoice/phone-sim/'.date('mY'), $newID.'-'.$newDate_del.'.'.$request->file('invoice')->getClientOriginalExtension(), 'public');

        $PhoneSim = new PhoneSim();
        $PhoneSim->item = $item;
        $PhoneSim->user = strtoupper($user);
        $PhoneSim->desc = strtoupper($description);
        $PhoneSim->serial_no = strtoupper($serial_no);
        $PhoneSim->remarks = strtoupper($remarks);
        $PhoneSim->site = $site;
        $PhoneSim->status = $status;
        $PhoneSim->invoice = $invoicePath;
        $PhoneSim->date_del = $date_del;
        $PhoneSim->department = $department;
        $PhoneSim->cost = $cost;
        $PhoneSim->color = strtoupper($color);
        $PhoneSim->date_issued = $date_issued;
        $PhoneSim->save();

        return redirect()->route('phoneSim.index');
    }

    public function edit($id){
        $item = PhoneSim::find($id);
        $sites = DB::table('sites')->orderBy('name', 'ASC')->get();
        $departments = DB::table('departments')->orderBy('name', 'ASC')->where('id','!=','1')->get();
        
        $ItemID = $item->id;
        $Item = $item->item;
        $User = $item->user;
        $Description = $item->desc;
        $SerialNo = $item->serial_no;
        $Remarks = $item->remarks;
        $Site = $item->site;
        $Status = $item->status;
        $DateDelivered = $item->date_del;
        $Department = $item->department;
        $Cost = $item->cost;
        $Color = $item->color;
        $DateIssued = $item->date_issued;
        $Action = "edit";

        return view('inventory.phone-sim-add-edit', compact('sites', 'ItemID', 'Item', 'User', 'Description', 'SerialNo', 'Remarks', 'Site', 'Status', 'DateDelivered', 'Action', 'departments', 'Department', 'Cost', 'Color', 'DateIssued'));
    }

    public function update(Request $request){
        $ItemID = $request->itemID;
        $user = strtoupper($request->user);
        $description = strtoupper($request->description);
        $serial_no = strtoupper($request->serial_no);
        $remarks = strtoupper($request->remarks);
        $site = $request->site;
        $status = $request->status;
        $date_del = $request->date_del;
        $department = $request->department;
        $cost = $request->cost;
        $color = $request->color;
        $date_issued = $request->date_issued;

        // if(isset($request->invoice)){
        //     $oldInvoice = (DB::table('phone_sims')->where('id', $ItemID)->first())->invoice;
        //     unlink(storage_path('app/public/'.$oldInvoice));
            
        //     $invoicePath = null;
        //     $newDate_del = date("mdY", strtotime($date_del));
        //     $invoicePath = $request->file('invoice')->storeAs('invoice/phone-sim/'.date('mY'), $ItemID.'-'.$newDate_del.'.'.$request->file('invoice')->getClientOriginalExtension(), 'public');

        //     $invoice = $request->invoice;
        //     DB::update('UPDATE phone_sims SET phone_sims.user=?, phone_sims.desc=?, phone_sims.serial_no=?, phone_sims.remarks=?, phone_sims.site=?, phone_sims.status=?, phone_sims.invoice=?, phone_sims.date_del=? WHERE phone_sims.id=?', [$user, $description, $serial_no, $remarks, $site, $status, $invoicePath, $date_del, $ItemID]);
        // }else{
            DB::update('UPDATE phone_sims SET phone_sims.user=?, phone_sims.desc=?, phone_sims.serial_no=?, phone_sims.remarks=?, phone_sims.site=?, phone_sims.status=?, phone_sims.date_del=?, phone_sims.department=?, phone_sims.cost=?, phone_sims.color=?, phone_sims.date_issued=? WHERE phone_sims.id=?', [$user, $description, $serial_no, $remarks, $site, $status, $date_del, $department, $cost, strtoupper($color), $date_issued, $ItemID]);
        // }

        return redirect()->route('phoneSim.index');
    }

    public function reissue(Request $request){
        $id = $request->reissueID;
        $user = $request->user;
        $department = $request->department;
        $site = $request->site;
        $date_issued = $request->date_issued;
        $remarks = $request->remarks;

        $ps = PhoneSim::where('id', $id)->first();
        $ps->user = $user;
        $ps->department = $department;
        $ps->site = $site;
        $ps->date_issued = $date_issued;
        $ps->remarks = $remarks;
        $ps->status = 'RE-ISSUED';
        $ps->save();

        return redirect()->route('phoneSim.index');
    }

    public function delete(Request $request){
        // $oldInvoice = (DB::table('phone_sims')->where('id', $request->deleteID)->first())->invoice;
        // unlink(storage_path('app/public/'.$oldInvoice));
        DB::delete('DELETE FROM phone_sims WHERE phone_sims.id=?', [$request->deleteID]);
        return redirect()->route('phoneSim.index');
    }

    public function defective(Request $request){
        $defectiveID = $request->defectiveID;
        DB::update('UPDATE phone_sims SET is_Defective=1, user=?, remarks=?, status=? WHERE id=?', ['N/A', 'DEFECTIVE', 'DEFECTIVE', $defectiveID]);
        return redirect()->route('phoneSim.index');
    }

    public function defectivePhoneIndex(){
        $items = DB::select('SELECT phone_sims.id, phone_sims.item, phone_sims.user, phone_sims.desc, phone_sims.serial_no, phone_sims.remarks, phone_sims.site, sites.name AS site_name, phone_sims.status, phone_sims.invoice, phone_sims.date_del, phone_sims.is_Defective FROM phone_sims INNER JOIN sites ON phone_sims.site = sites.id WHERE phone_sims.is_Defective = 1 ORDER BY phone_sims.id desc');
        return view('inventory.defective-phone-sim', compact('items'));
    }

    public function defectivePhoneRestore(Request $request){
        $defectiveID = $request->defectiveID;
        DB::update('UPDATE phone_sims SET is_Defective=0, user=?, remarks=?, status=? WHERE id=?', ['N/A', 'SPARE', 'SPARE', $defectiveID]);
        return redirect()->route('defectivePhone.index');
    }

    public function issuance($id){
        // $item = DB::table('phone_sims')->where('id', $id)->first();
        $item = (DB::select('SELECT phone_sims.id, phone_sims.item, phone_sims.user, departments.name AS department , phone_sims.date_issued, sites.name AS site, phone_sims.desc, phone_sims.serial_no, phone_sims.remarks, phone_sims.cost, phone_sims.color, phone_sims.status FROM phone_sims INNER JOIN departments ON phone_sims.department = departments.id INNER JOIN sites ON phone_sims.site = sites.id WHERE phone_sims.id = ?', [$id]))[0];
        $settings = (DB::table('settings')->where('id', 1)->first());


        return view('inventory.issuance', compact('item', 'settings'));
    }
}

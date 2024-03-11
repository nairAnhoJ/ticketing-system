<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\Item;
use App\Models\PhoneSim;
use App\Models\PhoneSimHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(){
        $items = DB::table('items')
            ->select('items.id', 'item_types.name AS type', 'items.code', 'items.brand', 'items.remarks', 'items.description', 'items.is_Defective', 'items.serial_no', 'items.invoice_no', 'items.date_purchased', 'items.status', 'items.is_Defective', 'computers.code AS comp', 'sites.name AS site', 'items.i_user', 'departments.name AS dept_name', 'items.i_remarks', 'items.i_date_issued', 'items.prev_user', 'items.prev_user_dept', 'items.return_remarks', 'items.date_returned')
            ->join('item_types', 'items.type_id', '=', 'item_types.id')
            ->join('computers', 'items.computer_id', '=', 'computers.id')
            ->join('sites', 'items.site_id', '=', 'sites.id')
            ->join('departments', 'items.i_department', '=', 'departments.id')
            ->where('items.is_Defective', '0')
            ->where('items.for_disposal', '0')
            ->where('items.is_disposed', '0')
            ->orderBy('items.id', 'desc')
            ->paginate(100);


        // $items = DB::select('SELECT	items.id, item_types.name AS type, items.code, items.brand, items.remarks, items.description, items.is_Defective, items.serial_no, items.invoice_no, items.date_purchased, items.status, items.is_Defective, computers.code AS comp, sites.name AS site, items.i_user, departments.name AS dept_name, items.i_remarks, items.i_date_issued, items.prev_user, items.prev_user_dept, items.return_remarks, items.date_returned FROM ((((items 
        // INNER JOIN item_types ON items.type_id = item_types.id) 
        // INNER JOIN computers ON items.computer_id = computers.id) 
        // INNER JOIN sites ON items.site_id = sites.id) 
        // INNER JOIN departments ON items.i_department = departments.id) 
        // WHERE items.is_Defective = 0 AND items.for_disposal = 0 AND items.is_disposed = 0 ORDER BY items.id DESC');
        $depts = DB::table('departments')->where('id', '!=', 1)->orderBy('name', 'asc')->get();
        $itemCount = DB::table('items')->where('is_Defective', '0')->where('for_disposal', '0')->where('is_disposed', '0')->count();
        $search = "";
        $page = 1;

        return view('inventory.items', compact('items', 'depts', 'itemCount', 'search', 'page'));
    }

    public function itemPaginate($page){
        $items = DB::table('items')
            ->select('items.id', 'item_types.name AS type', 'items.code', 'items.brand', 'items.remarks', 'items.description', 'items.is_Defective', 'items.serial_no', 'items.invoice_no', 'items.date_purchased', 'items.status', 'items.is_Defective', 'computers.code AS comp', 'sites.name AS site', 'items.i_user', 'departments.name AS dept_name', 'items.i_remarks', 'items.i_date_issued', 'items.prev_user', 'items.prev_user_dept', 'items.return_remarks', 'items.date_returned')
            ->join('item_types', 'items.type_id', '=', 'item_types.id')
            ->join('computers', 'items.computer_id', '=', 'computers.id')
            ->join('sites', 'items.site_id', '=', 'sites.id')
            ->join('departments', 'items.i_department', '=', 'departments.id')
            ->where('items.is_Defective', '0')
            ->where('items.for_disposal', '0')
            ->where('items.is_disposed', '0')
            ->orderBy('items.id', 'desc')
            ->paginate(100,'*','page',$page);

        $depts = DB::table('departments')->where('id', '!=', 1)->orderBy('name', 'asc')->get();
        $itemCount = DB::table('items')->where('is_Defective', '0')->where('for_disposal', '0')->where('is_disposed', '0')->count();
        $search = "";
        return view('inventory.items', compact('search', 'items', 'page', 'itemCount', 'depts'));
    }

    public function itemSearch($page, $search){
        $items = DB::table('items')
            ->select('items.id', 'item_types.name AS type', 'items.code', 'items.brand', 'items.remarks', 'items.description', 'items.is_Defective', 'items.serial_no', 'items.invoice_no', 'items.date_purchased', 'items.status', 'items.is_Defective', 'computers.code AS comp', 'sites.name AS site', 'items.i_user', 'departments.name AS dept_name', 'items.i_remarks', 'items.i_date_issued', 'items.prev_user', 'items.prev_user_dept', 'items.return_remarks', 'items.date_returned')
            ->join('item_types', 'items.type_id', '=', 'item_types.id')
            ->join('computers', 'items.computer_id', '=', 'computers.id')
            ->join('sites', 'items.site_id', '=', 'sites.id')
            ->join('departments', 'items.i_department', '=', 'departments.id')
            ->whereRaw("CONCAT_WS(' ', items.code, items.brand, items.description, items.serial_no) LIKE '%{$search}%'")
            ->where('items.is_Defective', '0')
            ->where('items.for_disposal', '0')
            ->where('items.is_disposed', '0')
            ->orderBy('items.id', 'desc')
            ->paginate(100,'*','page',$page);

        // $items = DB::table('items')
        //     ->select('*')
        //     ->whereRaw("CONCAT_WS(' ', code, brand, description, serial_no) LIKE '%{$search}%'")
        //     ->where('for_disposal', '1')
        //     ->orderBy('brand', 'asc')
        //     ->paginate(100,'*','page',$page);

        $itemCount = DB::table('items')
            ->select('*')
            ->whereRaw("CONCAT_WS(' ', code, brand, description, serial_no) LIKE '%{$search}%'")
            ->where('items.is_Defective', '0')
            ->where('items.for_disposal', '0')
            ->where('items.is_disposed', '0')
            ->count();

        $depts = DB::table('departments')->where('id', '!=', 1)->orderBy('name', 'asc')->get();
        return view('inventory.items', compact('search', 'items', 'page', 'itemCount', 'depts'));
    }

    public function add(){

        $types = DB::table('item_types')->orderBy('name', 'asc')->get();

        $ItemType = "";
        $Brand = "";
        $SerialNo = "";
        $Description = "";
        $DatePurchased = date('m-d-Y');
        $Action = "add";
        $ItemID = '';
        $InvoiceNo = '';

        return view('inventory.item-add-edit', compact('types', 'ItemType', 'Brand', 'SerialNo', 'Description', 'DatePurchased', 'Action', 'ItemID', 'InvoiceNo'));
    }

    public function store(Request $request){
        $user_name = auth()->user()->name;
        $type = $request->type;
        $brand = $request->brand;
        $serial_no = $request->serial_no;
        $description = $request->description;
        $date_purchased = $request->date_purchased;
        $InvoiceNo = $request->invoice;
        $itemCode = '';

        $lastItemCode = DB::table('items')->orderBy('id','desc')->take(1)->get();
        if($lastItemCode->count() > 0){
            $lastIC = substr($lastItemCode[0]->code, -6);
            $lastIC++;
            while(mb_strlen($lastIC, "UTF-8") < 6){
                $lastIC = "0{$lastIC}";
            }
            $itemCode = "HII-{$lastIC}";
        }else{
            $itemCode = 'HII-000001';
        }

        $request->validate([
            'type' => 'required',
            'brand' => 'required',
            'serial_no' => 'required',
            'invoice' => 'required',
            'description' => 'required',
            'date_purchased' => 'required',
        ]);

        $invoicePath = null;
        $newDate_del = date("mdY", strtotime($date_purchased));
        $invoicePath = $request->file('invoice')->storeAs('invoice/item/'.date('mY'), $itemCode.'-'.$newDate_del.'.'.$request->file('invoice')->getClientOriginalExtension(), 'public');

        $item = new Item();
        $item->type_id = $type;
        $item->code = $itemCode;
        $item->brand = strtoupper($brand);
        $item->serial_no = strtoupper($serial_no);
        $item->invoice_no = $invoicePath;
        $item->description = strtoupper($description);
        $item->date_purchased = $date_purchased;
        $item->status = 'SPARE';
        $item->computer_id = '1';
        $item->site_id = '1';
        $item->i_department = '1';
        $item->added_by = strtoupper($user_name);
        $item->edited_by = strtoupper($user_name);
        $item->save();

        return redirect()->route('item.index');
    }

    public function edit($id){
        $item = Item::find($id);
        
        $types = DB::table('item_types')->orderBy('name', 'asc')->get();

        $ItemID = $item->id;
        $ItemType = $item->type_id;
        $Brand = $item->brand;
        $SerialNo = $item->serial_no;
        $Description = $item->description;
        $DatePurchased = $item->date_purchased;
        $Action = "edit";

        return view('inventory.item-add-edit', compact('types', 'ItemType', 'Brand', 'SerialNo', 'Description', 'DatePurchased', 'Action', 'ItemID'));
    }

    public function update(Request $request){
        $user_name = strtoupper(auth()->user()->name);
        $type = $request->type;
        $brand = $request->brand;
        $serial_no = $request->serial_no;
        $description = $request->description;
        $date_purchased = $request->date_purchased;
        $ItemID = $request->itemID;
        
        if(isset($request->invoice)){
            $oldInvoice = (DB::table('items')->where('id', $ItemID)->first())->invoice_no;
            unlink(storage_path('app/public/'.$oldInvoice));

            $ItemCode = (DB::table('items')->orderBy('id','desc')->first())->code;
            
            $invoicePath = null;
            $newDate_del = date("mdY", strtotime($date_purchased));
            $invoicePath = $request->file('invoice')->storeAs('invoice/item/'.date('mY'), $ItemCode.'-'.$newDate_del.'.'.$request->file('invoice')->getClientOriginalExtension(), 'public');

            DB::update('UPDATE items SET type_id=?, brand=?, serial_no=?, description=?, invoice_no=?, date_purchased=?, edited_by=?, updated_at=? WHERE id=?', [$type, $brand, $serial_no, $description, $invoicePath, $date_purchased, $user_name, date('Y-m-d H:m:s'), $ItemID]);
        }else{
            DB::update('UPDATE items SET type_id=?, brand=?, serial_no=?, description=?, date_purchased=?, edited_by=?, updated_at=? WHERE id=?', [$type, $brand, $serial_no, $description, $date_purchased, $user_name, date('Y-m-d H:m:s'), $ItemID]);
        }

        return redirect()->route('item.index');
    }

    public function download($id){
        $invoice = DB::table('items')->where('id', $id)->first();
        $inv_path = $invoice->invoice_no;
        $filepath = storage_path("app/public/{$inv_path}");
        return Storage::download("public/{$inv_path}");
    }

    public function delete(Request $request){
        $oldInvoice = (DB::table('items')->where('id', $request->deleteID)->first())->invoice_no;
        unlink(storage_path('app/public/'.$oldInvoice));
        DB::delete('DELETE FROM items WHERE items.id=?', [$request->deleteID]);
        return redirect()->route('item.index');
    }

    public function defective(Request $request){
        $defectiveID = $request->defectiveID;
        $old_desc = (DB::table('items')->where('id', $defectiveID)->first())->description;
        $new_desc = preg_replace("/\(([^()]*+|(?R))*\)/","", $old_desc);
        DB::update("UPDATE items SET description=?, is_Defective=1, computer_id=1, status='DEFECTIVE', edited_by=?  WHERE id=?", [$new_desc, auth()->user()->name, $defectiveID]);
        return redirect()->route('item.index');
    }

    public function status(Request $request){
        $statusID = $request->statusID;
        $thisStatus = $request->thisStatus;

        if($thisStatus == 'SPARE'){
            $user = strtoupper($request->user);
            $department = $request->department;
            $cost = $request->cost;
            $color = strtoupper($request->color);
            $status = $request->status;
            $remarks = strtoupper($request->remarks);
            $date_issued = $request->date_issued;

            $thisItem = DB::table('items')->where('id', $statusID)->first();
            if($thisItem->type_id == '13'){
                $lastComputerCode = DB::table('computers')->orderBy('id','desc')->first();
                if($lastComputerCode->code != 'N/A'){
                    $lastCC = substr($lastComputerCode->code, -6);
                    $lastCC++;
                    while(mb_strlen($lastCC, "UTF-8") < 6){
                        $lastCC = "0{$lastCC}";
                    }
                    $computerCode = "HII_PC-{$lastCC}";
                }else{
                    $computerCode = 'HII_PC-000001';
                }
    
                $computer = new Computer();
                $computer->code = $computerCode;
                $computer->user = strtoupper($user);
                $computer->site = $thisItem->site_id;
                $computer->ip_add = '0.0.0.0';
                $computer->type = 'LAPTOP';
                $computer->status = 'WORKING';
                $computer->conducted_by = auth()->user()->name;
                $computer->date_conducted = date('m-d-Y');
                $computer->save();

                $com_id = $computer->id;
                // dd($com_id);

                DB::table('items')
                    ->where('id', $statusID)
                    ->update([
                        'i_user' => $user,
                        'i_department' => $department,
                        'i_cost' => $cost,
                        'i_color' => $color,
                        'i_status' => $status,
                        'i_remarks' => $remarks,
                        'i_date_issued' => $date_issued,
                        'computer_id' => $com_id,
                        'status' => 'USED',
                        'edited_by' => auth()->user()->name
                    ]);
            }else{
                DB::table('items')
                    ->where('id', $statusID)
                    ->update(['i_user' => $user,'i_department' => $department, 'i_cost' => $cost, 'i_color' => $color, 'i_status' => $status, 'i_remarks' => $remarks, 'i_date_issued' => $date_issued, 'computer_id' => 1, 'status' => 'USED', 'edited_by' => auth()->user()->name]);
            }

        }else if($thisStatus == 'USED'){

            $thisItem = DB::table('items')->where('id', $statusID)->first();
            if($thisItem->type_id == '13'){
                $com_id = $thisItem->computer_id;
                DB::delete('delete computers where id = ?', [$com_id]);
            }
            DB::table('items')
                ->where('id', $statusID)
                ->update(['i_user' => null, 'i_department' => null, 'i_cost' => null, 'i_color' => null, 'i_status' => null, 'i_remarks' => null, 'i_date_issued' => null, 'computer_id' => 1, 'status' => 'SPARE', 'edited_by' => auth()->user()->name]);
        }
        return redirect()->route('item.index');
    }
    
    public function defectiveIndex(){
        $items = DB::table('items')
            ->select('items.id', 'item_types.name AS type', 'items.code', 'items.brand', 'items.remarks', 'items.description', 'items.is_Defective', 'items.serial_no', 'items.invoice_no', 'items.date_purchased', 'items.status', 'items.is_Defective', 'computers.code AS comp', 'sites.name AS site')
            ->join('item_types', 'items.type_id', '=', 'item_types.id')
            ->join('computers', 'items.computer_id', '=', 'computers.id')
            ->join('sites', 'items.site_id', '=', 'sites.id')
            ->where('items.is_Defective', '1')
            ->orderBy('items.id', 'desc')
            ->paginate(100);

        $itemCount = DB::table('items')->where('is_Defective', '1')->count();
        $search = "";
        $page = 1;

        // $items = DB::select('SELECT	items.id, item_types.name AS type, items.code, items.brand, items.description, items.serial_no, items.invoice_no, items.date_purchased, items.status, items.is_Defective, computers.code AS comp, sites.name AS site FROM (((items INNER JOIN item_types ON items.type_id = item_types.id) INNER JOIN computers ON items.computer_id = computers.id) INNER JOIN sites ON items.site_id = sites.id) WHERE items.is_Defective = 1 ORDER BY items.id DESC');

        return view('inventory.defective-items', compact('items', 'itemCount', 'search', 'page'));
    }

    public function defectivePaginate($page){
        $items = DB::table('items')
            ->select('items.id', 'item_types.name AS type', 'items.code', 'items.brand', 'items.remarks', 'items.description', 'items.is_Defective', 'items.serial_no', 'items.invoice_no', 'items.date_purchased', 'items.status', 'items.is_Defective', 'computers.code AS comp', 'sites.name AS site')
            ->join('item_types', 'items.type_id', '=', 'item_types.id')
            ->join('computers', 'items.computer_id', '=', 'computers.id')
            ->join('sites', 'items.site_id', '=', 'sites.id')
            ->where('items.is_Defective', '1')
            ->orderBy('items.id', 'desc')
            ->paginate(100,'*','page',$page);

            $itemCount = DB::table('items')->where('is_Defective', '1')->count();
            $search = "";
            $page = 1;
            
        return view('inventory.defective-items', compact('items', 'itemCount', 'search', 'page'));
    }

    public function defectiveSearch($page, $search){
        $items = DB::table('items')
            ->select('items.id', 'item_types.name AS type', 'items.code', 'items.brand', 'items.remarks', 'items.description', 'items.is_Defective', 'items.serial_no', 'items.invoice_no', 'items.date_purchased', 'items.status', 'items.is_Defective', 'computers.code AS comp', 'sites.name AS site')
            ->join('item_types', 'items.type_id', '=', 'item_types.id')
            ->join('computers', 'items.computer_id', '=', 'computers.id')
            ->join('sites', 'items.site_id', '=', 'sites.id')
            ->whereRaw("CONCAT_WS(' ', items.code, items.brand, items.description, items.serial_no) LIKE '%{$search}%'")
            ->where('items.is_Defective', '1')
            ->orderBy('items.id', 'desc')
            ->paginate(100,'*','page',$page);

        // $items = DB::table('items')
        //     ->select('*')
        //     ->whereRaw("CONCAT_WS(' ', code, brand, description, serial_no) LIKE '%{$search}%'")
        //     ->where('for_disposal', '1')
        //     ->orderBy('brand', 'asc')
        //     ->paginate(100,'*','page',$page);

        $itemCount = DB::table('items')
            ->select('*')
            ->whereRaw("CONCAT_WS(' ', code, brand, description, serial_no) LIKE '%{$search}%'")
            ->where('items.is_Defective', '1')
            ->count();

        return view('inventory.defective-items', compact('items', 'itemCount', 'search', 'page'));
    }

    public function defectiveRestore(Request $request){
        $defectiveID = $request->defectiveID;
        DB::update("UPDATE items SET is_Defective=0, computer_id=1, status='SPARE', edited_by=?  WHERE id=?", [auth()->user()->name, $defectiveID]);
        return redirect()->route('defectiveIndex.index');
    }

    public function issuance($id){
        $item = (DB::select('SELECT items.id, item_types.name AS item_name, items.brand, items.serial_no, items.description, sites.name as site_name, items.i_user, departments.name AS dept_name, items.i_cost, items.i_color, items.i_status, items.i_remarks, items.i_date_issued FROM items INNER JOIN item_types ON items.type_id = item_types.id INNER JOIN sites ON items.site_id = sites.id INNER JOIN departments ON items.i_department = departments.id WHERE items.id = ?', [$id]))[0];

        $item = (object) [
            'user' => $item->i_user,
            'date_issued' => $item->i_date_issued,
            'department' => $item->dept_name,
            'site' => $item->site_name,
            'desc' => $item->brand.' '.$item->description,
            'cost' => $item->i_cost,
            'serial_no' => $item->serial_no,
            'color' => $item->i_color,
            'remarks' => $item->i_remarks,
            'status' => $item->i_status,
            'item' => $item->item_name
        ];

        $settings = (DB::table('settings')->where('id', 1)->first());


        return view('inventory.issuance', compact('item', 'settings'));
    }

    public function issuanceEdit(Request $request){
        $id = $request->id;
        $thisItem = Item::find($id);

        $depts = DB::table('departments')->where('id', '!=', 1)->orderBy('name', 'asc')->get();
        $departments = '';
        foreach($depts as $dept){
            if($dept->id == $thisItem->i_department){
                $departments .= '<option selected value="'.$dept->id.'">'.$dept->name.'</option>';
            }else{
                $departments .= '<option value="'.$dept->id.'">'.$dept->name.'</option>';
            }
        }

        $result = '
            <label for="user" class="block mt-2 text-sm font-medium text-white">User</label>
            <input required type="text" id="user" name="user" value="'.$thisItem->i_user.'" class="block w-full p-2 mb-2 border rounded-lg sm:text-xs bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:border-blue-500" autocomplete="off">

            <label for="department" class="mt-2 block text-sm font-medium text-white">Department</label>
            <select required id="department" name="department" autocomplete="off" class="border text-sm rounded-lg focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">'.$departments.'</select>

            <label for="cost" class="block mt-2 text-sm font-medium text-white">Cost</label>
            <input required type="text" id="cost" name="cost" value="'.$thisItem->i_cost.'" class="block w-full p-2 mb-2 border rounded-lg sm:text-xs bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:border-blue-500" autocomplete="off">

            <label for="color" class="block mt-2 text-sm font-medium text-white">Color</label>
            <input required type="text" id="color" name="color" value="'.$thisItem->i_color.'" class="block w-full p-2 mb-2 border rounded-lg sm:text-xs bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:border-blue-500" autocomplete="off">

            <label for="status" class="mt-2 block text-sm font-medium text-white">Status</label>
            <select required id="status" name="status" autocomplete="off" class="border text-sm rounded-lg focus:border-blue-500 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white">
                    <option value="BRAND NEW">Brand New</option>
                    <option value="OLD UNIT">Old Unit</option>
            </select>

            <label for="remarks" class="block mt-2 text-sm font-medium text-white">Remarks</label>
            <input required type="text" id="remarks" name="remarks" value="'.$thisItem->i_remarks.'" class="block w-full p-2 mb-2 border rounded-lg sm:text-xs bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:border-blue-500" autocomplete="off">
    
            <label for="date_issued" class="block text-sm font-medium text-white">Date Issued</label>
            <div class="relative">
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input datepicker datepicker-autohide type="text" id="date_issued" name="date_issued" value="'.$thisItem->i_date_issued.'" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:border-blue-500 block w-full pl-10 p-2.5" required>
                </div>
            </div>
        ';
        
        echo $result;
    }

    public function issuanceUpdate(Request $request){
        $id = $request->statusID;
        $user = $request->user;
        $department = $request->department;
        $cost = $request->cost;
        $color = $request->color;
        $status = $request->status;
        $remarks = $request->remarks;
        $date_issued = $request->date_issued;

        DB::table('items')
        ->where('id', $id)
        ->update([
            'i_user' => $user,
            'i_department' => $department,
            'i_cost' => $cost,
            'i_color' => $color,
            'i_status' => $status,
            'i_remarks' => $remarks,
            'i_date_issued' => $date_issued,
            'edited_by' => auth()->user()->name
        ]);

        return redirect()->route('item.index');
    }






    public function returnItem(){
        $sites = DB::table('sites')->orderBy('name', 'asc')->get();
        $depts = DB::table('departments')->where('id', '!=', '1')->orderBy('name', 'asc')->get();
        $items = DB::table('items')->where('status', 'USED')->where('is_defective', 0)->orderBy('id', 'asc')->get();
        $phones = DB::table('phone_sims')->where('is_Defective', 0)->orderBy('id', 'asc')->get();
        $itemCount = $items->count() + $phones->count();

        return view('inventory.return-items', compact('sites', 'items', 'phones', 'itemCount', 'depts'));
    }

    public function returnUpdate(Request $request){
        $name = $request->name;
        $dept = $request->dept;
        $site = $request->site;
        $date_returned = $request->date_returned;
        $count = $request->count;

        for($x = 1; $x <= $count; $x++){
            $itemName = 'item'.$x;
            $itemID = $request->$itemName;
            $itemRemarksName = 'remarks'.$x;
            $itemRemarks = $request->$itemRemarksName;

            if (substr($itemID, 0, 5) == 'PHONE') {
                $itemID = str_replace('PHONE', '', $itemID);
                $thisItem = DB::table('phone_sims')->where('id', $itemID)->first();

                $psh = new PhoneSimHistory;
                $psh->ps_id = $thisItem->id;
                $psh->user = $thisItem->user;
                $psh->department = $thisItem->department;
                $psh->site = $thisItem->site;
                $psh->date_issued = $thisItem->date_issued;
                $psh->remarks = $thisItem->remarks;
                $psh->to = Auth::user()->id;
                $psh->save();

                $ps = PhoneSim::where('id', $itemID)->first();
                $ps->user = 'N/A';
                $ps->department = 1;
                $ps->site = 1;
                $ps->date_issued = 'N/A';
                $ps->remarks = 'N/A';
                $ps->status = 'RETURNED';
                $ps->save();

            }else{
                $thisItem = DB::table('items')->where('id', $itemID)->first();
                $thisDept = (DB::table('departments')->where('id', $dept)->first())->name;
                if($thisItem->type_id == '13'){
                    $com_id = $thisItem->computer_id;
                    DB::table('computers')->where('id', $com_id)->delete();
                }
                DB::table('items')
                    ->where('id', $itemID)
                    ->update([
                        'prev_user' => strtoupper($name),
                        'prev_user_dept' => $thisDept,
                        'return_remarks' => $itemRemarks,
                        'date_returned' => $date_returned,
                        'i_user' => null,
                        'i_department' => 1,
                        'i_cost' => null,
                        'i_color' => null,
                        'i_status' => null,
                        'i_remarks' => null,
                        'i_date_issued' => null,
                        'computer_id' => 1,
                        'status' => 'SPARE',
                        'edited_by' => auth()->user()->name
                    ]);
            }
        }

        return redirect()->route('item.index');
    }

    public function returnPrint(Request $request){
        $name = strtoupper($request->name);
        $dept_id = $request->dept;
        $site_id = $request->site;
        $count = $request->count;
        $date_returned = $request->date_returned;

        $dept = (DB::table('departments')->where('id', $dept_id)->first())->name;
        $site = (DB::table('sites')->where('id', $site_id)->first())->name;

        $items = [];

        for($x = 1; $x <= $count; $x++){
            $itemName = 'item'.$x;
            $itemID = $request->$itemName;
            $itemRemarksName = 'remarks'.$x;
            $itemRemarks = $request->$itemRemarksName;

            if (substr($itemID, 0, 5) === 'PHONE') {
                $itemID = str_replace('PHONE', '', $itemID);

                $thisItem = DB::table('phone_sims')->where('id', $itemID)->first();
                $itemObject = (object)[
                    'code' => 'N/A',
                    'type' => 'PHONE/SIM',
                    'desc' => $thisItem->desc,
                    'serial_no' => $thisItem->serial_no,
                    'remarks' => $itemRemarks,
                ];
            }else{
                $thisItem = DB::table('items')
                    ->select('items.id', 'items.code', 'item_types.name', 'items.brand', 'items.description', 'items.serial_no')
                    ->join('item_types', 'items.type_id', '=', 'item_types.id')
                    ->where('items.id', $itemID)->first();
                $itemObject = (object)[
                    'code' => $thisItem->code,
                    'type' => $thisItem->name,
                    'desc' => $thisItem->brand.' '.$thisItem->description,
                    'serial_no' => $thisItem->serial_no,
                    'remarks' => $itemRemarks,
                ];
            }

            array_push($items, $itemObject);
        }

        return view('inventory.return', compact('name', 'dept', 'site', 'date_returned', 'items'));
    }






    public function disposalIndex(){
        $items = DB::table('items')->where('for_disposal', '1')->orderBy('brand', 'asc')->paginate(100);
        $itemCount = DB::table('items')->where('for_disposal', '1')->count();
        $search = "";
        $page = 1;

        return view('inventory.items-for-disposal', compact('search', 'items', 'page', 'itemCount'));
    }

    public function disposalAdd(Request $request){
        DB::table('items')->where('id', $request->disposeID)->update([
            "status" => "FOR DISPOSAL",
            "for_disposal" => '1',
            "edited_by" => auth()->user()->name,
        ]);

        return redirect()->route('defectiveIndex.index');
    }

    public function disposalPrint(){
        $items = DB::table('items')
        ->select('item_types.name', DB::raw('count(items.id) as count'))
        ->join('item_types', 'items.type_id', '=', 'item_types.id')
        ->groupBy('item_types.name')
        ->where('for_disposal', '1')
        ->orderBy('item_types.name', 'asc')
        ->get();

        return view('inventory.disposal', compact('items'));
    }

    public function disposalDisposed(){
        DB::table('items')->where('for_disposal', '1')->update([
            'status' => 'DISPOSED',
            'is_Defective' => '0',
            'for_disposal' => '0',
            'is_disposed' => '1',
        ]);

        return redirect()->route('disposal.index');
    }

    public function disposalRemove(Request $request){
        DB::table('items')->where('id', $request->removeID)->update([
            'status' => 'DEFECTIVE',
            'is_Defective' => '1',
            'for_disposal' => '0',
        ]);

        return redirect()->route('disposal.index');
    }

    public function disposalPaginate($page){
        $items = DB::table('items')->where('for_disposal', '1')->orderBy('brand', 'asc')->paginate(100,'*','page',$page);
        $itemCount = DB::table('items')->where('for_disposal', '1')->count();
        $search = "";
        return view('inventory.items-for-disposal', compact('search', 'items', 'page', 'itemCount'));
    }

    public function disposalSearch($page, $search){
        $items = DB::table('items')
            ->select('*')
            ->whereRaw("CONCAT_WS(' ', code, brand, description, serial_no) LIKE '%{$search}%'")
            ->where('for_disposal', '1')
            ->orderBy('brand', 'asc')
            ->paginate(100,'*','page',$page);

        $itemCount = DB::table('items')
            ->select('*')
            ->whereRaw("CONCAT_WS(' ', code, brand, description, serial_no) LIKE '%{$search}%'")
            ->where('for_disposal', '1')
            ->orderBy('brand', 'asc')
            ->count();

        return view('inventory.items-for-disposal', compact('search', 'items', 'page', 'itemCount'));
    }





    public function disposedIndex(){
        $items = DB::table('items')->where('is_disposed', '1')->orderBy('brand', 'asc')->paginate(100);
        $itemCount = DB::table('items')->where('is_disposed', '1')->count();
        $search = "";
        $page = 1;

        return view('inventory.disposed', compact('search', 'items', 'page', 'itemCount'));
    }

    public function disposedPaginate($page){
        $items = DB::table('items')->where('is_disposed', '1')->orderBy('brand', 'asc')->paginate(100,'*','page',$page);
        $itemCount = DB::table('items')->where('is_disposed', '1')->count();
        $search = "";
        return view('inventory.disposed', compact('search', 'items', 'page', 'itemCount'));
    }

    public function disposedSearch($page, $search){
        $items = DB::table('items')
            ->select('*')
            ->whereRaw("CONCAT_WS(' ', code, brand, description, serial_no) LIKE '%{$search}%'")
            ->where('is_disposed', '1')
            ->orderBy('brand', 'asc')
            ->paginate(100,'*','page',$page);

        $itemCount = DB::table('items')
            ->select('*')
            ->whereRaw("CONCAT_WS(' ', code, brand, description, serial_no) LIKE '%{$search}%'")
            ->where('is_disposed', '1')
            ->orderBy('brand', 'asc')
            ->count();

        return view('inventory.disposed', compact('search', 'items', 'page', 'itemCount'));
    }

}

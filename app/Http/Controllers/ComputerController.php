<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComputerController extends Controller
{
    // public function index(){
    //     $computers = DB::select('SELECT computers.id, computers.code, computers.user, computers.site, sites.name AS site_name, computers.ip_add, computers.type, computers.status, computers.conducted_by, computers.date_conducted FROM computers INNER JOIN sites ON computers.site = sites.id WHERE computers.id != 1 ORDER BY computers.id ASC');


    //     return view('inventory.computer', compact('computers'));
    // }

    public function index(){
        $computers = DB::table('computers')
            ->select('computers.id', 'computers.code', 'computers.user', 'computers.site', 'sites.name AS site_name', 'computers.ip_add', 'computers.type', 'computers.status', 'computers.conducted_by', 'computers.date_conducted')
            ->join('sites', 'computers.site', '=', 'sites.id')
            ->where('computers.id', '!=', '1')
            ->orderBy('computers.id', 'asc')
            ->paginate(100);

        $computersCount = DB::table('computers')->where('computers.id', '!=', '1')->count();
        $search = "";
        $page = 1;

        return view('inventory.computer', compact('computers', 'computersCount', 'search', 'page'));
    }

    public function ComputerPaginate($page){
        $computers = DB::table('computers')
            ->select('computers.id', 'computers.code', 'computers.user', 'computers.site', 'sites.name AS site_name', 'computers.ip_add', 'computers.type', 'computers.status', 'computers.conducted_by', 'computers.date_conducted')
            ->join('sites', 'computers.site', '=', 'sites.id')
            ->where('computers.id', '!=', '1')
            ->orderBy('computers.id', 'asc')
            ->paginate(100,'*','page',$page);

        $computersCount = DB::table('computers')->where('computers.id', '!=', '1')->count();
        $search = "";
        return view('inventory.computer', compact('computers', 'computersCount', 'search', 'page'));
    }

    public function computerSearch($page, $search){
        $computers = DB::table('computers')
            ->select('computers.id', 'computers.code', 'computers.user', 'computers.site', 'sites.name AS site_name', 'computers.ip_add', 'computers.type', 'computers.status', 'computers.conducted_by', 'computers.date_conducted')
            ->join('sites', 'computers.site', '=', 'sites.id')
            ->whereRaw("CONCAT_WS(' ', computers.code, computers.user, computers.ip_add, computers.status) LIKE '%{$search}%'")
            ->where('computers.id', '!=', '1')
            ->orderBy('computers.id', 'asc')
            ->paginate(100,'*','page',$page);

        $computersCount = DB::table('computers')
        ->select('computers.id', 'computers.code', 'computers.user', 'computers.site', 'sites.name AS site_name', 'computers.ip_add', 'computers.type', 'computers.status', 'computers.conducted_by', 'computers.date_conducted')
        ->join('sites', 'computers.site', '=', 'sites.id')
        ->whereRaw("CONCAT_WS(' ', computers.code, computers.user, computers.ip_add, computers.status) LIKE '%{$search}%'")
        ->where('computers.id', '!=', '1')
        ->orderBy('computers.id', 'asc')
        ->count();

        return view('inventory.computer', compact('computers', 'computersCount', 'search', 'page'));
    }

    public function add(){
        $user = '';
        $ip_add = '';
        $type = '';
        $status = '';
        $siteEdit = '';

        $sites = DB::table('sites')->orderBy('name', 'asc')->get();
        $laptops = DB::table('items')->where('type_id', 13)->where('computer_id', 1)->get();
        $mobos = DB::table('items')->where('type_id', 1)->where('computer_id', 1)->get();
        $procs = DB::table('items')->where('type_id', 2)->where('computer_id', 1)->get();
        $rams = DB::table('items')->where('type_id', 3)->where('computer_id', 1)->get();
        $stors = DB::table('items')->where('type_id', 4)->where('computer_id', 1)->get();
        $gpus = DB::table('items')->where('type_id', 5)->where('computer_id', 1)->get();
        $psus = DB::table('items')->where('type_id', 6)->where('computer_id', 1)->get();
        $oss = DB::table('items')->where('type_id', 14)->where('computer_id', 1)->get();
        $monitors = DB::table('items')->where('type_id', 7)->where('computer_id', 1)->get();
        $mouses = DB::table('items')->where('type_id', 8)->where('computer_id', 1)->get();
        $kbs = DB::table('items')->where('type_id', 9)->where('computer_id', 1)->get();
        $lans = DB::table('items')->where('type_id', 10)->where('computer_id', 1)->get();
        $others = DB::table('items')->where('type_id', 11)->where('computer_id', 1)->get();

        $Action = 'add';
        $ComputerID = '';
        
        return view('inventory.computer-add-edit', compact('Action', 'ComputerID', 'sites', 'laptops', 'mobos', 'procs', 'rams', 'stors', 'gpus', 'psus', 'oss', 'monitors', 'mouses', 'kbs', 'lans', 'others', 'user', 'ip_add', 'type', 'status', 'siteEdit'));
    }

    public function store(Request $request){
        $itemID = $request->itemID;
        $user = $request->user;
        $ip_add = $request->ip_add;
        $type = $request->type;
        $status = $request->status;
        $site = $request->site;

        $laptop = $request->laptop;
        $mobo = $request->mobo;
        $proc = $request->proc;
        $ram1 = $request->ram1;
        $ram2 = $request->ram2;
        $ram3 = $request->ram3;
        $ram4 = $request->ram4;
        $stor1 = $request->stor1;
        $stor2 = $request->stor2;
        $stor3 = $request->stor3;
        $stor4 = $request->stor4;
        $gpu = $request->gpu;
        $psu = $request->psu;
        $os = $request->os;
        $monitor = $request->monitor;
        $mouse = $request->mouse;
        $kb = $request->kb;
        $lan = $request->lan;
        $other1 = $request->other1;
        $other2 = $request->other2;
        $other3 = $request->other3;
        $other4 = $request->other4;
        $other5 = $request->other5;

        $request->validate([
            'user' => 'required',
            'ip_add' => 'required',
        ]);

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
        $computer->site = $site;
        $computer->ip_add = $ip_add;
        $computer->type = $type;
        $computer->status = $status;
        $computer->conducted_by = auth()->user()->name;
        $computer->date_conducted = date('m-d-Y');
        $computer->save();

        $comID = (DB::table('computers')->orderBy('id', 'desc')->first())->id;

        if($laptop != null){
            DB::update("UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?", ['USED', $comID, $site, auth()->user()->name, $laptop]);
        }

        if($mobo != null){
            DB::update("UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?", ['USED', $comID, $site, auth()->user()->name, $mobo]);
        }

        if($proc != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $proc]);
        }

        if($ram1 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $ram1]);
        }

        if($ram2 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $ram2]);
        }

        if($ram3 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $ram3]);
        }

        if($ram4 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $ram4]);
        }

        if($stor1 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $stor1]);
        }

        if($stor2 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $stor2]);
        }

        if($stor3 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $stor3]);
        }

        if($stor4 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $stor4]);
        }

        if($gpu != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $gpu]);
        }

        if($psu != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $psu]);
        }

        if($os != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $os]);
        }

        if($monitor != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $monitor]);
        }

        if($mouse != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $mouse]);
        }

        if($kb != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $kb]);
        }

        if($lan != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $lan]);
        }


        if($other1 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $other1]);
        }

        if($other2 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $other2]);
        }

        if($other3 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $other3]);
        }

        if($other4 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $other4]);
        }

        if($other5 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $other5]);
        }

        return redirect()->route('computer.index');
    }

    public function edit($id){
        $user = (DB::table('computers')->where('id', $id)->first())->user;
        $ip_add = (DB::table('computers')->where('id', $id)->first())->ip_add;
        $type = (DB::table('computers')->where('id', $id)->first())->type;
        $status = (DB::table('computers')->where('id', $id)->first())->status;
        $siteEdit = (DB::table('computers')->where('id', $id)->first())->site;

        $sites = DB::table('sites')->orderBy('name', 'asc')->get();

        $laptops = DB::table('items')->where('type_id', 13)->where('computer_id', 1)->get();
        $mobos = DB::table('items')->where('type_id', 1)->where('computer_id', 1)->get();
        $procs = DB::table('items')->where('type_id', 2)->where('computer_id', 1)->get();
        $rams = DB::table('items')->where('type_id', 3)->where('computer_id', 1)->get();
        $stors = DB::table('items')->where('type_id', 4)->where('computer_id', 1)->get();
        $gpus = DB::table('items')->where('type_id', 5)->where('computer_id', 1)->get();
        $psus = DB::table('items')->where('type_id', 6)->where('computer_id', 1)->get();
        $oss = DB::table('items')->where('type_id', 14)->where('computer_id', 1)->get();
        $monitors = DB::table('items')->where('type_id', 7)->where('computer_id', 1)->get();
        $mouses = DB::table('items')->where('type_id', 8)->where('computer_id', 1)->get();
        $kbs = DB::table('items')->where('type_id', 9)->where('computer_id', 1)->get();
        $lans = DB::table('items')->where('type_id', 10)->where('computer_id', 1)->get();
        $others = DB::table('items')->where('type_id', 11)->where('computer_id', 1)->get();

        $sellaptops = DB::table('items')->where('type_id', 13)->where('computer_id', $id)->get();
        $selmobos = DB::table('items')->where('type_id', 1)->where('computer_id', $id)->get();
        $selmobos = DB::table('items')->where('type_id', 1)->where('computer_id', $id)->get();
        $selprocs = DB::table('items')->where('type_id', 2)->where('computer_id', $id)->get();
        $selrams = DB::table('items')->where('type_id', 3)->where('computer_id', $id)->get();
        $selstors = DB::table('items')->where('type_id', 4)->where('computer_id', $id)->get();
        $selgpus = DB::table('items')->where('type_id', 5)->where('computer_id', $id)->get();
        $selpsus = DB::table('items')->where('type_id', 6)->where('computer_id', $id)->get();
        $seloss = DB::table('items')->where('type_id', 14)->where('computer_id', $id)->get();
        $selmonitors = DB::table('items')->where('type_id', 7)->where('computer_id', $id)->get();
        $selmouses = DB::table('items')->where('type_id', 8)->where('computer_id', $id)->get();
        $selkbs = DB::table('items')->where('type_id', 9)->where('computer_id', $id)->get();
        $sellans = DB::table('items')->where('type_id', 10)->where('computer_id', $id)->get();
        $selothers = DB::table('items')->where('type_id', 11)->where('computer_id', $id)->get();

        $Action = 'edit';
        $ComputerID = $id;
        
        return view('inventory.computer-add-edit', compact('Action', 'ComputerID', 'sites', 'laptops', 'mobos', 'procs', 'rams', 'stors', 'gpus', 'psus', 'oss', 'monitors', 'mouses', 'kbs', 'lans', 'others', 'user', 'ip_add', 'type', 'status', 'siteEdit', 'sellaptops', 'selmobos', 'selprocs', 'selrams', 'selstors', 'selgpus', 'selpsus', 'seloss', 'selmonitors', 'selmouses', 'selkbs', 'sellans', 'selothers'));
    }

    public function update(Request $request){
        $itemID = $request->itemID;
        $user = $request->user;
        $ip_add = $request->ip_add;
        $type = $request->type;
        $status = $request->status;
        $site = $request->site;

        $laptop = $request->laptop;
        $mobo = $request->mobo;
        $proc = $request->proc;
        $ram1 = $request->ram1;
        $ram2 = $request->ram2;
        $ram3 = $request->ram3;
        $ram4 = $request->ram4;
        $stor1 = $request->stor1;
        $stor2 = $request->stor2;
        $stor3 = $request->stor3;
        $stor4 = $request->stor4;
        $gpu = $request->gpu;
        $psu = $request->psu;
        $os = $request->os;
        $monitor = $request->monitor;
        $mouse = $request->mouse;
        $kb = $request->kb;
        $lan = $request->lan;
        $other1 = $request->other1;
        $other2 = $request->other2;
        $other3 = $request->other3;
        $other4 = $request->other4;
        $other5 = $request->other5;

        $request->validate([
            'user' => 'required',
            'ip_add' => 'required',
        ]);

        DB::update("UPDATE computers SET user=?, site=?, ip_add=?, type=?, status=?, conducted_by=?, date_conducted=? WHERE id=?", [$user, $site, $ip_add, $type, $status, auth()->user()->name, date('m-d-Y'), $itemID]);

        $comID = $itemID;

        DB::update("UPDATE items SET status='SPARE', computer_id='1', site_id='1', edited_by=? WHERE computer_id=?", [ auth()->user()->name, $comID]);

        if($laptop != null){
            DB::update("UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?", ['USED', $comID, $site, auth()->user()->name, $laptop]);
        }

        if($mobo != null){
            DB::update("UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?", ['USED', $comID, $site, auth()->user()->name, $mobo]);
        }

        if($proc != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $proc]);
        }

        if($ram1 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $ram1]);
        }

        if($ram2 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $ram2]);
        }

        if($ram3 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $ram3]);
        }

        if($ram4 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $ram4]);
        }

        if($stor1 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $stor1]);
        }

        if($stor2 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $stor2]);
        }

        if($stor3 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $stor3]);
        }

        if($stor4 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $stor4]);
        }

        if($gpu != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $gpu]);
        }

        if($psu != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $psu]);
        }

        if($os != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $os]);
        }

        if($monitor != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $monitor]);
        }

        if($mouse != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $mouse]);
        }

        if($kb != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $kb]);
        }

        if($lan != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $lan]);
        }

        if($other1 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $other1]);
        }

        if($other2 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $other2]);
        }

        if($other3 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $other3]);
        }

        if($other4 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $other4]);
        }

        if($other5 != null){
            DB::update('UPDATE items SET status=?, computer_id=?, site_id=?, edited_by=? WHERE id=?', ['USED', $comID, $site, auth()->user()->name, $other5]);
        }

        return redirect()->route('computer.index');
    }

    public function view(Request $request){
        $specLaptop = DB::table('items')->where('computer_id', $request->computerID)->where('type_id', 13)->first();
        if(isset($specLaptop->id)){
            $thisSpecLaptop = $specLaptop->brand.' '.$specLaptop->description;
        }else{
            $thisSpecLaptop = 'N/A';
        }

        $specMobo = DB::table('items')->where('computer_id', $request->computerID)->where('type_id', 1)->first();
        if(isset($specMobo->id)){
            $thisSpecMobo = $specMobo->brand.' '.$specMobo->description;
        }else{
            $thisSpecMobo = 'N/A';
        }
        
        $specProc = DB::table('items')->where('computer_id', $request->computerID)->where('type_id', 2)->first();
        if(isset($specProc->id)){
            $thisSpecProc = $specProc->brand.' '.$specProc->description;
        }else{
            $thisSpecProc = 'N/A';
        }
        
        $specRamArray = DB::table('items')->where('computer_id', $request->computerID)->where('type_id', 3)->get();
        $specRam = array();

        for($x = 0; $x < 4; $x++){
            if(isset($specRamArray[$x]->id)){
                $thisSpecRam = $specRamArray[$x]->brand.' '.$specRamArray[$x]->description;
            }else{
                $thisSpecRam = 'N/A';
            }
            array_push($specRam, $thisSpecRam);
        }
        
        $specStoreArray = DB::table('items')->where('computer_id', $request->computerID)->where('type_id', 4)->get();
        $specStore = array();

        for($x = 0; $x < 4; $x++){
            if(isset($specStoreArray[$x]->id)){
                $thisSpecStore = $specStoreArray[$x]->brand.' '.$specStoreArray[$x]->description;
            }else{
                $thisSpecStore = 'N/A';
            }
            array_push($specStore, $thisSpecStore);
        }
        
        $specGpu = DB::table('items')->where('computer_id', $request->computerID)->where('type_id', 5)->first();
        if(isset($specGpu->id)){
            $thisSpecGpu = $specGpu->brand.' '.$specGpu->description;
        }else{
            $thisSpecGpu = 'N/A';
        }
        
        $specPsu = DB::table('items')->where('computer_id', $request->computerID)->where('type_id', 6)->first();
        if(isset($specPsu->id)){
            $thisSpecPsu = $specPsu->brand.' '.$specPsu->description;
        }else{
            $thisSpecPsu = 'N/A';
        }
        
        $specOs = DB::table('items')->where('computer_id', $request->computerID)->where('type_id', 14)->first();
        if(isset($specOs->id)){
            $thisSpecOs = $specOs->brand.' '.$specOs->description;
        }else{
            $thisSpecOs = 'N/A';
        }
        
        $specMonitor = DB::table('items')->where('computer_id', $request->computerID)->where('type_id', 7)->first();
        if(isset($specMonitor->id)){
            $thisSpecMonitor = $specMonitor->brand.' '.$specMonitor->description;
        }else{
            $thisSpecMonitor = 'N/A';
        }
        
        $specMouse = DB::table('items')->where('computer_id', $request->computerID)->where('type_id', 8)->first();
        if(isset($specMouse->id)){
            $thisSpecMouse = $specMouse->brand.' '.$specMouse->description;
        }else{
            $thisSpecMouse = 'N/A';
        }
        
        $specKB = DB::table('items')->where('computer_id', $request->computerID)->where('type_id', 9)->first();
        if(isset($specKB->id)){
            $thisSpecKB = $specKB->brand.' '.$specKB->description;
        }else{
            $thisSpecKB = 'N/A';
        }
        
        $specLan = DB::table('items')->where('computer_id', $request->computerID)->where('type_id', 10)->first();
        if(isset($specLan->id)){
            $thisSpecLan = $specLan->brand.' '.$specLan->description;
        }else{
            $thisSpecLan = 'N/A';
        }
        
        $specOthersArray = DB::table('items')->where('computer_id', $request->computerID)->where('type_id', 11)->get();
        $specOthers = array();

        for($x = 0; $x < 5; $x++){
            if(isset($specOthersArray[$x]->id)){
                $thisSpecOthers = $specOthersArray[$x]->brand.' '.$specOthersArray[$x]->description;
            }else{
                $thisSpecOthers = 'N/A';
            }
            array_push($specOthers, $thisSpecOthers);
        }

        $result = array(
            'specLaptop' => $thisSpecLaptop,
            'specMobo' => $thisSpecMobo,
            'specProc' => $thisSpecProc,
            'specRam' => $specRam,
            'specStore' => $specStore,
            'specGpu' => $thisSpecGpu,
            'specPsu' => $thisSpecPsu,
            'specOs' => $thisSpecOs,
            'specMonitor' => $thisSpecMonitor,
            'specMouse' => $thisSpecMouse,
            'specKB' => $thisSpecKB,
            'specLan' => $thisSpecLan,
            'specOthers' => $specOthers,
        );

        echo json_encode($result);
    }
}

<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DeptInChargeController;
use App\Http\Controllers\IssuanceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemRequestController;
use App\Http\Controllers\ItemTypeController;
use App\Http\Controllers\PhoneSimController;
use App\Http\Controllers\PhoneSimReportController;
use App\Http\Controllers\PhoneSimRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SAPController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TicketCategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Models\DeptInCharge;
use App\Models\Issuance;
use App\Models\PhoneSim;
use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(!auth()->user()){
        return view('auth.login');
    }else{
        return redirect()->route('dashboard');
    }
});

Route::get('/dashboard', function () {
    if(auth()->user()->first_time_login == 1){
        return redirect()->route('changePass');
    }
    $userDept = '';
    $deptInCharge = '';

    $userDeptID = auth()->user()->dept_id;
    $userDeptRow = DB::table('departments')->where('id', $userDeptID)->first();
    if($userDeptRow != null){
        $userDept = $userDeptRow->name;
    }
    $deptInChargeRow = DB::table('dept_in_charges')->where('id', 1)->first();
    if($deptInChargeRow != null){
        $deptInCharge = $deptInChargeRow->dept_id;
    }

    $newTickets = DB::table('tickets')
        ->where('created_at', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 DAY)'))
        ->whereIn('status', ['PENDING', 'ONGOING'])
        ->count();

    if($userDeptID != $deptInCharge){
        $tickets = Ticket::with('requestor', 'departmentRow', 'category', 'assigned')
            ->whereIn('status', ['PENDING', 'ONGOING'])
            ->where('department', $userDeptID)
            ->orderBy('tickets.id', 'desc')
            ->limit(7)
            ->get();

        $userID = Auth::user()->id;

        $ticketReq = Ticket::where('user_id', $userID)
            ->whereIn('status', ['PENDING', 'ONGOING'])
            ->count();
            
        $pending = Ticket::where('user_id', $userID)
            ->where('department', $userDeptID)
            ->where('status', 'PENDING')
            ->count();
            
        $ongoing = Ticket::where('user_id', $userID)
            ->where('department', $userDeptID)
            ->where('status', 'ONGOING')
            ->count();

    }else{
        $tickets = Ticket::with('requestor', 'departmentRow', 'category', 'assigned')
        ->whereIn('status', ['PENDING', 'ONGOING'])
        ->orderBy('tickets.id', 'desc')
        ->limit(7)
        ->get();

        $userID = Auth::user()->id;

        $ticketReq = Ticket::where('assigned_to', $userID)
            ->whereIn('status', ['PENDING', 'ONGOING'])
            ->count();
            
        $pending = Ticket::where('assigned_to', $userID)
            ->where('department', $userDeptID)
            ->where('status', 'PENDING')
            ->count();
            
        $ongoing = Ticket::where('assigned_to', $userID)
            ->where('department', $userDeptID)
            ->where('status', 'ONGOING')
            ->count();
    }

    return view('dashboard', compact('userDept', 'tickets', 'deptInCharge', 'userDeptID', 'ticketReq', 'pending', 'ongoing', 'newTickets'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/change-password', [UserController::class, 'changePass'])->name('changePass');

    // Ticketing
    Route::get('/ticketing/dashboard', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/ticketing/create', [TicketController::class, 'create'])->name('ticket.create');
    Route::get('/ticketing/create-ticket', [TicketController::class, 'createForIT'])->name('ticket.createForIT');
    Route::post('/ticketing/store', [TicketController::class, 'store'])->name('ticket.store');
    Route::post('/ticketing/store-ticket', [TicketController::class, 'storeForIT'])->name('ticket.storeForIT');
    Route::post('/ticketing/temp', [TicketController::class, 'temp'])->name('ticket.temp');
    Route::post('/ticketing/update', [TicketController::class, 'update'])->name('ticket.update');
    Route::get('/ticketing/reports', [TicketController::class, 'report'])->name('ticket.reports');
    Route::post('/ticketing/reports', [TicketController::class, 'genReport'])->name('ticket.genReports');
    
    Route::get('/ticketing/sap', [SAPController::class, 'index'])->name('sap.index');
    Route::post('/ticketing/sap/store', [SAPController::class, 'store'])->name('sap.store');
    Route::post('/ticketing/sap/edit', [SAPController::class, 'edit'])->name('sap.edit');
    Route::post('/ticketing/sap/update', [SAPController::class, 'update'])->name('sap.update');
    Route::post('/ticketing/sap/details', [SAPController::class, 'details'])->name('sap.details');

    // Items
    Route::get('/inventory/items', [ItemController::class, 'index'])->name('item.index');
    Route::get('/inventory/items/add', [ItemController::class, 'add'])->name('item.add');
    Route::post('/inventory/items/store', [ItemController::class, 'store'])->name('item.store');
    Route::get('/inventory/items/edit/{id}', [ItemController::class, 'edit'])->name('item.edit');
    Route::post('/inventory/items/update', [ItemController::class, 'update'])->name('item.update');
    Route::post('/inventory/items/delete', [ItemController::class, 'delete'])->name('item.delete');
    Route::post('/inventory/items/mark-as-defective', [ItemController::class, 'defective'])->name('item.defective');
    Route::post('/inventory/items/change-status', [ItemController::class, 'status'])->name('item.status');
    Route::get('/inventory/items/invoice-download/{id}', [ItemController::class, 'download']);

    Route::get('/inventory/items/issuance-form/{id}', [ItemController::class, 'issuance']);
    Route::post('/inventory/items/edit-issuance-form', [ItemController::class, 'issuanceEdit'])->name('issuance.edit');
    Route::post('/inventory/items/update-issuance-form', [ItemController::class, 'issuanceUpdate'])->name('issuance.update');

    Route::get('/inventory/items/defective', [ItemController::class, 'defectiveIndex'])->name('defectiveIndex.index');
    Route::post('/inventory/items/defective/restore', [ItemController::class, 'defectiveRestore'])->name('defectiveIndex.restore');
    Route::get('/inventory/items/defective/{page}', [ItemController::class, 'defectivePaginate']);
    Route::get('/inventory/items/defective/{page}/{search}', [ItemController::class, 'defectiveSearch']);

    Route::get('/inventory/items/return', [ItemController::class, 'returnItem'])->name('return.index');
    Route::post('/inventory/items/return/print', [ItemController::class, 'returnPrint'])->name('return.print');
    Route::post('/inventory/items/return/update', [ItemController::class, 'returnUpdate'])->name('return.update');

    Route::get('/inventory/items/for-dispose', [ItemController::class, 'disposalIndex'])->name('disposal.index');
    Route::post('/inventory/items/for-dispose/add', [ItemController::class, 'disposalAdd'])->name('disposal.add');
    Route::post('/inventory/items/for-dispose/remove', [ItemController::class, 'disposalRemove'])->name('disposal.remove');
    Route::post('/inventory/items/for-dispose/disposed', [ItemController::class, 'disposalDisposed'])->name('disposal.disposed');
    Route::post('/inventory/items/for-dispose/print', [ItemController::class, 'disposalPrint'])->name('disposal.print');
    Route::get('/inventory/items/for-dispose/{page}', [ItemController::class, 'disposalPaginate']);
    Route::get('/inventory/items/for-dispose/{page}/{search}', [ItemController::class, 'disposalSearch']);


    Route::get('/inventory/items/disposed', [ItemController::class, 'disposedIndex'])->name('disposed.index');
    Route::get('/inventory/items/disposed/{page}', [ItemController::class, 'disposedPaginate']);
    Route::get('/inventory/items/disposed/{page}/{search}', [ItemController::class, 'disposedSearch']);


    Route::get('/inventory/items/{page}', [ItemController::class, 'itemPaginate']);
    Route::get('/inventory/items/{page}/{search}', [ItemController::class, 'itemSearch']);


    // Item Request
    Route::get('/request/items', [ItemRequestController::class, 'index'])->name('reqItem.index');
    Route::get('/request/items/add', [ItemRequestController::class, 'add'])->name('reqItem.add');
    Route::post('/request/items/store', [ItemRequestController::class, 'store'])->name('reqItem.store');
    Route::get('/request/items/edit/{id}', [ItemRequestController::class, 'edit'])->name('reqItem.edit');
    Route::post('/request/items/update', [ItemRequestController::class, 'update'])->name('reqItem.update');
    Route::get('/request/items/delivered/{id}', [ItemRequestController::class, 'statusD'])->name('reqItem.del');
    Route::post('/request/items/delete', [ItemRequestController::class, 'delete'])->name('reqItem.delete');;
    Route::post('/request/items/status-update', [ItemRequestController::class, 'statusUpdate'])->name('reqItem.statusUpdate');
    Route::post('/request/items/status-delivered', [ItemRequestController::class, 'statusDelivered'])->name('reqItem.statusDelivered');
    
    // Phone SIM
    Route::get('/inventory/phone-sim', [PhoneSimController::class, 'index'])->name('phoneSim.index');
    Route::post('/inventory/phone-sim/view', [PhoneSimController::class, 'view'])->name('phoneSim.view');
    Route::get('/inventory/phone-sim/add', [PhoneSimController::class, 'add'])->name('phoneSim.add');
    Route::post('/inventory/phone-sim/store', [PhoneSimController::class, 'store'])->name('phoneSim.store');
    Route::get('/inventory/phone-sim/edit/{id}', [PhoneSimController::class, 'edit'])->name('phoneSim.edit');
    Route::post('/inventory/phone-sim/update', [PhoneSimController::class, 'update'])->name('phoneSim.update');
    Route::post('/inventory/phone-sim/reissue', [PhoneSimController::class, 'reissue'])->name('phoneSim.reissue');
    Route::post('/inventory/phone-sim/delete', [PhoneSimController::class, 'delete'])->name('phoneSim.delete');
    Route::post('/inventory/phone-sim//mark-as-defective', [PhoneSimController::class, 'defective'])->name('phoneSim.defective');
    Route::get('/inventory/phone-sim/invoice-download/{id}', [PhoneSimController::class, 'download']);
    Route::get('/inventory/phone-sim/issuance-form/{id}', [PhoneSimController::class, 'issuance']);
    Route::get('/inventory/phone-sim/defective', [PhoneSimController::class, 'defectivePhoneIndex'])->name('defectivePhone.index');
    Route::post('/inventory/phone-sim/defective/restore', [PhoneSimController::class, 'defectivePhoneRestore'])->name('defectivePhone.restore');

    Route::get('/inventory/phone-sim/report', [PhoneSimReportController::class, 'index'])->name('phoneSim.report.index');
    Route::post('/inventory/phone-sim/report/generate', [PhoneSimReportController::class, 'generate'])->name('phoneSim.report.generate');

    Route::get('/inventory/phone-sim/{page}', [PhoneSimController::class, 'phoneSimPaginate']);
    Route::get('/inventory/phone-sim/{page}/{search}', [PhoneSimController::class, 'phoneSimSearch']);




    
    // Phone SIM Request
    Route::get('/request/phone-sim', [PhoneSimRequestController::class, 'index'])->name('reqPhoneSim.index');
    Route::get('/request/phone-sim/add', [PhoneSimRequestController::class, 'add'])->name('reqPhoneSim.add');
    Route::post('/request/phone-sim/store', [PhoneSimRequestController::class, 'store'])->name('reqPhoneSim.store');
    Route::get('/request/phone-sim/edit/{id}', [PhoneSimRequestController::class, 'edit'])->name('reqPhoneSim.edit');
    Route::post('/request/phone-sim/update', [PhoneSimRequestController::class, 'update'])->name('reqPhoneSim.update');
    Route::get('/request/phone-sim/delivered/{id}', [PhoneSimRequestController::class, 'statusD'])->name('reqPhoneSim.del');
    Route::post('/request/phone-sim/delete', [PhoneSimRequestController::class, 'delete'])->name('reqPhoneSim.delete');
    Route::post('/request/phone-sim/status-update', [PhoneSimRequestController::class, 'statusUpdate'])->name('reqPhoneSim.statusUpdate');
    Route::post('/request/phone-sim/status-delivered', [PhoneSimRequestController::class, 'statusDelivered'])->name('reqPhoneSim.statusDelivered');



    // Computer
    Route::get('/inventory/computers', [ComputerController::class, 'index'])->name('computer.index');
    Route::get('/inventory/computers/add', [ComputerController::class, 'add'])->name('computer.add');
    Route::post('/inventory/computers/store', [ComputerController::class, 'store'])->name('computer.store');
    Route::get('/inventory/computers/edit/{id}', [ComputerController::class, 'edit'])->name('computer.edit');
    Route::post('/inventory/computers/update', [ComputerController::class, 'update'])->name('computer.update');
    Route::post('/inventory/computers/getSpecs', [ComputerController::class, 'view'])->name('computer.view');
    Route::get('/inventory/computers/{page}', [ComputerController::class, 'ComputerPaginate']);
    Route::get('/inventory/computers/{page}/{search}', [ComputerController::class, 'computerSearch']);




    // ========================================= SYSTEM MANAGEMENT =========================================
        // Department
        Route::get('/system-management/departments', [DepartmentController::class, 'index'])->name('department.index');
        Route::post('/system-management/departments/add', [DepartmentController::class, 'add'])->name('department.add');
        Route::post('/system-management/departments/edit', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::post('/system-management/departments/delete', [DepartmentController::class, 'delete'])->name('department.delete');

        // User
        Route::get('/system-management/user', [UserController::class, 'index'])->name('user.index');
        Route::post('/system-management/user/add', [RegisteredUserController::class, 'store'])->name('user.add');
        Route::post('/system-management/user/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/system-management/user/update', [UserController::class, 'update'])->name('user.update');
        Route::post('/system-management/user/delete', [UserController::class, 'delete'])->name('user.delete');
        Route::post('/system-management/user/reset', [UserController::class, 'reset'])->name('user.reset');

        Route::post('/update-pass', [UserController::class, 'updatePass'])->name('updatePass');

        // Ticket Category
        Route::get('/system-management/ticket-category', [TicketCategoryController::class, 'index'])->name('category.index');
        Route::post('/system-management/ticket-category/add', [TicketCategoryController::class, 'add'])->name('category.add');
        Route::post('/system-management/ticket-category/edit', [TicketCategoryController::class, 'edit'])->name('category.edit');
        Route::post('/system-management/ticket-category/delete', [TicketCategoryController::class, 'delete'])->name('category.delete');
        Route::post('/system-management/ticket-category/update-in-charge', [DeptInChargeController::class, 'update'])->name('incharge.update');

        // Items Type
        Route::get('/system-management/item-type', [ItemTypeController::class, 'index'])->name('itemType.index');
        Route::post('/system-management/item-type/add', [ItemTypeController::class, 'add'])->name('itemType.add');
        Route::post('/system-management/item-type/edit', [ItemTypeController::class, 'edit'])->name('itemType.edit');
        Route::post('/system-management/item-type/delete', [ItemTypeController::class, 'delete'])->name('itemType.delete');

        // Sites
        Route::get('/system-management/site', [SiteController::class, 'index'])->name('site.index');
        Route::post('/system-management/site/add', [SiteController::class, 'add'])->name('site.add');
        Route::post('/system-management/site/edit', [SiteController::class, 'edit'])->name('site.edit');
        Route::post('/system-management/site/delete', [SiteController::class, 'delete'])->name('site.delete');

        // Settings
        Route::get('/system-management/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/system-management/settings/update', [SettingController::class, 'update'])->name('settings.update');
        Route::post('/system-management/settings/test-connection', [SettingController::class, 'test'])->name('settings.test');

        Route::get('/system-management/settings/user-agreement-for-devices', [SettingController::class, 'uadIndex'])->name('settings.uadIndex');
        Route::post('/system-management/settings/user-agreement-for-devices/test-print', [SettingController::class, 'uadTest'])->name('settings.uadTest');
        Route::post('/system-management/settings/user-agreement-for-devices/update', [SettingController::class, 'uadupdate'])->name('settings.uadupdate');

        Route::get('/system-management/settings/user-agreement-for-phonesim', [SettingController::class, 'uapsIndex'])->name('settings.uapsIndex');
        Route::post('/system-management/settings/user-agreement-for-phonesim/test-print', [SettingController::class, 'uapsTest'])->name('settings.uapsTest');
        Route::post('/system-management/settings/user-agreement-for-phonesim/update', [SettingController::class, 'uapsupdate'])->name('settings.uapsupdate');

    // ========================================= SYSTEM MANAGEMENT END =========================================

});

require __DIR__.'/auth.php';

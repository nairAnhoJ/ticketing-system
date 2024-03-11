<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(){
        $depts = DB::table('departments')->orderBy('name', 'asc')->where('id','!=','1')->get();
        $users = DB::select('SELECT users.id, users.id_no, users.name, departments.name AS dept, users.email, users.phone FROM users INNER JOIN departments ON users.dept_id = departments.id WHERE users.id != "1" ORDER BY users.name ASC');
        return view('admin.system-management.user', compact('users', 'depts'));
    }

    public function edit(Request $request){
        $id = $request->id;

        $user = DB::table('users')->where('id', $id)->get();

        $result = array("id_no"=>$user[0]->id_no, "name"=>$user[0]->name, "department"=>$user[0]->dept_id, "email"=>$user[0]->email, "phone"=>$user[0]->phone);

        echo json_encode($result);
    }

    public function update(Request $request){
        if($request->password != null){
            $request->validate([
                'id_no' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'department' => ['required'],
                'email' => ['required', 'email'],
                'phone' => ['required', 'string', 'max:255'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            DB::update('update users set id_no=?, name=?, dept_id=?, email=?, phone=?, password=? where id = ?', [strtoupper($request->id_no), strtoupper($request->name), $request->department, $request->email, $request->phone, Hash::make($request->password), $request->id]);
        }else{
            $request->validate([
                'id_no' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'department' => ['required'],
                'phone' => ['required', 'string', 'max:255'],
            ]);

            DB::update('update users set id_no=?, name=?, dept_id=?, email=?, phone=? where id = ?', [strtoupper($request->id_no), strtoupper($request->name), $request->department, $request->email, $request->phone, $request->id]);
        }

        return redirect()->route('user.index')->with('success', 'User details has been updated successfully');
    }

    public function delete(Request $request){
        DB::delete('delete from users where id = ?', [$request->id]);
        return redirect()->route('user.index')->with('success', 'User details has been deleted successfully');
    }

    public function changePass(){
        return view('change-pass');
    }

    public function updatePass(Request $request){

        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::update('update users set password=?, first_time_login=0 where id = ?', [Hash::make($request->password), auth()->user()->id]);

        return redirect()->route('dashboard');
    }

    public function reset(Request $request){
        DB::table('users')
            ->where('id', $request->id)
            ->update([
                'password' => '$2y$10$EPxPbc./USkzSuIDCIvQl.4i43hoH1GPjE62Oxv3GpDrjon4Laj2O',
                'first_time_login' => 1
            ]);

        return redirect()->route('user.index')->with('success', 'Password Reset Successful!');
    }
}
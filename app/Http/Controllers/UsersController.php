<?php

namespace App\Http\Controllers;

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;



class UsersController extends Controller
{
    public function index(){
        $data = User::orderBy("id","desc")->paginate(10);
        return view('user.index',compact('data'));
    }

    public function create(){
        $roles = Role::pluck('name','name')->all();
        return view('user.create',compact('roles'));
    }

    public function store(Request $request){
        // $this->validate($request, [
        //     'password' => 'required|same:confirm-password',
        // ]);

    //    $input = $request->all();
    //    $input['password'] = Hash::make($input['password']);
    //    $user = User::create($input);
        $user = new User();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->remark = $request->remark;
        $user->email= $request->email;
        $user->phone = $request->phone;
        $user->second_phone = $request->second_phone;
        $user->password = Hash::make($request->password);

       $user->assignRole($request->input('roles'));
       $user->save();
       
       return redirect()->route('users.index')->with('success','User Created Successfully');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('user.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request ,$id){
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->address = $request->address;
        $user->remark = $request->remark;
        $user->email= $request->email;
        $user->phone = $request->phone;
        $user->second_phone = $request->second_phone;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));
        $user->save();

        return redirect()->route('users.index')->with('success','User updated successfully');
    }

    public function destroy($id){
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success','User deleted successfully');
    }
}

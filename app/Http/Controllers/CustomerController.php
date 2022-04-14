<?php

namespace App\Http\Controllers;

use App\customer;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function create(){
        $users = User::role('User')->get();
        $roles = Role::where('name','Customer')->pluck('name','name')->all();
        return view('Customer.create',compact('users','roles'));
    }

    public function index(){
        $customers = customer::where("user_id",Auth::user()->id)->orderBy('id','desc')->paginate();
        $customers->map(function($data){
            $user = User::where('id',$data->assign)->first();
            $data->assign = $user->name;
            return $data;
        });
        return view('customer.index',compact('customers'));
    }

    public function store(Request $request){
        $customer = new customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->second_phone = $request->second_phone;
        $customer->area = $request->area;
        $customer->remark = $request->remark;
        $customer->assign = $request->assign;

       $customer->role= $request->roles;
       $customer->user_id = Auth::user()->id;
       $customer->save();
       
       return redirect()->route('customers.index')->with('success','Customer Created Successfully');
    }

    public function edit($id){
        $users = User::role('User')->get();
        $roles = Role::where('name','Customer')->pluck('name','name')->all();
        $customer = customer::findOrFail($id);
        return view('customer.edit',compact('roles','customer','users'));
    }

    public function update(Request $request,$id){
        $customer = customer::findOrFail($id);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->second_phone = $request->second_phone;
        $customer->area = $request->area;
        $customer->remark = $request->remark;
        $customer->assign = $request->assign;

       $customer->role= $request->roles;
       $customer->save();
       
       return redirect()->route('customers.index')->with('success','Customer Created Successfully');
    }

    public function destroy($id){
        customer::findOrFail($id)->delete();
        return redirect()->back()->with('success','Customer deleted successfully');
    }
}

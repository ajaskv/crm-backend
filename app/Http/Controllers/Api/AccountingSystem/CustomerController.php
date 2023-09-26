<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Collection;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class CustomerController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $Project = Customer::all();
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Customer_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [ 
                'customer_id' => 'required',
                'name' => 'required',
                'email'=> 'required|email|unique:Customers',
                'billing_name' => 'required',
                'billing_country' => 'required',
                'billing_state' => 'required',
                'billing_city' => 'required',
                'billing_phone' => 'required',
                'user_id' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $new = new Customer();
        $new->customer_id = $req->customer_id;
        $new->name = $req->name;
        $new->email = $req->email;
        $new->tax_number = $req->tax_number;
        $new->contact = $req->contact;
       // $new->password = Hash::make($req->password);
        $new->created_by = $req->user_id;
        $new->billing_name = $req->billing_name;
        $new->billing_country = $req->billing_country;
        $new->billing_state = $req->billing_state;
        $new->billing_city = $req->billing_city;
        $new->billing_phone = $req->billing_phone;
        $new->billing_zip = $req->billing_zip;
        $new->billing_address = $req->billing_address;
        $new->shipping_name = $req->shipping_name;
        $new->shipping_country = $req->shipping_country;
        $new->shipping_state = $req->shipping_state;
        $new->shipping_city = $req->shipping_city;
        $new->shipping_phone = $req->shipping_phone;
        $new->shipping_zip = $req->shipping_zip;
        $new->shipping_address = $req->shipping_address;
        $new->save();
        return $this->success([], 'Customer save successfully.');
    }

    function getCustomerById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $Project = Customer::where(['id' => $request->id])->get();

       // return sizeof($Project);
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Customer(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'name' => 'required',
                'email'=> 'required|email|unique:Customers',
                'billing_name' => 'required',
                'billing_country' => 'required',
                'billing_state' => 'required',
                'billing_city' => 'required',
                'billing_phone' => 'required',
                'user_id' => 'required',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'customer_id' => $req->customer_id,
            'name' => $req->name,
            'email' => $req->email,
            'tax_number' => $req->tax_number,
            'contact' => $req->contact,
            'created_by' => $req->user_id,
            'billing_name' => $req->billing_name,
            'billing_country' => $req->billing_country,
            'billing_state' => $req->billing_state,
            'billing_city' => $req->billing_city,
            'billing_phone' => $req->billing_phone,
            'billing_zip' => $req->billing_zip,
            'billing_address' => $req->billing_address,
            'shipping_name' => $req->shipping_name,
            'shipping_country' => $req->shipping_country,
            'shipping_state' => $req->shipping_state,
            'shipping_city' => $req->shipping_city,
            'shipping_phone' => $req->shipping_phone,
            'shipping_zip' => $req->shipping_zip,
            'shipping_address' => $req->shipping_address,
        ];
        
        DB::table('customers')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Customers update successfully.');
    }

   

    function Customer_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('customers')->where(['id' => $request->id])->first()) {
            DB::table('customers')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Customers delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

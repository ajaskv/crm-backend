<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Support\Collection;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class ProposalController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $Project = Proposal::all();
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Proposal_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [ 
                'proposal_id' => 'required',
                'customer_id' => 'required',
                'issue_date'=> 'required',
                'send_date' => 'required',
                'category_id' => 'required',
                'status' => 'required',
                'discount_apply' => 'required',
                'converted_invoice_id' => 'required',
                'user_id' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $new = new Proposal();
        $new->proposal_id = $req->proposal_id;
        $new->customer_id = $req->customer_id;
        $new->issue_date = $req->issue_date;
        $new->send_date = $req->send_date;
        $new->category_id = $req->category_id;
        $new->discount_apply = $req->discount_apply;
        $new->converted_invoice_id = $req->converted_invoice_id;
        $new->status = $req->status;
        $new->created_by = $req->user_id;
       
        $new->save();
        return $this->success([], 'Proposal save successfully.');
    }

    function getProposalById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $Project = Vender::where(['id' => $request->id])->get();

       // return sizeof($Project);
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Proposal(Request $req){
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
        
        DB::table('venders')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Vender update successfully.');
    }

   

    function Proposal_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('venders')->where(['id' => $request->id])->first()) {
            DB::table('venders')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Vender delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

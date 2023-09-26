<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Support\Collection;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class BackAccountController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $Project = BankAccount::all();
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function BackAccount_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [ 
                'holder_name' => 'required',
                'bank_name' => 'required',
                'account_number' => 'required',
                'opening_balance' => 'required',
                'contact_number' => 'required',
                'bank_address' => 'required',
                'user_id' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $new = new BankAccount();
        $new->account_id = $req->account_id;
        $new->holder_name = $req->holder_name;
        $new->bank_name = $req->bank_name;
        $new->account_number = $req->account_number;
        $new->opening_balance = $req->opening_balance;
        $new->contact_number = $req->contact_number;
        $new->bank_address = $req->bank_address;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Bank account details save successfully.');
    }

    function getBackAccountById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $Project = BankAccount::where(['id' => $request->id])->get();

       // return sizeof($Project);
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_BackAccount(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'holder_name' => 'required',
                'bank_name' => 'required',
                'account_number' => 'required',
                'opening_balance' => 'required',
                'contact_number' => 'required',
                'bank_address' => 'required',
                'user_id' => 'required',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'account_id' => $req->account_id,
            'holder_name' => $req->holder_name,
            'bank_name' => $req->bank_name,
            'account_number' => $req->account_number,
            'opening_balance' => $req->opening_balance,
            'contact_number' => $req->contact_number,
            'bank_address' => $req->bank_address,
            'created_by' => $req->user_id,
        ];
        
        DB::table('bank_accounts')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Bank account details update successfully.');
    }

   

    function BackAccount_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('bank_accounts')->where(['id' => $request->id])->first()) {
            DB::table('bank_accounts')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Bank account delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

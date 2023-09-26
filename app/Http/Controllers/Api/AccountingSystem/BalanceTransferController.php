<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\BankTransfer;
use Illuminate\Support\Collection;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class BalanceTransferController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $Project = BankTransfer::all();
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function BalanceTransfer_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [ 
                'from_account' => 'required',
                'to_account' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'payment_method' => 'required',
                'description' => 'required',
                'user_id' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $new = new BankTransfer();
        $new->from_account = $req->from_account;
        $new->to_account = $req->to_account;
        $new->amount = $req->amount;
        $new->date = $req->date;
        $new->payment_method = $req->payment_method;
        $new->reference = $req->reference;
        $new->description = $req->description;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Bank transfer save successfully.');
    }

    function getBalanceTransferById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $Project = BankTransfer::where(['id' => $request->id])->get();

       // return sizeof($Project);
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_BalanceTransfer(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'from_account' => 'required',
                'to_account' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'payment_method' => 'required',
                'description' => 'required',
                'user_id' => 'required',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'from_account' => $req->from_account,
            'to_account' => $req->to_account,
            'amount' => $req->amount,
            'date' => $req->date,
            'payment_method' => $req->payment_method,
            'reference' => $req->reference,
            'description' => $req->description,
            'created_by' => $req->user_id,
        ];
        
        DB::table('bank_transfers')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Bank transfer update successfully.');
    }

   

    function BalanceTransfer_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('bank_transfers')->where(['id' => $request->id])->first()) {
            DB::table('bank_transfers')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Bank transfer delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

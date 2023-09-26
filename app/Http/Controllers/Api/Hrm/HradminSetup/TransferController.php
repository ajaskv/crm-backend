<?php

namespace App\Http\Controllers\Api\Hrm\HradminSetup;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class TransferController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Transfer::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Transfer_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'employee_id' => 'required',
                'branch_id' => 'required',
                'department_id' => 'required',
                'transfer_date' => 'required',
                'description' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Transfer();
        $new->employee_id = $req->employee_id;
        $new->branch_id = $req->branch_id;
        $new->department_id = $req->department_id;
        $new->transfer_date = $req->transfer_date;
        $new->description = $req->description;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Transfer save successfully.');
    }

    function getTransferById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Transfer::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Transfer(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'employee_id' => 'required',
                'branch_id' => 'required',
                'department_id' => 'required',
                'transfer_date' => 'required',
                'description' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'employee_id' => $req->employee_id,
            'branch_id' => $req->branch_id,
            'department_id' => $req->department_id,
            'transfer_date' => $req->transfer_date,
            'description' => $req->description,
            'created_by' => $req->user_id
        ];
        
        DB::table('transfers')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Transfer update successfully.');
    }

    function Transfer_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('transfers')->where(['id' => $request->id])->first()) {
            DB::table('transfers')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Transfer delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    
}

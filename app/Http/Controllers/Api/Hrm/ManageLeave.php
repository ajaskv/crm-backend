<?php

namespace App\Http\Controllers\Api\Hrm;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\Leave;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class ManageLeave extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Leave::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function store_MangeLeave(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'employee_id' => 'required',
                'leave_type_id' => 'required',
                'applied_on' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'total_leave_days' => 'required',
                'leave_reason' => 'required',
                'status' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }
        $new = new Leave();
        $new->employee_id = $req->employee_id;
        $new->leave_type_id = $req->leave_type_id;
        $new->applied_on = $req->applied_on;
        $new->start_date = $req->start_date;
        $new->end_date = $req->end_date;
        $new->total_leave_days = $req->total_leave_days;
        $new->leave_reason = $req->leave_reason;
        $new->status = $req->status;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Leave save successfully.');
    }

    function getMangeLeaveById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Leave::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_MangeLeave(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'employee_id' => 'required',
                'leave_type_id' => 'required',
                'applied_on' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'total_leave_days' => 'required',
                'leave_reason' => 'required',
                'status' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'employee_id' => $req->employee_id,
            'leave_type_id' => $req->leave_type_id,
            'applied_on' => $req->applied_on,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date,
            'total_leave_days' => $req->total_leave_days,
            'leave_reason' => $req->leave_reason,
            'status' => $req->status,
            'created_by' => $req->user_id
        ];
        
        DB::table('leaves')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Leaves update successfully.');
    }

    function MangeLeave_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('leaves')->where(['id' => $request->id])->first()) {
            DB::table('leaves')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Leave delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function LeaveAction(Request $req){
        $validator = \Validator::make(
        $req->all(), [
            'id' => 'required',
            'status' => 'required',
            'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $dealData = [
            'status' => $req->status,
            'created_by' => $req->user_id
        ];
        // return $dealData;
        DB::table('leaves')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Leave status update successfully.');
    }
}

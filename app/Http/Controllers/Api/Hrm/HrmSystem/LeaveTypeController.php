<?php

namespace App\Http\Controllers\Api\Hrm\HrmSystem;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class LeaveTypeController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = LeaveType::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function LeaveType_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'title' => 'required',
                'days' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new LeaveType();
        $new->title = $req->title;
        $new->days = $req->days;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Leave type save successfully.');
    }

    function getLeaveTypeById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = LeaveType::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_LeaveType(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'title' => 'required',
                'days' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'title' => $req->title,
            'days' => $req->days,
            'created_by' => $req->user_id
        ];
        
        DB::table('leave_types')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Leave type update successfully.');
    }

    function LeaveType_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('leave_types')->where(['id' => $request->id])->first()) {
            DB::table('leave_types')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Leave types delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    
}

<?php

namespace App\Http\Controllers\Api\Hrm;

use App\Http\Controllers\Controller;
//use App\Models\Indicator;
use App\Models\Meeting;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class MeetingController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Meeting::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function store_Meeting(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'branch_id' => 'required',
                'department_id' => 'required',
                'employee_id' => 'required',
                'title' => 'required',
                'date' => 'required',
                'time' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Meeting();
        $new->branch_id = $req->branch_id;
        $new->department_id = $req->department_id;
        $new->employee_id = $req->employee_id;
        $new->title = $req->title;
        $new->date = $req->date;
        $new->time = $req->time;
        $new->note = $req->note;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Meeting save successfully.');
    }

    function getMeetingById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Meeting::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Meeting(Request $req){
        $validator = \Validator::make(
        $req->all(), [
            'id' => 'required',
            'branch_id' => 'required',
            'department_id' => 'required',
            'employee_id' => 'required',
            'title' => 'required',
            'date' => 'required',
            'time' => 'required',
            'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $dealData = [
            'branch_id' => $req->branch_id,
            'department_id' => $req->department_id,
            'employee_id' => $req->employee_id,
            'title' => $req->title,
            'date' => $req->date,
            'time' => $req->time,
            'note' => $req->note,
            'created_by' => $req->user_id
        ];
        
        DB::table('meetings')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Meeting update successfully.');
    }

    function Meeting_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('meetings')->where(['id' => $request->id])->first()) {
            DB::table('meetings')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Meeting delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

  
}

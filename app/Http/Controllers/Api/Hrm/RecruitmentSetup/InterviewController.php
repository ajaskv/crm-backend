<?php

namespace App\Http\Controllers\Api\Hrm\RecruitmentSetup;

use App\Http\Controllers\Controller;
//use App\Models\Indicator;
use App\Models\InterviewSchedule;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class InterviewController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = InterviewSchedule::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Interview_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'candidate' => 'required',
                'employee' => 'required',
                'date' => 'required',
                'time' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new InterviewSchedule();
        $new->candidate = $req->candidate;
        $new->employee = $req->employee;
        $new->date = $req->date;
        $new->time = $req->time;
        $new->comment = $req->comment;
       // $new->employee_response = $req->employee_response;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Interview save successfully.');
    }

    function getInterviewById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = InterviewSchedule::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Interview(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'candidate' => 'required',
                'employee' => 'required',
                'date' => 'required',
                'time' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $dealData = [
            'candidate' => $req->candidate,
            'employee' => $req->employee,
            'date' => $req->date,
            'time' => $req->time,
            'comment' => $req->comment,
            'created_by' => $req->user_id
        ];
        
        DB::table('interview_schedules')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Interview update successfully.');
    }

    function Interview_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('interview_schedules')->where(['id' => $request->id])->first()){
            DB::table('interview_schedules')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Interview delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

  
}

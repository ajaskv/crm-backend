<?php

namespace App\Http\Controllers\Api\Hrm\RecruitmentSetup;

use App\Http\Controllers\Controller;
//use App\Models\Indicator;
use App\Models\Job;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class JobController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Job::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Job_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'title' => 'required',
                'branch' => 'required',
                'category' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Job();
        $new->title = $req->title;
        $new->description = $req->description;
        $new->requirement = $req->requirement;
        $new->branch = $req->branch;
        $new->category = $req->category;
        $new->skill = $req->skill;
        $new->position = $req->position;
        $new->start_date = $req->start_date;
        $new->end_date = $req->end_date;
        $new->status = $req->status;
        $new->applicant = $req->applicant;
        $new->visibility = $req->visibility;
        $new->code = $req->code;
        $new->custom_question = $req->custom_question;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'job save successfully.');
    }

    function getJobById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Job::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Job(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'title' => 'required',
                'branch' => 'required',
                'category' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $dealData = [
            'title' => $req->title,
            'description' => $req->description,
            'requirement' => $req->requirement,
            'branch' => $req->branch,
            'category' => $req->category,
            'skill' => $req->skill,
            'position' => $req->position,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date,
            'status' => $req->status,
            'created_by' => $req->user_id
        ];
        
        DB::table('jobs')->where('id',$req->id)->update($dealData);
        return $this->success([], 'job update successfully.');
    }

    function Job_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('jobs')->where(['id' => $request->id])->first()){
            DB::table('jobs')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('job delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

  
}

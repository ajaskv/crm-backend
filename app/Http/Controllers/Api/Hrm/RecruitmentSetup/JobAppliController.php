<?php

namespace App\Http\Controllers\Api\Hrm\RecruitmentSetup;

use App\Http\Controllers\Controller;
//use App\Models\Indicator;
use App\Models\JobApplication;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class JobAppliController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = JobApplication::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Applicaton_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'job' => 'required',
                'stage' => 'required',
                'order' => 'required',
                'rating' => 'required',
                'is_archive' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $profile =  $req->profile->store('public/jobApplication');
        $resume =  $req->resume->store('public/jobApplication');

        $new = new JobApplication();
        $new->job = $req->job;
        $new->name = $req->name;
        $new->email = $req->email;
        $new->phone = $req->phone;
        $new->profile = $profile;
        $new->resume = $resume;
        $new->cover_letter = $req->cover_letter;
        $new->dob = $req->dob;
        $new->gender = $req->gender;
        $new->country = $req->country;
        $new->state = $req->state;
        $new->city = $req->city;
        $new->stage = $req->stage;
        $new->order = $req->order;
        $new->skill = $req->skill;
        $new->rating = $req->rating;
        $new->is_archive = $req->is_archive;
        $new->custom_question = $req->custom_question;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Job application save successfully.');
    }

    function getApplicatonById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = JobApplication::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function getcandidate(Request $request){
        $validator = \Validator::make($request->all(),[
            'is_archive'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = JobApplication::where(['is_archive' => $request->is_archive])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Applicaton(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'job' => 'required',
                'stage' => 'required',
                'order' => 'required',
                'rating' => 'required',
                'is_archive' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $profile =  $req->profile->store('public/jobApplication');
        $resume =  $req->resume->store('public/jobApplication');
        $dealData = [
            'job' => $req->job,
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'profile' => $profile,
            'resume' => $resume,
            'cover_letter' => $req->cover_letter,
            'dob' => $req->dob,
            'gender' => $req->gender,
            'country' => $req->country,
            'state' => $req->state,
            'city' => $req->city,
            'stage' => $req->stage,
            'order' => $req->order,
            'skill' => $req->skill,
            'rating' => $req->rating,
            'is_archive' => $req->is_archive,
            'custom_question' => $req->custom_question,
            'created_by' => $req->user_id
        ];
        
        DB::table('job_applications')->where('id',$req->id)->update($dealData);
        return $this->success([], 'job application update successfully.');
    }

    function Applicaton_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('job_applications')->where(['id' => $request->id])->first()){
            DB::table('job_applications')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('job application delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

  
}

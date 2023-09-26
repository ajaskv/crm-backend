<?php

namespace App\Http\Controllers\Api\Hrm\HrmSystem;

use App\Http\Controllers\Controller;
use App\Models\JobStage;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class JobStageController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = JobStage::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function JobStage_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'title' => 'required',
                'order_id' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new JobStage();
        $new->title = $req->title;
        $new->order = $req->order_id;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Job Stage save successfully.');
    }

    function getJobStageById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = JobStage::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_JobStage(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'title' => 'required',
                'order_id' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'title' => $req->title,
            'order' => $req->order_id,
            'created_by' => $req->user_id
        ];
        
        DB::table('job_stages')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Job Stage update successfully.');
    }

    function JobStage_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('job_stages')->where(['id' => $request->id])->first()) {
            DB::table('job_stages')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Job Stage delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    
}

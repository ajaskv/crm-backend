<?php

namespace App\Http\Controllers\Api\Hrm\HrmSystem;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class JobCategoryController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = JobCategory::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function JobCategory_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'title' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new JobCategory();
        $new->title = $req->title;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Job Category save successfully.');
    }

    function getJobCategoryById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = JobCategory::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_JobCategory(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'title' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'title' => $req->title,
            'created_by' => $req->user_id
        ];
        
        DB::table('job_categories')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Job Category update successfully.');
    }

    function JobCategory_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('job_categories')->where(['id' => $request->id])->first()) {
            DB::table('job_categories')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Job Category delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    
}

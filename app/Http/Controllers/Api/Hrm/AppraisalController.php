<?php

namespace App\Http\Controllers\Api\Hrm;

use App\Http\Controllers\Controller;
//use App\Models\Indicator;
use App\Models\Appraisal;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class AppraisalController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Appraisal::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function store_appraisal(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'branch' => 'required',
                'employee' => 'required',
                'appraisal_date' => 'required',
                'customer_experience' => 'required',
                'marketing' => 'required',
                'administration' => 'required',
                'professionalism' => 'required',
                'integrity' => 'required',
                'attendance' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Appraisal();
        $new->branch = $req->branch;
        $new->employee = $req->employee;
        $new->appraisal_date = $req->appraisal_date;
        $new->rating = $req->rating;
        $new->customer_experience = $req->customer_experience;
        $new->marketing = $req->marketing;
        $new->administration = $req->administration;
        $new->professionalism = $req->professionalism;
        $new->integrity = $req->integrity;
        $new->attendance = $req->attendance;
        $new->remark = $req->remark;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Appraisal save successfully.');
    }

    function getappraisalById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Appraisal::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_appraisal(Request $req){
        $validator = \Validator::make(
        $req->all(), [
            'id' => 'required',
            'branch' => 'required',
            'employee' => 'required',
            'appraisal_date' => 'required',
            'customer_experience' => 'required',
            'marketing' => 'required',
            'administration' => 'required',
            'professionalism' => 'required',
            'integrity' => 'required',
            'attendance' => 'required',
            'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $dealData = [
            'branch' => $req->branch,
            'department' => $req->department,
            'designation' => $req->designation,
            'rating' => $req->rating,
            'customer_experience' => $req->customer_experience,
            'marketing' => $req->marketing,
            'administration' => $req->administration,
            'professionalism' => $req->professionalism,
            'integrity' => $req->integrity,
            'attendance' => $req->attendance,
            'created_by' => $req->user_id
        ];
        
        DB::table('appraisals')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Appraisal update successfully.');
    }

    function appraisal_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('appraisals')->where(['id' => $request->id])->first()) {
            DB::table('appraisals')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Appraisal delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

  
}

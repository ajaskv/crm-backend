<?php

namespace App\Http\Controllers\Api\Hrm;

use App\Http\Controllers\Controller;
use App\Models\Indicator;
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
class IndicatorController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Indicator::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function store_indicator(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'branch' => 'required',
                'department' => 'required',
                'designation' => 'required',
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
        $new = new Indicator();
        $new->branch = $req->branch;
        $new->department = $req->department;
        $new->designation = $req->designation;
        $new->rating = $req->rating;
        $new->customer_experience = $req->customer_experience;
        $new->marketing = $req->marketing;
        $new->administration = $req->administration;
        $new->professionalism = $req->professionalism;
        $new->integrity = $req->integrity;
        $new->attendance = $req->attendance;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Indicator save successfully.');
    }

    function getMangeLeaveById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Indicator::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_indicator(Request $req){
        $validator = \Validator::make(
        $req->all(), [
            'id' => 'required',
            'branch' => 'required',
            'department' => 'required',
            'designation' => 'required',
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
        
        DB::table('indicators')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Indicator update successfully.');
    }

    function indicator_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('indicators')->where(['id' => $request->id])->first()) {
            DB::table('indicators')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Indicator delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

  
}

<?php

namespace App\Http\Controllers\Api\Hrm\HradminSetup;

use App\Http\Controllers\Controller;
use App\Models\Warning;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class WarningController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Warning::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Warning_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'complaint_from' => 'required',
                'complaint_against' => 'required',
                'title' => 'required',
                'complaint_date' => 'required',
                'description' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Warning();
        $new->complaint_from = $req->complaint_from;
        $new->complaint_against = $req->complaint_against;
        $new->title = $req->title;
        $new->complaint_date = $req->complaint_date;
        $new->description = $req->description;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Complaint save successfully.');
    }

    function getWarningById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Warning::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Warning(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'complaint_from' => 'required',
                'complaint_against' => 'required',
                'title' => 'required',
                'complaint_date' => 'required',
                'description' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'complaint_from' => $req->complaint_from,
            'complaint_against' => $req->complaint_against,
            'title' => $req->title,
            'complaint_date' => $req->complaint_date,
            'description' => $req->description,
            'created_by' => $req->user_id
        ];
        
        DB::table('warnings')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Complaint update successfully.');
    }

    function Warning_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('warnings')->where(['id' => $request->id])->first()) {
            DB::table('warnings')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Complaint delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    
}

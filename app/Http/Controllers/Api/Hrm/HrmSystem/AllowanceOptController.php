<?php

namespace App\Http\Controllers\Api\Hrm\HrmSystem;

use App\Http\Controllers\Controller;
use App\Models\AllowanceOption;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class AllowanceOptController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = AllowanceOption::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function AllowanceOpt_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new AllowanceOption();
        $new->name = $req->name;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Allowance option save successfully.');
    }

    function getAllowanceOptById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = AllowanceOption::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_AllowanceOpt(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'name' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'name' => $req->name,
            'created_by' => $req->user_id
        ];
        
        DB::table('allowance_options')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Allowance option update successfully.');
    }

    function AllowanceOpt_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('allowance_options')->where(['id' => $request->id])->first()) {
            DB::table('allowance_options')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Allowance option delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    
}

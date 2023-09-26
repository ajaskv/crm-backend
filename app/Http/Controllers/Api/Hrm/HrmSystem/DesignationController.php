<?php

namespace App\Http\Controllers\Api\Hrm\HrmSystem;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class DesignationController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Designation::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Designation_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'department_id' => 'required',
                'name' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Designation();
        $new->department_id = $req->department_id;
        $new->name = $req->name;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Designation save successfully.');
    }

    function getDesignationById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Designation::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Designation(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'department_id' => 'required',
                'name' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'department_id' => $req->department_id,
            'name' => $req->name,
            'created_by' => $req->user_id
        ];
        
        DB::table('designations')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Designation update successfully.');
    }

    function Designation_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('designations')->where(['id' => $request->id])->first()) {
            DB::table('designations')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Designation delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    
}

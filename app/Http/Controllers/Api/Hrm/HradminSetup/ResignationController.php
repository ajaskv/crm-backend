<?php

namespace App\Http\Controllers\Api\Hrm\HradminSetup;

use App\Http\Controllers\Controller;
use App\Models\Resignation;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class ResignationController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Resignation::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Resignation_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'employee_id' => 'required',
                'notice_date' => 'required',
                'resignation_date' => 'required',
                'description' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Resignation();
        $new->employee_id = $req->employee_id;
        $new->notice_date = $req->notice_date;
        $new->resignation_date = $req->resignation_date;
        $new->description = $req->description;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Resignation save successfully.');
    }

    function getResignationById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Resignation::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Resignation(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'employee_id' => 'required',
                'notice_date' => 'required',
                'resignation_date' => 'required',
                'description' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'employee_id' => $req->employee_id,
            'notice_date' => $req->notice_date,
            'notice_date' => $req->notice_date,
            'resignation_date' => $req->resignation_date,
            'description' => $req->description,
            'created_by' => $req->user_id
        ];
        
        DB::table('resignations')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Resignation update successfully.');
    }

    function Resignation_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('resignations')->where(['id' => $request->id])->first()) {
            DB::table('resignations')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Resignation delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    
}

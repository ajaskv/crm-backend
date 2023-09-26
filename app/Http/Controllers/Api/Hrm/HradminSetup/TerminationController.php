<?php

namespace App\Http\Controllers\Api\Hrm\HradminSetup;

use App\Http\Controllers\Controller;
use App\Models\Termination;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class TerminationController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Termination::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Termination_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'employee_id' => 'required',
                'notice_date' => 'required',
                'termination_date' => 'required',
                'termination_type' => 'required',
                'description' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Termination();
        $new->employee_id = $req->employee_id;
        $new->notice_date = $req->notice_date;
        $new->termination_date = $req->termination_date;
        $new->termination_type = $req->termination_type;
        $new->description = $req->description;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Termination save successfully.');
    }

    function getTerminationById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Termination::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Termination(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'employee_id' => 'required',
                'notice_date' => 'required',
                'termination_date' => 'required',
                'termination_type' => 'required',
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
            'termination_date' => $req->termination_date,
            'termination_type' => $req->termination_type,
            'description' => $req->description,
            'created_by' => $req->user_id
        ];
        
        DB::table('terminations')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Termination update successfully.');
    }

    function Termination_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('terminations')->where(['id' => $request->id])->first()) {
            DB::table('terminations')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Termination delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    
}

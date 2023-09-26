<?php

namespace App\Http\Controllers\Api\Hrm\RecruitmentSetup;

use App\Http\Controllers\Controller;
//use App\Models\Indicator;
use App\Models\JobOnBoard;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class JobBoardingController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = JobOnBoard::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function boarding_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'application' => 'required',
                'convert_to_employee' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new JobOnBoard();
        $new->application = $req->application;
        $new->joining_date = $req->joining_date;
        $new->status = $req->status;
        $new->convert_to_employee = $req->convert_to_employee;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'job on-boarding successfully.');
    }

    function getboardingById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = JobOnBoard::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_boarding(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'joining_date'=> 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $dealData = [
            'joining_date' => $req->joining_date,
            'status' => $req->status,
            'created_by' => $req->user_id
        ];
        
        DB::table('job_on_boards')->where('id',$req->id)->update($dealData);
        return $this->success([], 'job on-boards update successfully.');
    }

    function boarding_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('job_on_boards')->where(['id' => $request->id])->first()){
            DB::table('job_on_boards')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('job on-boards delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

  
}

<?php

namespace App\Http\Controllers\Api\Hrm\HradminSetup;

use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class AwardController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Award::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Award_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'employee_id' => 'required',
                'award_type' => 'required',
                'date' => 'required',
                'gift' => 'required',
                'description' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Award();
        $new->employee_id = $req->employee_id;
        $new->award_type = $req->award_type;
        $new->date = $req->date;
        $new->gift = $req->gift;
        $new->description = $req->description;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Award save successfully.');
    }

    function getAwardById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Award::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Award(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'employee_id' => 'required',
                'award_type' => 'required',
                'date' => 'required',
                'gift' => 'required',
                'description' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'employee_id' => $req->employee_id,
            'award_type' => $req->award_type,
            'date' => $req->date,
            'gift' => $req->gift,
            'description' => $req->description,
            'created_by' => $req->user_id
        ];
        
        DB::table('awards')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Award update successfully.');
    }

    function Award_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('awards')->where(['id' => $request->id])->first()) {
            DB::table('awards')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Award delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    
}

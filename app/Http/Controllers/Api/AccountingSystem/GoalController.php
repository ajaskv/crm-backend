<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use Illuminate\Support\Collection;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class GoalController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $Project = Goal::all();
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Goal_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [ 
                'name' => 'required',
                'type' => 'required',
                'amount' => 'required',
                'is_display' => 'required',
                'user_id' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $new = new Goal();
        $new->name = $req->name;
        $new->type = $req->type;
        $new->from = $req->from;
        $new->to = $req->to;
        $new->amount = $req->amount;
        $new->is_display = $req->is_display;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Goal save successfully.');
    }

    function getGoalById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $Project = Goal::where(['id' => $request->id])->get();

       // return sizeof($Project);
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Goal(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'name' => 'required',
                'type' => 'required',
                'amount' => 'required',
                'is_display' => 'required',
                'user_id' => 'required',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'name' => $req->name,
            'type' => $req->type,
            'from' => $req->from,
            'to' => $req->to,
            'amount' => $req->amount,
            'is_display' => $req->is_display,
            'created_by' => $req->user_id,
           
        ];
        
        DB::table('goals')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Goal update successfully.');
    }

   

    function Goal_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('goals')->where(['id' => $request->id])->first()) {
            DB::table('goals')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Goal delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

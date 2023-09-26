<?php

namespace App\Http\Controllers\Api\Hrm;

use App\Http\Controllers\Controller;
//use App\Models\Indicator;
use App\Models\GoalTracking;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class GoalTrackingController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = GoalTracking::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function store_GoalTracking(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'branch' => 'required',
                'goal_type' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'status' => 'required',
                'progress' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new GoalTracking();
        $new->branch = $req->branch;
        $new->goal_type = $req->goal_type;
        $new->start_date = $req->start_date;
        $new->end_date = $req->end_date;
        $new->subject = $req->subject;
        $new->rating = $req->rating;
        $new->target_achievement = $req->target_achievement;
        $new->description = $req->description;
        $new->status = $req->status;
        $new->progress = $req->progress;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Goal tracking save successfully.');
    }

    function getGoalTrackingById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = GoalTracking::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_GoalTracking(Request $req){
        $validator = \Validator::make(
        $req->all(), [
            'id' => 'required',
            'branch' => 'required',
            'goal_type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
            'progress' => 'required',
            'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $dealData = [
            'branch' => $req->branch,
            'goal_type' => $req->goal_type,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date,
            'subject' => $req->subject,
            'rating' => $req->rating,
            'target_achievement' => $req->target_achievement,
            'description' => $req->description,
            'status' => $req->status,
            'progress' => $req->progress,
            'created_by' => $req->user_id
        ];
        
        DB::table('goal_trackings')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Goal tracking update successfully.');
    }

    function GoalTracking_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('goal_trackings')->where(['id' => $request->id])->first()) {
            DB::table('goal_trackings')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Goal tracking delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

  
}

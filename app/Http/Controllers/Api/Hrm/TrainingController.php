<?php

namespace App\Http\Controllers\Api\Hrm;

use App\Http\Controllers\Controller;
//use App\Models\Indicator;
use App\Models\Training;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class TrainingController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Training::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function store_Training(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'branch' => 'required',
                'trainer_option' => 'required',
                'training_type' => 'required',
                'trainer' => 'required',
                'training_cost' => 'required',
                'employee' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Training();
        $new->branch = $req->branch;
        $new->trainer_option = $req->trainer_option;
        $new->training_type = $req->training_type;
        $new->trainer = $req->trainer;
        $new->training_cost = $req->training_cost;
        $new->employee = $req->employee;
        $new->start_date = $req->start_date;
        $new->end_date = $req->end_date;
        $new->description = $req->description;
        $new->status = $req->status;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Training save successfully.');
    }

    function getTrainingById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Training::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Training(Request $req){
        $validator = \Validator::make(
        $req->all(), [
            'id' => 'required',
            'branch' => 'required',
            'trainer_option' => 'required',
            'training_type' => 'required',
            'trainer' => 'required',
            'training_cost' => 'required',
            'employee' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $dealData = [
            'branch' => $req->branch,
            'trainer_option' => $req->trainer_option,
            'training_type' => $req->training_type,
            'trainer' => $req->trainer,
            'training_cost' => $req->training_cost,
            'employee' => $req->employee,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date,
            'description' => $req->description,
            'status' => $req->status,
            'created_by' => $req->user_id
        ];
        
        DB::table('trainings')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Training update successfully.');
    }

    function Training_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('trainings')->where(['id' => $request->id])->first()) {
            DB::table('trainings')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Training delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

  
}

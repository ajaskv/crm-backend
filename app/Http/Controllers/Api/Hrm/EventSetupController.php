<?php

namespace App\Http\Controllers\Api\Hrm;

use App\Http\Controllers\Controller;
//use App\Models\Indicator;
use App\Models\Event;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class EventSetupController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Event::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function store_EventSetup(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'branch_id' => 'required',
                'department_id' => 'required',
                'employee_id' => 'required',
                'title' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'color' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Event();
        $new->branch_id = $req->branch_id;
        $new->department_id = $req->department_id;
        $new->employee_id = $req->employee_id;
        $new->title = $req->title;
        $new->start_date = $req->start_date;
        $new->end_date = $req->end_date;
        $new->color = $req->color;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Event setup save successfully.');
    }

    // function getTrainerById(Request $request){
    //     $validator = \Validator::make($request->all(),[
    //         'id'=>'required'
    //     ]);
    //     if ($validator->fails()) {
    //         return Utility::error_res($validator->errors()->first());
    //     }
    //     $deal = Trainer::where(['id' => $request->id])->get();
    //    // return sizeof($deal);
    //     if(sizeof($deal)){
    //         return $this->success($deal, 'success');
    //     }
    //     return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    // }

    // function edit_Trainer(Request $req){
    //     $validator = \Validator::make(
    //     $req->all(), [
    //         'id' => 'required',
    //         'branch' => 'required',
    //         'firstname' => 'required',
    //         'lastname' => 'required',
    //         'contact' => 'required',
    //         'email' => 'required',
    //         'user_id' => 'required',
    //         ]
    //     );
    //     if ($validator->fails()) {
    //         return Utility::error_res($validator->errors()->first());
    //     }
    //     $dealData = [
    //         'branch' => $req->branch,
    //         'firstname' => $req->firstname,
    //         'lastname' => $req->lastname,
    //         'contact' => $req->contact,
    //         'email' => $req->email,
    //         'address' => $req->address,
    //         'expertise' => $req->expertise,
    //         'created_by' => $req->user_id
    //     ];
        
    //     DB::table('trainers')->where('id',$req->id)->update($dealData);
    //     return $this->success([], 'Training update successfully.');
    // }

    // function Trainer_delete(Request $request){
    //     $validator = \Validator::make($request->all(),[
    //         'id'=>'required'
    //     ]);

    //     if ($validator->fails()) {
    //         return Utility::error_res($validator->errors()->first());
    //     }

    //     if (DB::table('trainers')->where(['id' => $request->id])->first()) {
    //         DB::table('trainers')->where(['id' => $request->id])->delete();
    //         return response()->json(['message' => trans('Training delete successfully'),'status'=>'200'], 200);
    //     }
    //     return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    // }

  
}

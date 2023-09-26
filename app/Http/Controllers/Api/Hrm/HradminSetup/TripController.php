<?php

namespace App\Http\Controllers\Api\Hrm\HradminSetup;

use App\Http\Controllers\Controller;
use App\Models\Travel;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class TripController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Travel::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Travel_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'employee_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'purpose_of_visit' => 'required',
                'place_of_visit' => 'required',
                'description' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Travel();
        $new->employee_id = $req->employee_id;
        $new->start_date = $req->start_date;
        $new->end_date = $req->end_date;
        $new->purpose_of_visit = $req->purpose_of_visit;
        $new->place_of_visit = $req->place_of_visit;
        $new->description = $req->description;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Trip save successfully.');
    }

    function getTravelById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Travel::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Travel(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'employee_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'purpose_of_visit' => 'required',
                'place_of_visit' => 'required',
                'description' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'employee_id' => $req->employee_id,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date,
            'purpose_of_visit' => $req->purpose_of_visit,
            'place_of_visit' => $req->place_of_visit,
            'description' => $req->description,
            'created_by' => $req->user_id
        ];
        
        DB::table('travels')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Trip update successfully.');
    }

    function Travel_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('travels')->where(['id' => $request->id])->first()) {
            DB::table('travels')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Trip delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    
}

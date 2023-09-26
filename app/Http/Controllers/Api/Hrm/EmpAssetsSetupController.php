<?php

namespace App\Http\Controllers\Api\Hrm;

use App\Http\Controllers\Controller;
//use App\Models\Indicator;
use App\Models\Asset;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class EmpAssetsSetupController extends Controller
{   
    use ApiResponser;

    function index(){
        $deal = Asset::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function store_EmpAssetsSetup(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'purchase_date' => 'required',
                'supported_date' => 'required',
                'amount' => 'required',
                'description' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Asset();
        $new->name = $req->name;
        $new->purchase_date = $req->purchase_date;
        $new->supported_date = $req->supported_date;
        $new->amount = $req->amount;
        $new->description = $req->description;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Assets save successfully.');
    }

    function getEmpAssetsSetupById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Asset::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_EmpAssetsSetup(Request $req){
        $validator = \Validator::make(
        $req->all(), [
            'id' => 'required',
            'name' => 'required',
            'purchase_date' => 'required',
            'supported_date' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $dealData = [
            'name' => $req->name,
            'purchase_date' => $req->purchase_date,
            'supported_date' => $req->supported_date,
            'amount' => $req->amount,
            'description' => $req->description,
            'created_by' => $req->user_id
        ];
        
        DB::table('assets')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Asset update successfully.');
    }

    function EmpAssetsSetup_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('assets')->where(['id' => $request->id])->first()) {
            DB::table('assets')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Asset delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
  
}

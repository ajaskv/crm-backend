<?php

namespace App\Http\Controllers\Api\Hrm\HradminSetup;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class HolidayController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Holiday::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Holiday_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'date' => 'required',
                'occasion' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Holiday();
        $new->date = $req->date;
        $new->occasion = $req->occasion;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Holiday save successfully.');
    }

    function getHolidayById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Holiday::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Holiday(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'date' => 'required',
                'occasion' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'date' => $req->date,
            'occasion' => $req->occasion,
            'created_by' => $req->user_id
        ];
        
        DB::table('holidays')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Holiday update successfully.');
    }

    function Holiday_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('holidays')->where(['id' => $request->id])->first()) {
            DB::table('holidays')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Holiday delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    
}

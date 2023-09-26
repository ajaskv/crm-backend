<?php

namespace App\Http\Controllers\Api\Hrm\HradminSetup;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class PromotionController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Promotion::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Promotion_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'employee_id' => 'required',
                'designation_id' => 'required',
                'promotion_title' => 'required',
                'promotion_date' => 'required',
                'description' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Promotion();
        $new->employee_id = $req->employee_id;
        $new->designation_id = $req->designation_id;
        $new->promotion_title = $req->promotion_title;
        $new->promotion_date = $req->promotion_date;
        $new->description = $req->description;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Promotion save successfully.');
    }

    function getPromotionById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Promotion::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Promotion(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'employee_id' => 'required',
                'designation_id' => 'required',
                'promotion_title' => 'required',
                'promotion_date' => 'required',
                'description' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'employee_id' => $req->employee_id,
            'designation_id' => $req->designation_id,
            'promotion_title' => $req->promotion_title,
            'promotion_date' => $req->promotion_date,
            'description' => $req->description,
            'created_by' => $req->user_id
        ];
        
        DB::table('promotions')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Promotion update successfully.');
    }

    function Promotion_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('promotions')->where(['id' => $request->id])->first()) {
            DB::table('promotions')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Promotion delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    
}

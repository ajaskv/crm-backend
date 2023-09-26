<?php

namespace App\Http\Controllers\Api\Hrm\RecruitmentSetup;

use App\Http\Controllers\Controller;
//use App\Models\Indicator;
use App\Models\CustomQuestion;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class JobcustomQusController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = CustomQuestion::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function customQus_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'question' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new CustomQuestion();
        $new->question = $req->question;
        $new->is_required = $req->is_required;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Question save  successfully.');
    }

    function getcustomQusById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = CustomQuestion::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_customQus(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'question' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $dealData = [
            'question' => $req->question,
            'is_required' => $req->is_required,
            'created_by' => $req->user_id
        ];
        
        DB::table('custom_questions')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Custom question update successfully.');
    }

    function customQus_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('custom_questions')->where(['id' => $request->id])->first()){
            DB::table('custom_questions')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Custom question delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

  
}

<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\ChartOfAccount;
use Illuminate\Support\Collection;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class ChartAccountController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $Project = ChartOfAccount::all();
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function ChartAccount_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [ 
                'name' => 'required',
                'code' => 'required',
                'type' => 'required',
                'sub_type' => 'required',
                'is_enabled' => 'required',
                'user_id' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $new = new ChartOfAccount();
        $new->name = $req->name;
        $new->code = $req->code;
        $new->type = $req->type;
        $new->sub_type = $req->sub_type;
        $new->is_enabled = $req->is_enabled;
        $new->description = $req->description;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Chart accounts save successfully.');
    }

    function getChartAccountById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $Project = ChartOfAccount::where(['id' => $request->id])->get();

       // return sizeof($Project);
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_ChartAccount(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'name' => 'required',
                'code' => 'required',
                'type' => 'required',
                'sub_type' => 'required',
                'is_enabled' => 'required',
                'user_id' => 'required',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'name' => $req->name,
            'code' => $req->code,
            'type' => $req->type,
            'sub_type' => $req->sub_type,
            'is_enabled' => $req->is_enabled,
            'description' => $req->description,
            'created_by' => $req->user_id,
        ];
        
        DB::table('chart_of_accounts')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Chart accounts update successfully.');
    }

   

    function ChartAccount_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('chart_of_accounts')->where(['id' => $request->id])->first()) {
            DB::table('chart_of_accounts')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Chart accounts delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

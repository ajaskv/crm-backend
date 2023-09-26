<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Support\Collection;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class TaxesController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $Project = Tax::all();
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Taxes_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [ 
                'name' => 'required',
                'rate' => 'required',
                'user_id' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $new = new Tax();
        $new->name = $req->name;
        $new->rate = $req->rate;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Tax rate save successfully.');
    }

    function getTaxesById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $Project = Tax::where(['id' => $request->id])->get();

       // return sizeof($Project);
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Taxes(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'name' => 'required',
                'rate' => 'required',
                'user_id' => 'required',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'name' => $req->name,
            'rate' => $req->rate,
            'created_by' => $req->user_id,
        ];
        
        DB::table('taxes')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Tax rate update successfully.');
    }

   

    function Taxes_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('taxes')->where(['id' => $request->id])->first()) {
            DB::table('taxes')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Tax rate delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\ProductServiceUnit;
use Illuminate\Support\Collection;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class UnitController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $Project = ProductServiceUnit::all();
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Unit_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [ 
                'name' => 'required',
                'user_id' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $new = new ProductServiceUnit();
        $new->name = $req->name;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Product service Unit save successfully.');
    }

    function getUnitById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $Project = ProductServiceUnit::where(['id' => $request->id])->get();

       // return sizeof($Project);
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Unit(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'name' => 'required',
                'user_id' => 'required',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'name' => $req->name,
            'created_by' => $req->user_id,
        ];
        
        DB::table('product_service_units')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Product service Unit update successfully.');
    }

   

    function Unit_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('product_service_units')->where(['id' => $request->id])->first()) {
            DB::table('product_service_units')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Product service Unit delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\ProductServiceCategory;
use Illuminate\Support\Collection;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class CategoryController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $Project = ProductServiceCategory::all();
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Category_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [ 
                'name' => 'required',
                'type' => 'required',
                'color' => 'required',
                'user_id' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $new = new ProductServiceCategory();
        $new->name = $req->name;
        $new->type = $req->type;
        $new->color = $req->color;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Product service categories save successfully.');
    }

    function getCategoryById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $Project = ProductServiceCategory::where(['id' => $request->id])->get();

       // return sizeof($Project);
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Category(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'name' => 'required',
                'type' => 'required',
                'color' => 'required',
                'user_id' => 'required',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'name' => $req->name,
            'type' => $req->type,
            'color' => $req->color,
            'created_by' => $req->user_id,
        ];
        
        DB::table('product_service_categories')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Product service categories update successfully.');
    }

   

    function Category_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('product_service_categories')->where(['id' => $request->id])->first()) {
            DB::table('product_service_categories')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Product service categories delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

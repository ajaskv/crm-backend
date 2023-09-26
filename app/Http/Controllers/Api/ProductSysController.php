<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductService;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class ProductSysController extends Controller
{
    use ApiResponser;


    function index(){
        $formData = ProductService::all();
        if(sizeof($formData)){
            return $this->success($formData, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }



    function ProductSys_store(Request $req){

        $validator = \Validator::make(
            $req->all(), [ 
                'name' => 'required',
                'sku' => 'required',
                'sale_price' => 'required',
                'purchase_price' => 'required',
                'quantity' => 'required',
                'category_id' => 'required',
                'unit_id' => 'required',
                'type' => 'required',
                'description' => 'required',
                'created_by' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }
        
        $new = new ProductService();
        $new->name = $req->name;
        $new->sku = $req->sku;
        $new->sale_price = $req->sale_price;
        $new->purchase_price = $req->purchase_price;
        $new->quantity = $req->quantity;
        $new->tax_id = $req->tax_id;
        $new->category_id = $req->category_id;
        $new->unit_id = $req->unit_id;
        $new->type = $req->type;
        $new->description = $req->description;
        $new->created_by = $req->created_by;
        $new->save();
        return $this->success([], 'Product service save successfully.');
    }

    function getProductSysById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $FormBuilder = ProductService::where(['id' => $request->id])->get();

       // return sizeof($FormBuilder);
        if(sizeof($FormBuilder)){
            return $this->success($FormBuilder, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_ProductSys(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'name' => 'required',
                'sku' => 'required',
                'sale_price' => 'required',
                'purchase_price' => 'required',
                'quantity' => 'required',
                'category_id' => 'required',
                'unit_id' => 'required',
                'type' => 'required',
                'description' => 'required',
                'created_by' => 'required',
                ]
            );
            //$attachment =  $req->attachment->store('public/zoomMeeting');
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
           
            $Data = [
                'name' => $req->name,
                'sku' => $req->sku,
                'sale_price' => $req->sale_price,
                'purchase_price' => $req->purchase_price,
                'quantity' => $req->quantity,
                'tax_id' => $req->tax_id,
                'category_id' => $req->category_id,
                'unit_id' => $req->unit_id,
                'type' => $req->type,
                'description' => $req->description,
                'created_by' => $req->created_by,
            ];
        
        DB::table('product_services')->where('id',$req->id)->update($Data);
        return $this->success([], 'Product service update successfully.');
    }

    function ProductSys_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('product_services')->where(['id' => $request->id])->first()) {
            DB::table('product_services')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Product service delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }


    function ProductStock_edit(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'quantity' => 'required',
                ]
            );
            //$attachment =  $req->attachment->store('public/zoomMeeting');
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
           
            $Data = [
                'quantity' => $req->quantity,
            ];
        
        DB::table('product_services')->where('id',$req->id)->update($Data);
        return $this->success([], 'Product quntity update successfully.');
    }
  
}
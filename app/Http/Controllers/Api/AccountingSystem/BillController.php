<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillProduct;
use Illuminate\Support\Collection;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class BillController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $Bill = Bill::all();
        $BillProduct = BillProduct::all();
        if(sizeof($Bill)){
           // return $this->success('200','success');
            return response()->json(['message' => trans('success'),
            'status'=>'200',
            'Bill'=>$Bill,
            'BillProduct'=> $BillProduct
        ], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Bill_store(Request $req){

       // return $req->data;
        $validator = \Validator::make(
            $req->all(), [ 
                'bill_id' => 'required',
                'vender_id' => 'required',
                'bill_date' => 'required',
                'due_date' => 'required',
                'order_number' => 'required',
                'user_id' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $new = new Bill();
        $new->bill_id = $req->bill_id;
        $new->vender_id = $req->vender_id;
        $new->bill_date = $req->bill_date;
        $new->due_date = $req->due_date;
        $new->order_number = $req->order_number;
        $new->discount_apply = $req->discount_apply;
        $new->category_id = $req->category_id;
        $new->created_by = $req->user_id;
        $new->save();

        foreach($req->data as $key => $value){
            $new = new BillProduct();
            $new->bill_id =  $req->bill_id;
            $new->product_id =  $value['product_id'];
            $new->quantity =  $value['quantity'];
            $new->tax =  $value['tax'];
            $new->discount =  $value['discount'];
            $new->price =  $value['price'];
            $new->description =  $value['description'];
            $new->save();
        }


        return $this->success([], 'Bills save successfully.');
    }

    function getBillById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $data = Bill::where(['id' => $request->id])->get();

       // return $Project[0]->journal_id;
        $details = BillProduct::where(['bill_id' => $data[0]->bill_id])->get();

       // return sizeof($Project);
        if(sizeof($data)){
            return response()->json(['message' => trans('success'),
            'status'=>'200',
            'Bill'=>$data,
            'BillProduct'=> $details
        ], 200);
           // return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Bill(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'bill_id' => 'required',
                'vender_id' => 'required',
                'bill_date' => 'required',
                'due_date' => 'required',
                'order_number' => 'required',
                'user_id' => 'required',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'bill_id' => $req->bill_id,
            'vender_id' => $req->vender_id,
            'bill_date' => $req->bill_date,
            'due_date' => $req->due_date,
            'order_number' => $req->order_number,
            'discount_apply' => $req->discount_apply,
            'category_id' => $req->category_id,
            'created_by' => $req->user_id,
        ];
        
        DB::table('bills')->where('id',$req->id)->update($projectData);

        foreach($req->data as $key => $value){
            $DetailsData = [
                'bill_id' => $value['bill_id'],
                'product_id' => $value['product_id'],
                'quantity' => $value['quantity'],
                'tax' => $value['tax'],
                'discount' => $value['discount'],
                'price' => $value['price'],
                'description' => $value['description'],
            ];
            
            DB::table('bill_products')->where('id',$value['item_id'])->update($DetailsData);
        }

        return $this->success([], 'Bill update successfully.');
    }

   

    function Bill_delete(Request $request){
        $validator = \Validator::make($request->all(),[
           // 'id'=>'required',
            'bill_id' => 'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('bills')->where(['bill_id' => $request->bill_id])->first()) {
            DB::table('bills')->where(['bill_id' => $request->bill_id])->delete();
            DB::table('bill_products')->where(['bill_id' => $request->bill_id])->delete();
            return response()->json(['message' => trans('Bill  deleted successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Revenue;
//use App\Models\BillProduct;
use Illuminate\Support\Collection;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class RevenueController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $Revenue = Revenue::all();
      //  $BillProduct = BillProduct::all();
        if(sizeof($Revenue)){
           // return $this->success('200','success');
            return response()->json(['message' => trans('success'),
            'status'=>'200',
            'Revenue'=>$Revenue,
            //'BillProduct'=> $BillProduct
        ], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Revenue_store(Request $req){

       // return $req->data;
        $validator = \Validator::make(
            $req->all(), [ 
                'date' => 'required',
                'amount' => 'required',
                'account_id' => 'required',
                'payment_method' => 'required',
                'reference' => 'required',
                'description' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $path =  $req->add_receipt->store('public/Payment');
        $new = new Revenue();
        $new->date = $req->date;
        $new->amount = $req->amount;
        $new->account_id = $req->account_id;
        $new->customer_id = $req->customer_id;
        $new->category_id = $req->category_id;
        $new->payment_method = $req->payment_method;
        $new->reference = $req->reference;
        $new->add_receipt = $path;
        $new->description = $req->description;
        $new->created_by = $req->user_id;
        $new->save();

       


        return $this->success([], 'Revenue save successfully.');
    }

    function getRevenueById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $data = Revenue::where(['id' => $request->id])->get();
    
        if(sizeof($data)){
            return response()->json(['message' => trans('success'),
            'status'=>'200',
            'Revenue'=>$data,
        ], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Revenue(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'date' => 'required',
                'amount' => 'required',
                'account_id' => 'required',
                'payment_method' => 'required',
                'reference' => 'required',
                'description' => 'required',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
            $path =  $req->add_receipt->store('public/Payment');
        $projectData = [
            'date' => $req->date,
            'amount' => $req->amount,
            'account_id' => $req->account_id,
            'customer_id' => $req->customer_id,
            'category_id' => $req->category_id,
            'payment_method' => $req->payment_method,
            'reference' => $req->reference,
            'add_receipt' => $path,
            'description' => $req->description,
            'created_by' => $req->user_id,
        ];
        
        DB::table('revenues')->where('id',$req->id)->update($projectData);

        return $this->success([], 'Revenue update successfully.');
    }

   

    function Revenue_delete(Request $request){
        $validator = \Validator::make($request->all(),[
           // 'id'=>'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('revenues')->where(['id' => $request->id])->first()) {
            DB::table('revenues')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Revenue  deleted successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

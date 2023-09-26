<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\BillPayment;
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
class PaymentController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $BillPayment = BillPayment::all();
      //  $BillProduct = BillProduct::all();
        if(sizeof($BillPayment)){
           // return $this->success('200','success');
            return response()->json(['message' => trans('success'),
            'status'=>'200',
            'BillPayment'=>$BillPayment,
            //'BillProduct'=> $BillProduct
        ], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Payment_store(Request $req){

       // return $req->data;
        $validator = \Validator::make(
            $req->all(), [ 
                'bill_id' => 'required',
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
        $new = new BillPayment();
        $new->bill_id = $req->bill_id;
        $new->date = $req->date;
        $new->amount = $req->amount;
        $new->account_id = $req->account_id;
        $new->payment_method = $req->payment_method;
        $new->reference = $req->reference;
        $new->add_receipt = $path;
        $new->description = $req->description;
        $new->save();

       


        return $this->success([], 'Payment save successfully.');
    }

    function getPaymentById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $data = BillPayment::where(['id' => $request->id])->get();
    
        if(sizeof($data)){
            return response()->json(['message' => trans('success'),
            'status'=>'200',
            'BillPayment'=>$data,
        ], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Payment(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'bill_id' => 'required',
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
            'bill_id' => $req->bill_id,
            'date' => $req->date,
            'amount' => $req->amount,
            'account_id' => $req->account_id,
            'payment_method' => $req->payment_method,
            'reference' => $req->reference,
            'add_receipt' => $path,
            'description' => $req->description,
        ];
        
        DB::table('bill_payments')->where('id',$req->id)->update($projectData);

        return $this->success([], 'Payment update successfully.');
    }

   

    function Payment_delete(Request $request){
        $validator = \Validator::make($request->all(),[
           // 'id'=>'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('bill_payments')->where(['id' => $request->id])->first()) {
            DB::table('bill_payments')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('payments  deleted successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

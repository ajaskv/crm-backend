<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Illuminate\Support\Collection;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class InvoiceController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $Bill = Invoice::all();
        $BillProduct = InvoiceProduct::all();
        if(sizeof($Bill)){
           // return $this->success('200','success');
            return response()->json(['message' => trans('success'),
            'status'=>'200',
            'Invoice'=>$Bill,
            'InvoiceProduct'=> $BillProduct
        ], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Invoice_store(Request $req){

       // return $req->data;
        $validator = \Validator::make(
            $req->all(), [ 
                'invoice_id' => 'required',
                'customer_id' => 'required',
                'issue_date' => 'required',
                'due_date' => 'required',
                'send_date' => 'required',
                'user_id' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $new = new Invoice();
        $new->invoice_id = $req->invoice_id;
        $new->customer_id = $req->customer_id;
        $new->issue_date = $req->issue_date;
        $new->due_date = $req->due_date;
        $new->send_date = $req->send_date;
        $new->discount_apply = $req->discount_apply;
        $new->ref_number = $req->ref_number;
        $new->category_id = $req->category_id;
        $new->created_by = $req->user_id;
        $new->save();

        foreach($req->data as $key => $value){
            $new = new InvoiceProduct();
            $new->invoice_id =  $req->invoice_id;
            $new->product_id =  $value['product_id'];
            $new->quantity =  $value['quantity'];
            $new->tax =  $value['tax'];
            $new->discount =  $value['discount'];
            $new->price =  $value['price'];
            $new->description =  $value['description'];
            $new->save();
        }


        return $this->success([], 'Invoice save successfully.');
    }

    function getInvoiceById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $data = Invoice::where(['id' => $request->id])->get();

       // return $Project[0]->journal_id;
        $details = InvoiceProduct::where(['invoice_id' => $data[0]->invoice_id])->get();

       // return sizeof($Project);
        if(sizeof($data)){
            return response()->json(['message' => trans('success'),
            'status'=>'200',
            'Invoice'=>$data,
            'InvoiceProduct'=> $details
        ], 200);
           // return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Invoice(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'invoice_id' => 'required',
                'customer_id' => 'required',
                'issue_date' => 'required',
                'due_date' => 'required',
                'send_date' => 'required',
                'user_id' => 'required',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'invoice_id' => $req->invoice_id,
            'customer_id' => $req->customer_id,
            'issue_date' => $req->issue_date,
            'due_date' => $req->due_date,
            'send_date' => $req->send_date,
            'discount_apply' => $req->discount_apply,
            'category_id' => $req->category_id,
            'ref_number' => $req->ref_number,
            'discount_apply' => $req->discount_apply,
            'created_by' => $req->user_id,
        ];
        
        DB::table('invoices')->where('id',$req->id)->update($projectData);

        foreach($req->data as $key => $value){
            $DetailsData = [
                'invoice_id' => $req->invoice_id,
                'product_id' => $value['product_id'],
                'quantity' => $value['quantity'],
                'tax' => $value['tax'],
                'discount' => $value['discount'],
                'price' => $value['price'],
                'description' => $value['description'],
            ];
            
            DB::table('invoice_products')->where('id',$value['invoice_id'])->update($DetailsData);
        }

        return $this->success([], 'Invoice update successfully.');
    }

   

    function Invoice_delete(Request $request){
        $validator = \Validator::make($request->all(),[
           // 'id'=>'required',
            'invoice_id' => 'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('invoices')->where(['invoice_id' => $request->invoice_id])->first()) {
            DB::table('invoices')->where(['invoice_id' => $request->invoice_id])->delete();
            DB::table('invoice_products')->where(['invoice_id' => $request->invoice_id])->delete();
            return response()->json(['message' => trans('Invoice  deleted successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

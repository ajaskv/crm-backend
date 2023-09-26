<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\CreditNote;
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
class CreditNoteController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $CreditNote = CreditNote::all();
      //  $BillProduct = BillProduct::all();
        if(sizeof($CreditNote)){
           // return $this->success('200','success');
            return response()->json(['message' => trans('success'),
            'status'=>'200',
            'CreditNote'=>$CreditNote,
            //'BillProduct'=> $BillProduct
        ], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function CreditNote_store(Request $req){

       // return $req->data;
        $validator = \Validator::make(
            $req->all(), [ 
                'invoice' => 'required',
                'customer' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'description' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new CreditNote();
        $new->invoice = $req->invoice;
        $new->customer = $req->customer;
        $new->amount = $req->amount;
        $new->date = $req->date;
        $new->description = $req->description;
        $new->save();

       


        return $this->success([], 'Credit note save successfully.');
    }

    function getCreditNoteById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $data = CreditNote::where(['id' => $request->id])->get();
    
        if(sizeof($data)){
            return response()->json(['message' => trans('success'),
            'status'=>'200',
            'CreditNote'=>$data,
        ], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_CreditNote(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'invoice' => 'required',
                'customer' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'description' => 'required',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'invoice' => $req->invoice,
            'customer' => $req->customer,
            'amount' => $req->amount,
            'date' => $req->date,
            'description'   => $req->description,
        ];
        
        DB::table('credit_notes')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Credit note update successfully.');
    }

   

    function CreditNote_delete(Request $request){
        $validator = \Validator::make($request->all(),[
           // 'id'=>'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('credit_notes')->where(['id' => $request->id])->first()) {
            DB::table('credit_notes')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Credit note  deleted successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

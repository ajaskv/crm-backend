<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\DebitNote;
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
class DebitNoteController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $DebitNote = DebitNote::all();
      //  $BillProduct = BillProduct::all();
        if(sizeof($DebitNote)){
           // return $this->success('200','success');
            return response()->json(['message' => trans('success'),
            'status'=>'200',
            'DebitNote'=>$DebitNote,
            //'BillProduct'=> $BillProduct
        ], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function DebitNote_store(Request $req){

       // return $req->data;
        $validator = \Validator::make(
            $req->all(), [ 
                'bill' => 'required',
                'vendor' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'description' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new DebitNote();
        $new->bill = $req->bill;
        $new->vendor = $req->vendor;
        $new->amount = $req->amount;
        $new->date = $req->date;
        $new->description = $req->description;
        $new->save();

       


        return $this->success([], 'Debit note save successfully.');
    }

    function getDebitNoteById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $data = DebitNote::where(['id' => $request->id])->get();
    
        if(sizeof($data)){
            return response()->json(['message' => trans('success'),
            'status'=>'200',
            'DebitNote'=>$data,
        ], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_DebitNote(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'bill' => 'required',
                'vendor' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'description' => 'required',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'bill' => $req->bill,
            'vendor' => $req->vendor,
            'amount' => $req->amount,
            'date' => $req->date,
            'description'   => $req->description,
        ];
        
        DB::table('debit_notes')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Debit note update successfully.');
    }

   

    function DebitNote_delete(Request $request){
        $validator = \Validator::make($request->all(),[
           // 'id'=>'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('debit_notes')->where(['id' => $request->id])->first()) {
            DB::table('debit_notes')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Debit note  deleted successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

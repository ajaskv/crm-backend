<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class ContractController extends Controller
{   
    use ApiResponser;

    function index(){

        $contract = Contract::all();
        if(sizeof($contract)){
            return $this->success($contract, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'client_name' => 'required',
                'subject' => 'required',
                'type' => 'required',
                'value' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }
        $new = new Contract();
        $new->client_name = $req->client_name;
        $new->subject = $req->subject;
        $new->type = $req->type;
        $new->value = $req->value;
        $new->start_date = $req->start_date;
        $new->end_date = $req->end_date;
        $new->save();
        return $this->success([], 'Contract save successfully.');
    }

    function getcontractById(Request $request){
        $validator = \Validator::make($request->all(),[
            'contract_id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Contract::where(['id' => $request->contract_id])->get();

       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'client_name' => 'required',
                'subject' => 'required',
                'type' => 'required',
                'value' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $contractData = [
            'client_name' => $req->client_name,
            'subject' => $req->subject,
            'type' => $req->type,
            'value' => $req->value,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date
        ];
        
        DB::table('contracts')->where('id',$req->id)->update($contractData);
        return $this->success([], 'Contract update successfully.');
    }

    function delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'contract_id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('contracts')->where(['id' => $request->contract_id])->first()) {
            DB::table('contracts')->where(['id' => $request->contract_id])->delete();
            return response()->json(['message' => trans('Contract delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class DealController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Deal::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'phone' => 'required|max:10|min:10',
                'price' => 'required',
                'clients' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }
        $new = new Deal();
        $new->name = $req->name;
        $new->phone = $req->phone;
        $new->price = $req->price;
        $new->customer_id = $req->clients;
        $new->save();
        return $this->success([], 'Deal save successfully.');
    }

    function getdealById(Request $request){
        $validator = \Validator::make($request->all(),[
            'deal_id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Deal::where(['id' => $request->deal_id])->get();

       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'phone' => 'required|max:10|min:10',
                'price' => 'required',
                'pipeline_id' => 'required',
                'stage_id' => 'required',
                'products' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'name' => $req->name,
            'phone' => $req->phone,
            'price' => $req->price,
            'pipeline_id' => $req->pipeline_id,
            'stage_id' => $req->stage_id,
            'sources' => $req->sources,
            'products' => $req->products,
            'notes' => $req->notes
        ];
        
        DB::table('deals')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Deal update successfully.');
    }

    function delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'deal_id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('deals')->where(['id' => $request->deal_id])->first()) {
            DB::table('deals')->where(['id' => $request->deal_id])->delete();
            return response()->json(['message' => trans('Lead delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

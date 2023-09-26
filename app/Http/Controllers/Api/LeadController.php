<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class LeadController extends Controller
{
    use ApiResponser;


    function index(){

        $lead = Lead::all();
        if(sizeof($lead)){
            return $this->success($lead, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }


    function store(Request $req){

        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'user_id' => 'required',
                'subject' => 'required',
                'email' => 'required|unique:leads',
                'phone' => 'required|max:10|min:10',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['status' => false,'data'=>Utility::error_res($validator->errors()),'message'=>'Validation Error']);
            //return Utility::error_res($validator->errors()->first());
           
        }
        $new = new Lead();
        $new->name = $req->name;
        $new->subject = $req->subject;
        $new->email = $req->email;
        $new->user_id = $req->user_id;
        $new->phone = $req->phone;
        $new->save();

        return response()->json(['status' => true,'data'=>$new,'message'=>'Lead save successfully.']);

        //return $this->success([], 'Lead save successfully.');
    }

    function getleadById(Request $request){
        $validator = \Validator::make($request->all(),[
            'lead_id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $lead = Lead::where(['id' => $request->lead_id])->get();

       // return sizeof($lead);
        if(sizeof($lead)){
            return $this->success($lead, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'user_id' => 'required',
                'subject' => 'required',
                'email' => 'required|unique:leads',
                'phone' => 'required|max:10|min:10',
                'pipeline_id' => 'required',
                'stage_id' => 'required',
                'products' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $leadData = [
            'subject' => $req->subject,
            'user_id' => $req->user_id,
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'pipeline_id' => $req->pipeline_id,
            'stage_id' => $req->stage_id,
            'sources' => $req->sources,
            'products' => $req->products,
            'notes' => $req->notes
        ];
        
        DB::table('leads')->where('id',$req->id)->update($leadData);
        
        return $this->success([], 'Lead update successfully.');
    }

    function delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'lead_id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('leads')->where(['id' => $request->lead_id])->first()) {
            DB::table('leads')->where(['id' => $request->lead_id])->delete();
            return response()->json(['message' => trans('Lead delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}
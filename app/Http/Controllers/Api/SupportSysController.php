<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Support;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class SupportSysController extends Controller
{
    use ApiResponser;


    function index(){

        $formData = Support::all();
        if(sizeof($formData)){
            return $this->success($formData, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }



    function SupportSys_store(Request $req){

        $validator = \Validator::make(
            $req->all(), [ 
                'subject' => 'required',
                'user' => 'required',
                'priority' => 'required',
                //'client_id' => 'required',
                'end_date' => 'required',
               // 'duration' => 'required',
                'created_by' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }
        $attachment =  $req->attachment->store('public/zoomMeeting');
        $new = new Support();
        $new->subject = $req->subject;
        $new->user = $req->user;
        $new->user = $req->user;
        $new->priority = $req->priority;
        $new->status = $req->status;
        $new->end_date = $req->end_date;
        $new->ticket_code = $req->ticket_code;
        $new->attachment = $attachment;
        $new->description = $req->description;
        $new->created_by = $req->created_by;
        $new->save();
        return $this->success([], 'Support save successfully.');
    }

    function getSupportSysById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $FormBuilder = Support::where(['id' => $request->id])->get();

       // return sizeof($FormBuilder);
        if(sizeof($FormBuilder)){
            return $this->success($FormBuilder, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_SupportSys(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'subject' => 'required',
                'user' => 'required',
                'priority' => 'required',
                //'client_id' => 'required',
                'end_date' => 'required',
               // 'duration' => 'required',
                'created_by' => 'required',
                ]
            );
            $attachment =  $req->attachment->store('public/zoomMeeting');
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
           
            $Data = [
                'subject' => $req->subject,
                'user' => $req->user,
                'priority' => $req->priority,
                'status' => $req->status,
                'end_date' => $req->end_date,
                'ticket_code' => $req->ticket_code,
                'attachment' => $attachment,
                'description' => $req->description,
                'created_by' => $req->created_by,
            ];
        
        DB::table('supports')->where('id',$req->id)->update($Data);
        return $this->success([], 'Support update successfully.');
    }

    function SupportSys_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('supports')->where(['id' => $request->id])->first()) {
            DB::table('supports')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Support delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }


  
}
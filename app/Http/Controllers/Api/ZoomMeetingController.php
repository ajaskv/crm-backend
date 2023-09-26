<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ZoomMeeting;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class ZoomMeetingController extends Controller
{
    use ApiResponser;


    function index(){

        $formData = ZoomMeeting::all();
        if(sizeof($formData)){
            return $this->success($formData, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }



    function ZoomMeeting_store(Request $req){

        $validator = \Validator::make(
            $req->all(), [ 
                'meeting_id' => 'required',
                'project_id' => 'required',
                'user_id' => 'required',
                'client_id' => 'required',
                'start_date' => 'required',
                'duration' => 'required',
                'created_by' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }
        $new = new ZoomMeeting();
        $new->title = $req->title;
        $new->meeting_id = random_int(100000, 999999);
        $new->project_id = $req->project_id;
        $new->user_id = $req->user_id;
        $new->client_id = $req->client_id;
        $new->password = $req->password;
        $new->start_date = $req->start_date;
        $new->duration = $req->duration;
        $new->status = $req->status;
        $new->created_by = $req->created_by;    
        $new->save();
        return $this->success([], 'Zomm meeting save successfully.');
    }

    function getFormBuilderById(Request $request){
        $validator = \Validator::make($request->all(),[
            'FormBuilder_id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $FormBuilder = ZoomMeeting::where(['id' => $request->FormBuilder_id])->get();

       // return sizeof($FormBuilder);
        if(sizeof($FormBuilder)){
            return $this->success($FormBuilder, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'name' => 'required',
                'is_active' => 'required',
                'user_id' => 'required',
                'code' => 'required|unique:form_builders',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
            $Data = [
                'name' => $req->name,
                'created_by' => $req->user_id,
                'code' => $req->code,
                'is_active' => $req->is_active,
            ];
        
        DB::table('form_builders')->where('id',$req->id)->update($Data);
        return $this->success([], 'Form builders update successfully.');
    }

    function ZoomMeeting_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('zoom_meetings')->where(['id' => $request->id])->first()) {
            DB::table('zoom_meetings')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Zoom meeting delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }


  
}
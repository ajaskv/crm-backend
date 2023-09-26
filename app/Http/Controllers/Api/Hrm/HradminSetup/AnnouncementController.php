<?php

namespace App\Http\Controllers\Api\Hrm\HradminSetup;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class AnnouncementController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Announcement::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Announcement_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'title' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'branch_id' => 'required',
                'department_id' => 'required',
                'employee_id' => 'required',
                'description' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Announcement();
        $new->title = $req->title;
        $new->start_date = $req->start_date;
        $new->end_date = $req->end_date;
        $new->branch_id = $req->branch_id;
        $new->department_id = $req->department_id;
        $new->employee_id = $req->employee_id;
        $new->description = $req->description;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Announcement save successfully.');
    }

    function getAnnouncementById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Announcement::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Announcement(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'title' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'branch_id' => 'required',
                'department_id' => 'required',
                'employee_id' => 'required',
                'description' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'title' => $req->title,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date,
            'branch_id' => $req->branch_id,
            'department_id' => $req->department_id,
            'employee_id' => $req->employee_id,
            'description' => $req->description,
            'created_by' => $req->user_id
        ];
        
        DB::table('announcements')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Announcement update successfully.');
    }

    function Announcement_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('announcements')->where(['id' => $request->id])->first()) {
            DB::table('announcements')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Announcement delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    
}

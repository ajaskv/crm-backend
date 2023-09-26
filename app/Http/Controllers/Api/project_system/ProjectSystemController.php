<?php

namespace App\Http\Controllers\Api\project_system;

use App\Http\Controllers\Controller;
use App\Models\Projectstages;
use App\Models\BugStatus;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class ProjectSystemController extends Controller
{   
    use ApiResponser;

    function project_stage(){

        $Project = Projectstages::all();
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function store_project_stage(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'color' => 'required',
                'order' => 'required',
                'user_id' => 'required',
               
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }
          
        $new = new Projectstages();
        $new->name = $req->name;
        $new->color = $req->color;
        $new->order = $req->order;
        $new->created_by = $req->user_id;
      
        $new->save();
        return $this->success([], 'Project save successfully.');
    }

    function getproject_stageById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $Project = Projectstages::where(['id' => $request->id])->get();

       // return sizeof($Project);
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_project_stage(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id'=>'required',
                'name' => 'required',
                'color' => 'required',
                'order' => 'required',
                'user_id' => 'required',
               
            ]);
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
           
        $projectData = [
            'name' => $req->name,
            'color' => $req->color,
            'order' => $req->order,
            'created_by' => $req->user_id,
        ];
        
        DB::table('projectstages')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Project update successfully.');
    }

    function project_stage_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('projectstages')->where(['id' => $request->id])->first()) {
            DB::table('projectstages')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Projects delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }


    function store_bugStatus(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'title' => 'required',
                'order' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }
          
        $new = new BugStatus();
        $new->title = $req->title;
        $new->order = $req->order;
        $new->created_by = $req->user_id;
      
        $new->save();
        return $this->success([], 'Bug status save successfully.');
    }


    function edit_bugStatus(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id'=>'required',
                'title' => 'required',
                'order' => 'required',
                'user_id' => 'required',
               
            ]);
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
           
        $projectData = [
            'title' => $req->title,
            'order' => $req->order,
            'created_by' => $req->user_id,
        ];
        
        DB::table('bug_statuses')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Bug status update successfully.');
    }

    function bugStatus(){
        $Project = BugStatus::all();
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }


    function getbugStatusById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        
        $Project = BugStatus::where(['id' => $request->id])->get();

       // return sizeof($Project);
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function bugStatus_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('bug_statuses')->where(['id' => $request->id])->first()){
            DB::table('bug_statuses')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('bug status delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

}

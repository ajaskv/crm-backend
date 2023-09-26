<?php

namespace App\Http\Controllers\Api\project_system;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class ProjectController extends Controller
{   
    use ApiResponser;

    function project(){

        $Project = Project::all();
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function store_project(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'project_name' => 'required',
                'client_id' => 'required',
                'status' => 'required',
                'user_id' => 'required',
               
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }

        $path =  $req->file->store('public/ProjectSystem');
          //  $name = $file->getClientOriginalName();
        $new = new Project();
        $new->project_name = $req->project_name;
        $new->start_date = $req->start_date;
        $new->end_date = $req->end_date;
        $new->project_image = $path;
        $new->budget = $req->budget;
        $new->client_id = $req->client_id;
        $new->description = $req->description;
        $new->status = $req->status;
        $new->estimated_hrs = $req->estimated_hrs;
        $new->tags = $req->tags;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Project save successfully.');
    }

    function getprojectById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $Project = Project::where(['id' => $request->id])->get();

       // return sizeof($Project);
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_project(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'project_name' => 'required',
                'client_id' => 'required',
                'status' => 'required',
                'user_id' => 'required',
               
            ]);
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
            $path =  $req->file->store('public/ProjectSystem');
        $projectData = [
            'project_name' => $req->project_name,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date,
            'project_image' => $path,
            'budget' => $req->budget,
            'client_id' => $req->client_id,
            'description' => $req->description,
            'status' => $req->status,
            'estimated_hrs' => $req->estimated_hrs,
            'tags' => $req->tags,
            'created_by' => $req->user_id,
        ];
        
        DB::table('projects')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Project update successfully.');
    }

    function project_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('projects')->where(['id' => $request->id])->first()) {
            DB::table('projects')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Projects delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

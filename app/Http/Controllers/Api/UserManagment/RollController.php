<?php

namespace App\Http\Controllers\Api\UserManagment;

use App\Http\Controllers\Controller;
// use App\Models\User;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class RollController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $Project = Role::all();
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function roll_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required|max:100|unique:roles,name,NULL,id,created_by,',
                //'permissions' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $new = new Role();
        $new->name = $req->name;
        $new->guard_name = $req->guard_name;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Roll save successfully.');
    }

    function getrollById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $Project = Role::where(['id' => $request->id])->get();

       // return sizeof($Project);
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_roll(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'name' => 'required|max:100|unique:roles,name,NULL,id,created_by,',
                //'permissions' => 'required',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'name' => $req->name,
            'guard_name' => $req->guard_name,
            'created_by' => $req->user_id,
        ];
        
        DB::table('roles')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Roll update successfully.');
    }

    function roll_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('roles')->where(['id' => $request->id])->first()) {
            DB::table('roles')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Roll delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

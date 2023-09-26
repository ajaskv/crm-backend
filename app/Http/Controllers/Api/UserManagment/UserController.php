<?php

namespace App\Http\Controllers\Api\UserManagment;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $Project = User::all();
        if(sizeof($Project)){
            return response()->json(['status' => 'true','data'=>$Project]);
            //return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function User_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required|max:120',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]
        );
        $attr = $req->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            //$errordetails = Utility::error_res($validator->errors()->first());
            return response()->json(['status'=>false,
            'message'=>'unprocessable entity',
            'errors'=>$validator->errors()->all()]);
          
           
        }

        $new = new User();
        $new->name = $req->name;
        $new->email = $req->email;
        $new->password = Hash::make($req->password);
        $new->dob = $req->dob;
        $new->type = $req->type;
        $new->save();
        if (!Auth::attempt($attr)) {
            return $this->error('Credentials not match', 401);
        }
        $settings = Utility::settings(auth()->user()->id);

        $settings = [
            'shot_time' => isset($settings['interval_time']) ? $settings['interval_time'] : 0.5,
        ];
        $new['token'] = auth()->user()->createToken('API Token')->plainTextToken;
        
        return $this->success($new, 'User save successfully.');
    }

    function getUserById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $Project = User::where(['id' => $request->id])->get();

       // return sizeof($Project);
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_User(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'name' => 'required|max:120',
                'email' => 'required|email|unique:users',
            ]);
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'name' => $req->name,
            'email' => $req->email,
            'type' => $req->type,
            'dob' => $req->dob,
           
        ];
        
        DB::table('users')->where('id',$req->id)->update($projectData);
        return $this->success([], 'User update successfully.');
    }

    function User_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('users')->where(['id' => $request->id])->first()) {
            DB::table('users')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('User delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

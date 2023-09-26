<?php

namespace App\Http\Controllers\Api\UserManagment;

use App\Http\Controllers\Controller;
use App\Models\Vender;
use Illuminate\Support\Collection;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class ClientController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $Project = Vender::all();
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Client_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:Venders',
                'password' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $new = new Vender();
        $new->name = $req->name;
        $new->email = $req->email;
        $new->password = Hash::make($req->password);
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Client save successfully.');
    }

    function getClientById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $Project = Vender::where(['id' => $request->id])->get();

       // return sizeof($Project);
        if(sizeof($Project)){
            return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Client(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'name' => $req->name,
            'email' => $req->email,
            'created_by' => $req->user_id,
        ];
        
        DB::table('venders')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Client update successfully.');
    }

    function resetPassword_Client(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required|min:6'
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'password' => Hash::make($req->conform),
            'created_by' => $req->user_id,
        ];
        
        DB::table('venders')->where('id',$req->id)->update($projectData);
        return $this->success([], 'Password reset successfully.');
    }

    function Client_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('venders')->where(['id' => $request->id])->first()) {
            DB::table('venders')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Client delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

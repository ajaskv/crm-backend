<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class SystemSetup extends Controller
{
    use ApiResponser;


    function index(){

        $formData = Setting::all();
        if(sizeof($formData)){
            return $this->success($formData, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function setting_store(Request $req){
        $new = new Setting();
        $new->name = $req->name;
        $new->value = $req->value;
        $new->save();
        return $this->success([], 'Setting update successfully.');
    }

    function getSettingById(Request $request){
        $validator = \Validator::make($request->all(),[
            'name'=>'required'
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

    function SettingUpdate(Request $req){
        $Data = [
            'value' => $req->value,
            'created_by' => $req->user_id,
        ];
        
        DB::table('settings')->where('name',$req->name)->update($Data);
        return $this->success([], $req->name.' Seeting update successfully.');
    }
  
}
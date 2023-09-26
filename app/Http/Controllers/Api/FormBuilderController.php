<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FormBuilder;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class FormBuilderController extends Controller
{
    use ApiResponser;


    function index(){

        $formData = FormBuilder::all();
        if(sizeof($formData)){
            return $this->success($formData, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }



    function store(Request $req){

        $validator = \Validator::make(
            $req->all(), [ 
                'name' => 'required',
                'is_active' => 'required',
                'user_id' => 'required',
                'code' => 'required|unique:form_builders',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }
        $new = new FormBuilder();
        $new->name = $req->name;
        $new->is_active = $req->is_active;
        $new->code = $req->code;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Form Builder save successfully.');
    }

    function getFormBuilderById(Request $request){
        $validator = \Validator::make($request->all(),[
            'FormBuilder_id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $FormBuilder = FormBuilder::where(['id' => $request->FormBuilder_id])->get();

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

    function delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'FormBuilder_id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('form_builders')->where(['id' => $request->FormBuilder_id])->first()) {
            DB::table('form_builders')->where(['id' => $request->FormBuilder_id])->delete();
            return response()->json(['message' => trans('Form builder delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}
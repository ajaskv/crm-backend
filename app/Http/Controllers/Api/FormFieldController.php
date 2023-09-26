<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FormField;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class FormFieldController  extends Controller
{
    use ApiResponser;


    function index(){
        $formData = FormField::all();
        if(sizeof($formData)){
            return $this->success($formData, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }



    function store(Request $req){
        $validator = \Validator::make(
            $req->all(), [ 
                'form_id' => 'required',
                'name' => 'required',
                'type' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }
        $new = new FormField();
        $new->form_id = $req->form_id;
        $new->name = $req->name;
        $new->type = $req->type;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Form field save successfully.');
    }

    function getFormFieldById(Request $request){
        $validator = \Validator::make($request->all(),[
            'FormField_id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $FormField = FormField::where(['id' => $request->FormField_id])->get();

       // return sizeof($FormField);
        if(sizeof($FormField)){
            return $this->success($FormField, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'form_id' => 'required',
                'name' => 'required',
                'type' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
            $Data = [
                'form_id' => $req->form_id,
                'name' => $req->name,
                'type' => $req->type,
                'created_by' => $req->user_id,
            ];
        
        DB::table('form_fields')->where('id',$req->id)->update($Data);
        return $this->success([], 'Form fields update successfully.');
    }

    function delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'FormField_id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('form_fields')->where(['id' => $request->FormField_id])->first()) {
            DB::table('form_fields')->where(['id' => $request->FormField_id])->delete();
            return response()->json(['message' => trans('Form fields delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}
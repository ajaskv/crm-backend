<?php

namespace App\Http\Controllers\Api\Hrm;

use App\Http\Controllers\Controller;
use App\Models\DucumentUpload;
use App\Traits\ApiResponser;
use App\Models\Utility; 
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class DocSetupController extends Controller
{   
    use ApiResponser;

    function index(){
        $deal = DucumentUpload::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function store_DocumentSetup(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'role' => 'required',
                'document' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $path =  $req->document->store('public/document');
        $new = new DucumentUpload();
        $new->name = $req->name;
        $new->role = $req->role;
        $new->document = $path;
        $new->description = $req->description;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Ducument save successfully.');
    }

    function getDocumentSetupById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = DucumentUpload::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_DocumentSetup(Request $req){
        $validator = \Validator::make(
        $req->all(), [
            'id' => 'required',
            'name' => 'required',
            'role' => 'required',
            'document' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $dealData = [
            'name' => $req->name,
            'role' => $req->role,
            'document' => $req->document,
            'description' => $req->description,
            'created_by' => $req->user_id
        ];
        
        DB::table('ducument_uploads')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Document update successfully.');
    }

    function DocumentSetup_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('ducument_uploads')->where(['id' => $request->id])->first()) {
            DB::table('ducument_uploads')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Document delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
  
}

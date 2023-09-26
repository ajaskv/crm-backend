<?php

namespace App\Http\Controllers\Api\Hrm;

use App\Http\Controllers\Controller;
use App\Models\CompanyPolicy;
use App\Traits\ApiResponser;
use App\Models\Utility; 
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class ComPolicyController extends Controller
{   
    use ApiResponser;

    function index(){
        $deal = CompanyPolicy::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function store_ComPolicy(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'branch' => 'required',
                'title' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $path =  $req->document->store('public/document');
        $new = new CompanyPolicy();
        $new->branch = $req->branch;
        $new->title = $req->title;
        $new->attachment = $path;
        $new->description = $req->description;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Company policy save successfully.');
    }

    function getComPolicyById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = CompanyPolicy::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_ComPolicy(Request $req){
        $validator = \Validator::make(
        $req->all(), [
            'id' => 'required',
            'branch' => 'required',
            'title' => 'required',
            'user_id' => 'required',
            ]
        );
        $path =  $req->attachment->store('public/document');
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $dealData = [
            'branch' => $req->branch,
            'title' => $req->title,
            'description' => $req->description,
            'attachment' => $path,
            'created_by' => $req->user_id
        ];
        
        DB::table('company_policies')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Company policy update successfully.');
    }

    function ComPolicy_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('company_policies')->where(['id' => $request->id])->first()) {
            DB::table('company_policies')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Company policy delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
  
}

<?php

namespace App\Http\Controllers\Api\Hrm\HrmSystem;

use App\Http\Controllers\Controller;
use App\Models\Competencies;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class CompetenciesController extends Controller
{   
    use ApiResponser;

    function index(){

        $deal = Competencies::all();
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function Competencies_store(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'type' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Competencies();
        $new->name = $req->name;
        $new->type = $req->type;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Competencies save successfully.');
    }

    function getCompetenciesById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $deal = Competencies::where(['id' => $request->id])->get();
       // return sizeof($deal);
        if(sizeof($deal)){
            return $this->success($deal, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_Competencies(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'name' => 'required',
                'type' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $dealData = [
            'name' => $req->name,
            'type' => $req->type,
            'created_by' => $req->user_id
        ];
        
        DB::table('competencies')->where('id',$req->id)->update($dealData);
        return $this->success([], 'Competencies update successfully.');
    }

    function Competencies_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('competencies')->where(['id' => $request->id])->first()) {
            DB::table('competencies')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Competencies delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    
}

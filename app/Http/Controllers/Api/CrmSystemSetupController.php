<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pipeline;
use App\Models\LeadStage;
use App\Models\Stage;
use App\Models\Source;
use App\Models\Label;
use App\Models\ContractType;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class CrmSystemSetupController extends Controller
{
    use ApiResponser;


    function pipeline(){

        $data = Pipeline::all();
        if(sizeof($data)){
            return $this->success($data, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }



    function store_pipeline(Request $req){

        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }
        $new = new Pipeline();
        $new->name = $req->name;
        $new->created_by = $req->user_id;
        $new->save();
        return $this->success([], 'Pipeline save successfully.');
    }

    function getpipelineById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $data = Pipeline::where(['id' => $request->id])->get();

       // return sizeof($data);
        if(sizeof($data)){
            return $this->success($data, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_pipeline(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'name' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $pipelineData = [
            'name' => $req->name,
            'created_by' => $req->user_id,
        ];
        
        DB::table('pipelines')->where('id',$req->id)->update($pipelineData);
        
        return $this->success([], 'Pipeline update successfully.');
    }

    function delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('pipelines')->where(['id' => $request->id])->first()) {
            DB::table('pipelines')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Pipeline delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }


    //  Lead Stage

    function store_lead_stage(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'pipeline_id' => 'required',
                'user_id' => 'required',
                'order' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }
        $new = new LeadStage();
        $new->name = $req->name;
        $new->pipeline_id = $req->pipeline_id;
        $new->created_by = $req->user_id;
        $new->order = $req->order;
        $new->save();
        return $this->success([], 'Lead stage save successfully.');
    }

    function edit_lead_stage(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'name' => 'required',
                'pipeline_id' => 'required',
                'user_id' => 'required',
                'order' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $leadData = [
            'name' => $req->name,
            'pipeline_id' => $req->pipeline_id,
            'created_by' => $req->user_id,
            'order' => $req->order,
        ];
        
        DB::table('lead_stages')->where('id',$req->id)->update($leadData);
        
        return $this->success([], 'Lead stage update successfully.');
    }

    function lead_stage(){

        $data = LeadStage::all();
        if(sizeof($data)){
            return $this->success($data, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }


    function getlead_stageById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $data = LeadStage::where(['id' => $request->id])->get();

       // return sizeof($data);
        if(sizeof($data)){
            return $this->success($data, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function lead_stage_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('lead_stages')->where(['id' => $request->id])->first()) {
            DB::table('lead_stages')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Lead stage delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }


    // Deal Stage
    function store_deal_stage(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'pipeline_id' => 'required',
                'user_id' => 'required',
                'order' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $new = new Stage();
        $new->name = $req->name;
        $new->pipeline_id = $req->pipeline_id;
        $new->created_by = $req->user_id;
        $new->order = $req->order;
        
        $new->save();
        return $this->success([], 'Deal Stage save successfully.');
    }

    function edit_deal_stage(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'name' => 'required',
                'pipeline_id' => 'required',
                'user_id' => 'required',
                'order' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $leadData = [
            'name' => $req->name,
            'pipeline_id' => $req->pipeline_id,
            'created_by' => $req->user_id,
            'order' => $req->order,
        ];
        
        DB::table('stages')->where('id',$req->id)->update($leadData);
        
        return $this->success([], 'Deal stages update successfully.');
    }

    function deal_stage_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('stages')->where(['id' => $request->id])->first()) {
            DB::table('stages')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Deal stage delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }


    function deal_stage(){

        $data = Stage::all();
        if(sizeof($data)){
            return $this->success($data, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function getdeal_stageById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $data = Stage::where(['id' => $request->id])->get();

       // return sizeof($data);
        if(sizeof($data)){
            return $this->success($data, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }



    // Sources
    function store_sources(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }
        $new = new Source();
        $new->name = $req->name;
        $new->created_by = $req->user_id;
        
        $new->save();
        return $this->success([], 'Source save successfully.');
    }

    function edit_sources(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'name' => 'required',
                'user_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $leadData = [
            'name' => $req->name,
            'created_by' => $req->user_id,
        ];
        
        DB::table('sources')->where('id',$req->id)->update($leadData);
        
        return $this->success([], 'Source update successfully.');
    }

    function sources(){

        $data = Source::all();
        if(sizeof($data)){
            return $this->success($data, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function getsourcesById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $data = Source::where(['id' => $request->id])->get();

       // return sizeof($data);
        if(sizeof($data)){
            return $this->success($data, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function sources_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('sources')->where(['id' => $request->id])->first()) {
            DB::table('sources')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('source delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }


    // Labels
    function store_labels(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'pipeline_id' => 'required',
                'color' => 'required',
                'user_id' => 'required'
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }   
        $new = new Label();
        $new->name = $req->name;
        $new->pipeline_id = $req->pipeline_id;
        $new->color = $req->color;
        $new->created_by = $req->user_id;
        
        $new->save();
        return $this->success([], 'Labels save successfully.');
    }
    

    function edit_labels(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'name' => 'required',
                'pipeline_id' => 'required',
                'color' => 'required',
                'user_id' => 'required'
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $leadData = [
            'name' => $req->name,
            'pipeline_id' => $req->pipeline_id,
            'color' => $req->color,
            'created_by' => $req->user_id,
        ];
        
        DB::table('labels')->where('id',$req->id)->update($leadData);
        
        return $this->success([], 'Labels update successfully.');
    }

    function labels(){

        $data = Label::all();
        if(sizeof($data)){
            return $this->success($data, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }


    function getlabelsById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $data = Label::where(['id' => $request->id])->get();

       // return sizeof($data);
        if(sizeof($data)){
            return $this->success($data, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }


    function labels_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('labels')->where(['id' => $request->id])->first()) {
            DB::table('labels')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Labels delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }



     // Contract Type
     function store_contract_type(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'name' => 'required',
                'user_id' => 'required'
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
           
        }   
        $new = new ContractType();
        $new->name = $req->name;
        $new->created_by = $req->user_id;
        
        $new->save();
        return $this->success([], 'Contract type save successfully.');
    }


    function edit_contract_type(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' => 'required',
                'name' => 'required',
                'user_id' => 'required'
                ]
            );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $leadData = [
            'name' => $req->name,
            'created_by' => $req->user_id,
        ];
        
        DB::table('contract_types')->where('id',$req->id)->update($leadData);
        
        return $this->success([], 'Contract types update successfully.');
    }

    function contract_type(){

        $data = ContractType::all();
        if(sizeof($data)){
            return $this->success($data, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function getcontract_typeById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $data = ContractType::where(['id' => $request->id])->get();

       // return sizeof($data);
        if(sizeof($data)){
            return $this->success($data, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function contract_type_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('contract_types')->where(['id' => $request->id])->first()) {
            DB::table('contract_types')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Contract type delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

}
<?php

namespace App\Http\Controllers\Api\Hrm;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
class EmpSetupController extends Controller
{   
    use ApiResponser;

    function EmpSetup(){

        $empSetup = Employee::all();
        // $deal = Employee::all();
        if(sizeof($empSetup)){
           // return response()->json(['empSetup' => $empSetup,'status'=>'200'], 200);
            return $this->success($empSetup, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function store_EmpSetup(Request $req){
        // $validator = \Validator::make(
        //     $req->all(), [
        //         'branch' => 'required',
        //         'trainer_option' => 'required',
        //         'training_type' => 'required',
        //         'trainer' => 'required',
        //         'training_cost' => 'required',
        //         'employee' => 'required',
        //         'start_date' => 'required',
        //         'end_date' => 'required',
        //         'user_id' => 'required',
        //     ]
        // );
        // if ($validator->fails()) {
        //     return Utility::error_res($validator->errors()->first());
        // }

        $Certificate  =  $req->certificate->store('public/emp_document');
        $Photo =  $req->Photo->store('public/emp_document');
        $Resume  =  $req->Resume ->store('public/emp_document');

        

        $new = new Employee();
        $new->name = $req->name;
        $new->phone = $req->phone;      
        $new->dob = $req->dob;
        $new->gender = $req->gender;
        $new->address = $req->address;
        $new->employee_id = $req->employee_id;
        $new->branch_id = $req->branch_id;
        $new->department_id = $req->department_id;
        $new->designation_id = $req->designation_id;
        $new->company_doj = $req->company_doj;
        $new->account_holder_name = $req->account_holder_name;
        $new->account_number = $req->account_number;
        $new->bank_name = $req->bank_name;
        $new->bank_identifier_code = $req->bank_identifier_code;
        $new->branch_location = $req->branch_location;
        $new->tax_payer_id = $req->tax_payer_id;
        $new->company_doj = $req->company_doj;
        $new->created_by = $req->user_id;
        $new->save();

        $document_value = "{Certificate: ".$Certificate.",Photo:".$Photo.",Resume:".$Resume."}";

        $Empdoc = new EmployeeDocument();
        $Empdoc->employee_id = $new->employee_id;
        $Empdoc->document_id = $req->document_id;
        $Empdoc->document_value = $document_value;
        $Empdoc->created_by = $req->user_id;
        $Empdoc->save();
        return $this->success([], 'Employee Setup save successfully.');
    }

    function getEmpSetupById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required',
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $EmpData = Employee::where(['id' => $request->id])->get();
      //  return $EmpData[0]->employee_id;
        $EmpDoc = EmployeeDocument::where(['employee_id' => $EmpData[0]->employee_id])->get();
       // return sizeof($deal);
        if(sizeof($EmpData)){
            return response()->json(['EmpData' => $EmpData, 'EmpDoc' => $EmpDoc, 'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_EmpSetup(Request $req){
        $validator = \Validator::make(
        $req->all(), [
            'id' => 'required',
            'employee_id' => 'required',
            'user_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $EmpData = [
            'name' => $req->name,
            'phone' => $req->phone,
            'dob' => $req->dob,
            'gender' => $req->gender,
            'address' => $req->address,
            'employee_id' => $req->employee_id,
            'branch_id' => $req->branch_id,
            'department_id' => $req->department_id,
            'designation_id' => $req->designation_id,
            'company_doj' => $req->company_doj,
            'account_holder_name' => $req->account_holder_name,
            'account_number' => $req->account_number,
            'bank_name' => $req->bank_name,
            'bank_identifier_code' => $req->bank_identifier_code,
            'branch_location' => $req->branch_location,
            'tax_payer_id' => $req->tax_payer_id,
            'created_by' => $req->user_id
        ];
        
        DB::table('employees')->where('id',$req->id)->update($EmpData);

          
        $Certificate  =  $req->certificate->store('public/emp_document');
        $Photo =  $req->Photo->store('public/emp_document');
        $Resume  =  $req->Resume ->store('public/emp_document');
        $document_value = "{Certificate: ".$Certificate.",Photo:".$Photo.",Resume:".$Resume."}";
        // if($req->certificate->store('public/emp_document') != ""){
        //     $Certificate  =  $req->certificate->store('public/emp_document');
        // }else{

        // }

        $EmpDocData = [
            'document_value' => $document_value,
            'created_by' => $req->user_id
        ];
        
        DB::table('employee_documents')->where('employee_id',$req->employee_id)->update($EmpDocData);
        return $this->success([], 'Employee Setup update successfully.');
    }

    function EmpSetup_delete(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('employees')->where(['id' => $request->id])->first()) {
            DB::table('employees')->where(['id' => $request->id])->delete();
            DB::table('employee_documents')->where(['id' => $request->id])->delete();
            return response()->json(['message' => trans('Employee Setup delete successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

  
}

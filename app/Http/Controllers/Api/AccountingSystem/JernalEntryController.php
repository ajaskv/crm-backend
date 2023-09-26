<?php

namespace App\Http\Controllers\Api\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\JournalEntry;
use App\Models\JournalItem;
use Illuminate\Support\Collection;
use App\Traits\ApiResponser;
use App\Models\Utility;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class JernalEntryController extends Controller
{   
    use ApiResponser;
 
    function index(){

        $entry = JournalEntry::all();
        $JournalItem = JournalItem::all();
        if(sizeof($entry)){
           // return $this->success('200','success');
            return response()->json(['message' => trans('success'),
            'status'=>'200',
            'JournalEntry'=>$entry,
            'JournalItem'=> $JournalItem
        ], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function JernalEntry_store(Request $req){

       // return $req->data;
        $validator = \Validator::make(
            $req->all(), [ 
                'date' => 'required',
                'reference' => 'required',
                'description' => 'required',
                'journal_id' => 'required',
                'user_id' => 'required',
            ]
        );
        if($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        $new = new JournalEntry();
        $new->date = $req->date;
        $new->reference = $req->reference;
        $new->description = $req->description;
        $new->journal_id = $req->journal_id;
        $new->created_by = $req->user_id;
        $new->save();

        foreach($req->data as $key => $value){
            $new = new JournalItem();
            $new->journal =  $req->journal_id;
            $new->account =  $value['account'];
            $new->description =  $value['description'];
            $new->debit =  $value['debit'];
            $new->credit =  $value['credit'];
            $new->save();
        }


        return $this->success([], 'Jernal entry save successfully.');
    }

    function getJernalEntryById(Request $request){
        $validator = \Validator::make($request->all(),[
            'id'=>'required'
        ]);
        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }
        $data = JournalEntry::where(['id' => $request->id])->get();

       // return $Project[0]->journal_id;
        $details = JournalItem::where(['journal' => $data[0]->journal_id])->get();

       // return sizeof($Project);
        if(sizeof($data)){
            return response()->json(['message' => trans('success'),
            'status'=>'200',
            'JournalEntry'=>$data,
            'JournalItem'=> $details
        ], 200);
           // return $this->success($Project, 'success');
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }

    function edit_JernalEntry(Request $req){
        $validator = \Validator::make(
            $req->all(), [
                'id' =>'required',
                'date' => 'required',
                'reference' => 'required',
                'description' => 'required',
                'user_id' => 'required',
            ]
        );
            if ($validator->fails()) {
                return Utility::error_res($validator->errors()->first());
            }
        $projectData = [
            'date' => $req->date,
            'reference' => $req->reference,
            'description' => $req->description,
            'created_by' => $req->user_id,
        ];
        
        DB::table('journal_entries')->where('id',$req->id)->update($projectData);

        foreach($req->data as $key => $value){
            $DetailsData = [
                'account' => $value['account'],
                'description' => $value['description'],
                'debit' => $value['debit'],
                'credit' => $value['credit'],
            ];
            
            DB::table('journal_items')->where('id',$value['item_id'])->update($DetailsData);
        }

        return $this->success([], 'Jernal entry update successfully.');
    }

   

    function JernalEntry_delete(Request $request){
        $validator = \Validator::make($request->all(),[
           // 'id'=>'required',
            'item_id' => 'required'
        ]);

        if ($validator->fails()) {
            return Utility::error_res($validator->errors()->first());
        }

        if (DB::table('journal_entries')->where(['journal_id' => $request->item_id])->first()) {
            DB::table('journal_entries')->where(['journal_id' => $request->item_id])->delete();
            DB::table('journal_items')->where(['journal' => $request->item_id])->delete();
            return response()->json(['message' => trans('Jernal entry deleted successfully'),'status'=>'200'], 200);
        }
        return response()->json(['message' => trans('Record not found'),'status'=>'404'], 404);
    }
}

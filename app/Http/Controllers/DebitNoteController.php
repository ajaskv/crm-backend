<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillProduct;
use App\Models\DebitNote;
use App\Models\JournalEntry;
use App\Models\JournalItem;
use App\Models\ProductService;
use App\Models\ChartOfAccount;
use App\Models\Utility;
use Illuminate\Http\Request;

class DebitNoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (\Auth::user()->can('manage debit note')) {
            $bills = Bill::where('created_by', \Auth::user()->creatorId())->get();

            return view('debitNote.index', compact('bills'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function journalNumber()
    {
        $latest = JournalEntry::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if (!$latest) {
            return 1;
        }

        return $latest->journal_id + 1;
    }
    public function create($bill_id)
    {
        if (\Auth::user()->can('create debit note')) {

            $billDue = Bill::where('id', $bill_id)->first();

            return view('debitNote.create', compact('billDue', 'bill_id'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function store(Request $request, $bill_id)
    {

        if (\Auth::user()->can('create debit note')) {

            $validator = \Validator::make(
                $request->all(), [
                    'amount' => 'required|numeric',
                    'date' => 'required',
                    'account' => 'required|numeric',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $billDue = Bill::where('id', $bill_id)->first();

            if ($request->amount > $billDue->getDue()) {
                return redirect()->back()->with('error', 'Maximum ' . \Auth::user()->priceFormat($billDue->getDue()) . ' credit limit of this bill.');
            }
            $bill = Bill::where('id', $bill_id)->first();
            $debit = new DebitNote();
            $debit->bill = $bill_id;
            $debit->vendor = $bill->vender_id;
            $debit->date = $request->date;
            $debit->amount = $request->amount;
            $debit->description = $request->description;
            $debit->save();
            // account entry starts.................................

            $journal = new JournalEntry();
            $journal->journal_id = $this->journalNumber();
            $journal->reference = $debit->id;
            $journal->description = "Debil Note";
            $journal->date = $request->date;
            $journal->created_by = \Auth::user()->creatorId();
            $journal->type = "debit-note";
            $journal->type_id = $debit->id;
            if ($journal->save()) {
                //Account Payable
                $account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "account-payable"])->first()->id;
                $journalItem = new JournalItem();
                $journalItem->journal = $journal->id;
                $journalItem->account = $account;
                $journalItem->description = "Debil Note";
                $journalItem->debit = ((float) $request->amount);
                $journalItem->credit = 0;
                $journalItem->save();

                //Expense for product

                $journalItem = new JournalItem();
                $journalItem->journal = $journal->id;
                $journalItem->account = $request->account;
                $journalItem->description = "Debil Note";
                $journalItem->debit = 0;
                $journalItem->credit = ((float) $request->amount);
                $journalItem->save();

                //TAX
            }
            // account entry ends

            Utility::userBalance('vendor', $bill->vender_id, $request->amount, 'debit');

            return redirect()->back()->with('success', __('Credit Note successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function edit($bill_id, $debitNote_id)
    {
        if (\Auth::user()->can('edit debit note')) {

            $debitNote = DebitNote::find($debitNote_id);

            return view('debitNote.edit', compact('debitNote'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function update(Request $request, $bill_id, $debitNote_id)
    {

        if (\Auth::user()->can('edit debit note')) {

            $validator = \Validator::make(
                $request->all(), [
                    'amount' => 'required|numeric',
                    'date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $billDue = Bill::where('id', $bill_id)->first();
            if ($request->amount > $billDue->getDue()) {
                return redirect()->back()->with('error', 'Maximum ' . \Auth::user()->priceFormat($billDue->getDue()) . ' credit limit of this bill.');
            }

            $debit = DebitNote::find($debitNote_id);
            Utility::userBalance('vendor', $billDue->vender_id, $debit->amount, 'credit');

            $debit->date = $request->date;
            $debit->amount = $request->amount;
            $debit->description = $request->description;
            $debit->save();
            // account entry starts.................................

            $journal = JournalEntry::where('type', 'debit-note')->where('type_id', $debitNote_id)->first();
            $journal->date = $request->date;
            if ($journal->save()) {
                $account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "account-payable"])->first()->id;
                $journalItem = JournalItem::where('journal', $journal->id)->where('account', $account)->first();

                $journalItem->debit = ((float) $request->amount);
                $journalItem->save();

                $journalItem = JournalItem::where('journal', $journal->id)->where('account', '!=', $account)->first();
                $journalItem->credit = ((float) $request->amount);
                $journalItem->save();
            }
            Utility::userBalance('vendor', $billDue->vender_id, $request->amount, 'debit');

            return redirect()->back()->with('success', __('Debit Note successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy($bill_id, $debitNote_id)
    {
        if (\Auth::user()->can('delete debit note')) {

            $debitNote = DebitNote::find($debitNote_id);
            $debitNote->delete();
            $journal = JournalEntry::where('type', 'debit-note')->where('type_id', $debitNote_id)->first();
            $journalItem = JournalItem::where('journal', $journal->id)->delete();
            $ $journal->delete();
            
            Utility::userBalance('vendor', $debitNote->vendor, $debitNote->amount, 'credit');

            return redirect()->back()->with('success', __('Debit Note successfully deleted.'));

        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function customCreate()
    {
        if (\Auth::user()->can('create debit note')) {
            $bills = Bill::where('created_by', \Auth::user()->creatorId())->get()->pluck('bill_id', 'id');

            return view('debitNote.custom_create', compact('bills'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function customStore(Request $request)
    {
        if (\Auth::user()->can('create debit note')) {
            $validator = \Validator::make(
                $request->all(), [
                    'bill' => 'required|numeric',
                    'amount' => 'required|numeric',
                    'date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $bill_id = $request->bill;
            $billDue = Bill::where('id', $bill_id)->first();

            if ($request->amount > $billDue->getDue()) {
                return redirect()->back()->with('error', 'Maximum ' . \Auth::user()->priceFormat($billDue->getDue()) . ' credit limit of this bill.');
            }
            $bill = Bill::where('id', $bill_id)->first();
            $debit = new DebitNote();
            $debit->bill = $bill_id;
            $debit->vendor = $bill->vender_id;
            $debit->date = $request->date;
            $debit->amount = $request->amount;
            $debit->description = $request->description;
            $debit->save();
               // account entry starts.................................

               $journal = new JournalEntry();
               $journal->journal_id = $this->journalNumber();
               $journal->reference = $debit->id;
               $journal->description = "Debil Note";
               $journal->date = $request->date;
               $journal->created_by = \Auth::user()->creatorId();
               $journal->type = "debit-note";
               $journal->type_id = $debit->id;
               if ($journal->save()) {
                   //Account Payable
                   $account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "account-payable"])->first()->id;
                   $journalItem = new JournalItem();
                   $journalItem->journal = $journal->id;
                   $journalItem->account = $account;
                   $journalItem->description = "Debil Note";
                   $journalItem->debit = ((float) $request->amount);
                   $journalItem->credit = 0;
                   $journalItem->save();
   
                   //Expense for product
   
                   $journalItem = new JournalItem();
                   $journalItem->journal = $journal->id;
                   $journalItem->account = $request->account;
                   $journalItem->description = "Debil Note";
                   $journalItem->debit = 0;
                   $journalItem->credit = ((float) $request->amount);
                   $journalItem->save();
   
                   //TAX
               }
               // account entry ends
            Utility::userBalance('vendor', $bill->vender_id, $request->amount, 'debit');

            return redirect()->back()->with('success', __('Debit Note successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function getbill(Request $request)
    {

        $bill = Bill::where('id', $request->bill_id)->first();
        $billpro = BillProduct::select('product_id')->where('bill_id', $request->bill_id)->pluck('product_id');
        $products = ProductService::select('name', 'expense_account_id as account')->whereIn('id', $billpro)->get();
        $data['bill'] = $bill->getDue();
        $data['products'] = $products;
        return json_decode(json_encode($data));
    }
}

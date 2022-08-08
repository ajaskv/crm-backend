<?php

namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
use App\Models\CreditNote;
use App\Models\Invoice;
use App\Models\JournalEntry;
use App\Models\JournalItem;
use App\Models\Utility;
use Illuminate\Http\Request;

class CreditNoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (\Auth::user()->can('manage credit note')) {
            $invoices = Invoice::where('created_by', \Auth::user()->creatorId())->get();

            return view('creditNote.index', compact('invoices'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create($invoice_id)
    {
        if (\Auth::user()->can('create credit note')) {

            $invoiceDue = Invoice::where('id', $invoice_id)->first();

            return view('creditNote.create', compact('invoiceDue', 'invoice_id'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function store(Request $request, $invoice_id)
    {
        if (\Auth::user()->can('create credit note')) {
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
            $invoiceDue = Invoice::where('id', $invoice_id)->first();
            if ($request->amount > $invoiceDue->getDue()) {
                return redirect()->back()->with('error', 'Maximum ' . \Auth::user()->priceFormat($invoiceDue->getDue()) . ' credit limit of this invoice.');
            }
            $invoice = Invoice::where('id', $invoice_id)->first();

            $credit = new CreditNote();
            $credit->invoice = $invoice_id;
            $credit->customer = $invoice->customer_id;
            $credit->date = $request->date;
            $credit->amount = $request->amount;
            $credit->description = $request->description;
            $credit->save();

            //journal entry
            $journal = new JournalEntry();
            $journal->journal_id = $this->journalNumber();
            $journal->date = $request->date;
            $journal->reference = $credit->id;
            $journal->description = "Credit Note";
            $journal->type_id = $credit->id;
            $journal->type = "credit-note";
            $journal->created_by = \Auth::user()->creatorId();
            if ($journal->save()) {
                //Account Recivable
                $journalItem = new JournalItem();
                $journalItem->journal = $journal->id;
                $journalItem->account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "account-receivable"])->first()->id;
                $journalItem->description = "Credit Note";
                $journalItem->debit = 0;
                $journalItem->credit = $request->amount;
                $journalItem->save();
                //Sales
                $journalItem = new JournalItem();
                $journalItem->journal = $journal->id;
                $journalItem->account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "sales"])->first()->id;
                $journalItem->description = "Credit Note";
                $journalItem->debit = $request->amount;
                $journalItem->credit = 0;
                $journalItem->save();
                //   //TAX
                //   $journalItem = new JournalItem();
                //   $journalItem->journal = $journal->id;
                //   $journalItem->account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "tax-payable"])->first()->id;
                //   $journalItem->description = "Total tax";
                //   $journalItem->debit = 0;
                //   $journalItem->credit = $invoice->getTotalTax();
                //   $journalItem->save();
            }
            Utility::userBalance('customer', $invoice->customer_id, $request->amount, 'debit');

            return redirect()->back()->with('success', __('Credit Note successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function edit($invoice_id, $creditNote_id)
    {
        if (\Auth::user()->can('edit credit note')) {

            $creditNote = CreditNote::find($creditNote_id);

            return view('creditNote.edit', compact('creditNote'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function update(Request $request, $invoice_id, $creditNote_id)
    {

        if (\Auth::user()->can('edit credit note')) {

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
            $invoiceDue = Invoice::where('id', $invoice_id)->first();

            if ($request->amount > $invoiceDue->getDue()) {
                return redirect()->back()->with('error', 'Maximum ' . \Auth::user()->priceFormat($invoiceDue->getDue()) . ' credit limit of this invoice.');
            }

            $credit = CreditNote::find($creditNote_id);
            Utility::userBalance('customer', $invoiceDue->customer_id, $credit->amount, 'credit');
            $credit->date = $request->date;
            $credit->amount = $request->amount;
            $credit->description = $request->description;
            $credit->save();
            //journal entry
            $journal = JournalEntry::where(['type' => "credit-note", 'type_id' => $credit->id])->first();
            if (!$journal) {
                $journal = new JournalEntry();
                $journal->journal_id = $this->journalNumber();

            }
            $journal->date = $request->date;
            if ($journal->save()) {
                //Account Recivable
                $account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "account-receivable"])->first()->id;
                $journalItem = JournalItem::where(['journal' => $journal->id, 'account' => $account])->first();
                if (!$journalItem) {
                    $journalItem = new JournalItem();
                }
                $journalItem->journal = $journal->id;
                $journalItem->account = $account;
                $journalItem->description = "Credit note";
                $journalItem->debit = 0;
                $journalItem->credit = $request->amount;
                $journalItem->save();
                //Sales
                $account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "sales"])->first()->id;
                $journalItem = JournalItem::where(['journal' => $journal->id, 'account' => $account])->first();
                if (!$journalItem) {
                    $journalItem = new JournalItem();
                }
                $journalItem->journal = $journal->id;
                $journalItem->account = $account;
                $journalItem->description = "Credit Note";
                $journalItem->debit = $request->amount;
                $journalItem->credit = 0;
                $journalItem->save();

                //TAX
                //   $account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "tax-payable"])->first()->id;
                //   $journalItem = JournalItem::where(['journal' => $journal->id, 'account' => $account])->first();
                //   if (!$journalItem) {
                //       $journalItem = new JournalItem();
                //   }
                //   $journalItem->journal = $journal->id;
                //   $journalItem->account = $account;
                //   $journalItem->description = "Total tax";
                //   $journalItem->debit = 0;
                //   $journalItem->credit = $invoice->getTotalTax();
                //   $journalItem->save();
            }
            Utility::userBalance('customer', $invoiceDue->customer_id, $request->amount, 'debit');

            return redirect()->back()->with('success', __('Credit Note successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy($invoice_id, $creditNote_id)
    {
        if (\Auth::user()->can('delete credit note')) {

            $creditNote = CreditNote::find($creditNote_id);
            $creditNote->delete();

            Utility::userBalance('customer', $creditNote->customer, $creditNote->amount, 'credit');

            return redirect()->back()->with('success', __('Credit Note successfully deleted.'));

        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function customCreate()
    {
        if (\Auth::user()->can('create credit note')) {

            $invoices = Invoice::where('created_by', \Auth::user()->creatorId())->get()->pluck('invoice_id', 'id');

            return view('creditNote.custom_create', compact('invoices'));
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
    public function customStore(Request $request)
    {
        if (\Auth::user()->can('create credit note')) {
            $validator = \Validator::make(
                $request->all(), [
                    'invoice' => 'required|numeric',
                    'amount' => 'required|numeric',
                    'date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $invoice_id = $request->invoice;
            $invoiceDue = Invoice::where('id', $invoice_id)->first();

            if ($request->amount > $invoiceDue->getDue()) {
                return redirect()->back()->with('error', 'Maximum ' . \Auth::user()->priceFormat($invoiceDue->getDue()) . ' credit limit of this invoice.');
            }
            $invoice = Invoice::where('id', $invoice_id)->first();
            $credit = new CreditNote();
            $credit->invoice = $invoice_id;
            $credit->customer = $invoice->customer_id;
            $credit->date = $request->date;
            $credit->amount = $request->amount;
            $credit->description = $request->description;
            $credit->save();

            Utility::userBalance('customer', $invoice->customer_id, $request->amount, 'debit');

            //journal entry
            $journal = new JournalEntry();
            $journal->journal_id = $this->journalNumber();
            $journal->date = $request->date;
            $journal->reference = $credit->id;
            $journal->description = "Credit Note";
            $journal->type_id = $credit->id;
            $journal->type = "credit-note";
            $journal->created_by = \Auth::user()->creatorId();
            if ($journal->save()) {
                //Account Recivable
                $journalItem = new JournalItem();
                $journalItem->journal = $journal->id;
                $journalItem->account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "account-receivable"])->first()->id;
                $journalItem->description = "Credit Note";
                $journalItem->debit = 0;
                $journalItem->credit = $request->amount;
                $journalItem->save();
                //Sales
                $journalItem = new JournalItem();
                $journalItem->journal = $journal->id;
                $journalItem->account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "sales"])->first()->id;
                $journalItem->description = "Credit Note";
                $journalItem->debit = $request->amount;
                $journalItem->credit = 0;
                $journalItem->save();
                //   //TAX
                //   $journalItem = new JournalItem();
                //   $journalItem->journal = $journal->id;
                //   $journalItem->account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "tax-payable"])->first()->id;
                //   $journalItem->description = "Total tax";
                //   $journalItem->debit = 0;
                //   $journalItem->credit = $invoice->getTotalTax();
                //   $journalItem->save();
            }
            return redirect()->back()->with('success', __('Credit Note successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function getinvoice(Request $request)
    {
        $invoice = Invoice::where('id', $request->id)->first();

        echo json_encode($invoice->getDue());
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\BillPayment;
use App\Models\ChartOfAccount;
use App\Models\EmailConfig;
use App\Models\JournalEntry;
use App\Models\JournalItem;
use App\Models\Mail\BillPaymentCreate;
use App\Models\Payment;
use App\Models\ProductServiceCategory;
use App\Models\Transaction;
use App\Models\Utility;
use App\Models\Vender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{

    public function index(Request $request)
    {
        if (\Auth::user()->can('manage payment')) {
            $vender = Vender::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $vender->prepend('All', '');

            $account = BankAccount::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('holder_name', 'id');
            $account->prepend('All', '');

            $category = ProductServiceCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 2)->get()->pluck('name', 'id');
            $category->prepend('All', '');

            $query = Payment::where('created_by', '=', \Auth::user()->creatorId());

            if (!empty($request->date)) {
                $date_range = explode(' - ', $request->date);
                $query->whereBetween('date', $date_range);
            }

            if (!empty($request->vender)) {
                $query->where('id', '=', $request->vender);
            }
            if (!empty($request->account)) {
                $query->where('account_id', '=', $request->account);
            }

            if (!empty($request->category)) {
                $query->where('category_id', '=', $request->category);
            }

            $payments = $query->get();

            return view('payment.index', compact('payments', 'account', 'category', 'vender'));
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
    public function create()
    {
        if (\Auth::user()->can('create payment')) {
            $venders = Vender::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $venders->prepend('--', 0);
            $categories = ProductServiceCategory::where('created_by', '=', \Auth::user()->creatorId())->where('type', '=', 2)->get()->pluck('name', 'id');
            $accounts = BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('payment.create', compact('venders', 'categories', 'accounts'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {

        if (\Auth::user()->can('create payment')) {

            $validator = \Validator::make(
                $request->all(), [
                    'date' => 'required',
                    'amount' => 'required',
                    'account_id' => 'required',
                    'category_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            if (isset($request->cheque)) {
                $validator = \Validator::make(
                    $request->all(), [
                        'cheque_no' => 'required',
                        'cheque_date' => 'required',
                        'cheque_bank' => 'required',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
            }
            $payment = new Payment();
            $payment->date = $request->date;
            $payment->amount = $request->amount;
            $payment->account_id = $request->account_id;
            $payment->vender_id = $request->vender_id;
            $payment->category_id = $request->category_id;
            $payment->payment_method = 0;
            $payment->reference = $request->reference;
            if (!empty($request->add_receipt)) {
                $fileName = time() . "_" . $request->add_receipt->getClientOriginalName();
                $request->add_receipt->storeAs('uploads/payment', $fileName);
                $payment->add_receipt = $fileName;
            }
            if (isset($request->cheque)) {
                $payment->cheque = 1;
                $payment->cheque_no = $request->cheque_no;
                $payment->cheque_bank = $request->cheque_bank;
                $payment->cheque_date = $request->cheque_date;
            }
            $payment->description = $request->description;
            $payment->created_by = \Auth::user()->creatorId();
            $payment->save();
            $oldpayment = $payment;

            $vender = Vender::where('id', $request->vender_id)->first();
            $payment = new BillPayment();
            $payment->name = !empty($vender) ? $vender['name'] : '';
            $payment->method = '-';
            $payment->date = \Auth::user()->dateFormat($request->date);
            $payment->amount = \Auth::user()->priceFormat($request->amount);
            $payment->bill = '';

            $category = ProductServiceCategory::where('id', $request->category_id)->first();
            $payment->payment_id = $oldpayment->id;
            $payment->type = 'Payment';
            $payment->category = $category->name;
            $payment->user_id = $request->vender_id;
            $payment->user_type = 'Vender';
            $payment->account = $request->account_id;
            $payment->description = $request->description;
            $payment->created_by = \Auth::user()->creatorId();
            
            if (!isset($request->cheque)) {
                Transaction::addTransaction($payment);
                if (!empty($vender)) {
                    Utility::userBalance('vendor', $vender->id, $request->amount, 'debit');
                }

                Utility::bankAccountBalance($request->account_id, $request->amount, 'debit');

                //journal entry
                $journal = new JournalEntry();
                $journal->journal_id = $this->journalNumber();
                $journal->date = $request->date;
                $journal->reference = $payment->id;
                $journal->description = "Payment";
                $journal->created_by = \Auth::user()->creatorId();
                $journal->type = "payment";
                $journal->type_id = $payment->id;
                if ($journal->save()) {
                    //Account Payable
                    $journalItem = new JournalItem();
                    $journalItem->journal = $journal->id;
                    $journalItem->account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "account-payable"])->first()->id;
                    $journalItem->description = "Payment";
                    $journalItem->debit = $request->amount;
                    $journalItem->credit = 0;
                    $journalItem->save();

                    //Invoice Cash
                    $journalItem = new JournalItem();
                    $journalItem->journal = $journal->id;
                    $journalItem->account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "invoice-cash"])->first()->id;
                    $journalItem->description = "Payment";
                    $journalItem->debit = 0;
                    $journalItem->credit = $request->amount;
                    $journalItem->save();
                }
            }
            try
            {
                EmailConfig::mymail();
                Mail::to($vender['email'])->send(new BillPaymentCreate($payment));
            } catch (\Exception$e) {
                $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
            }

            //Twilio Notification
            $setting = Utility::settings(\Auth::user()->creatorId());
            $vender = Vender::find($request->vender_id);
            if (isset($setting['payment_notification']) && $setting['payment_notification'] == 1) {
                $msg = __("New payment of") . ' ' . \Auth::user()->priceFormat($request->amount) . __("created for") . ' ' . $vender->name . __("by") . ' ' . $payment->type . '.';
                Utility::send_twilio_msg($vender->contact, $msg);
            }

         
            return redirect()->route('payment.index')->with('success', __('Payment successfully created.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function chequePaid($id)
    {
        $oldpayment = Payment::find($id);
        $oldpayment->cheque = 2;
        if ($oldpayment->save()) {

              $category = ProductServiceCategory::where('id', $oldpayment->category_id)->first();
         

            $vender = Vender::where('id', $oldpayment->vender_id)->first();
            $payment = new BillPayment();
            $payment->name = !empty($vender) ? $vender['name'] : '';
            $payment->method = '-';
            $payment->date = \Auth::user()->dateFormat($oldpayment->date);
            $payment->amount = \Auth::user()->priceFormat($oldpayment->amount);
            $payment->bill = '';

            $payment->payment_id = $oldpayment->id;
            $payment->type = 'Payment';
            $payment->category = $category->name;
            $payment->user_id = $oldpayment->vender_id;
            $payment->user_type = 'Vender';
            $payment->account = $oldpayment->account_id;
            $payment->description = $oldpayment->description;
            $payment->created_by = $oldpayment->created_by;

            Transaction::addTransaction($payment);
            if (!empty($vender)) {
                Utility::userBalance('vendor', $vender->id, $oldpayment->amount, 'debit');
            }

            Utility::bankAccountBalance($oldpayment->account_id, $oldpayment->amount, 'debit');

            //journal entry
            $journal = new JournalEntry();
            $journal->journal_id = $this->journalNumber();
            $journal->date = $oldpayment->date;
            $journal->reference = $oldpayment->id;
            $journal->description = "Payment";
            $journal->created_by = \Auth::user()->creatorId();
            $journal->type = "payment";
            $journal->type_id = $oldpayment->id;
            if ($journal->save()) {
                //Account Payable
                $journalItem = new JournalItem();
                $journalItem->journal = $journal->id;
                $journalItem->account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "account-payable"])->first()->id;
                $journalItem->description = "Payment";
                $journalItem->debit = $oldpayment->amount;
                $journalItem->credit = 0;
                $journalItem->save();

                //Invoice Cash
                $journalItem = new JournalItem();
                $journalItem->journal = $journal->id;
                $journalItem->account = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "invoice-cash"])->first()->id;
                $journalItem->description = "Payment";
                $journalItem->debit = 0;
                $journalItem->credit = $oldpayment->amount;
                $journalItem->save();
            }
            return redirect()->route('payment.index')->with('success', __('Cheque paid successfully created.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }
    public function chequeNotPaid($id)
    {
        $payment = Payment::find($id);
        $payment->cheque = 0;
        $payment->save();
        $payment->delete();
        return redirect()->route('payment.index')->with('success', __('Cheque Cancelled successfully ') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
    }
    public function edit(Payment $payment)
    {

        if (\Auth::user()->can('edit payment')) {
            $venders = Vender::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $venders->prepend('--', 0);
            $categories = ProductServiceCategory::where('created_by', '=', \Auth::user()->creatorId())->get()->where('type', '=', 2)->pluck('name', 'id');

            $accounts = BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('payment.edit', compact('venders', 'categories', 'accounts', 'payment'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Payment $payment)
    {
        if (\Auth::user()->can('edit payment')) {

            $validator = \Validator::make(
                $request->all(), [
                    'date' => 'required',
                    'amount' => 'required',
                    'account_id' => 'required',
                    'vender_id' => 'required',
                    'category_id' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $vender = Vender::where('id', $request->vender_id)->first();
            if (!empty($vender)) {
                Utility::userBalance('vendor', $vender->id, $payment->amount, 'credit');
            }
            Utility::bankAccountBalance($payment->account_id, $payment->amount, 'credit');

            $payment->date = $request->date;
            $payment->amount = $request->amount;
            $payment->account_id = $request->account_id;
            $payment->vender_id = $request->vender_id;
            $payment->category_id = $request->category_id;
            $payment->payment_method = 0;
            $payment->reference = $request->reference;

            if (!empty($request->add_receipt)) {
                $fileName = time() . "_" . $request->add_receipt->getClientOriginalName();
                $request->add_receipt->storeAs('uploads/payment', $fileName);
                $payment->add_receipt = $fileName;
            }

            $payment->description = $request->description;
            $payment->save();

            $category = ProductServiceCategory::where('id', $request->category_id)->first();
            $payment->category = $category->name;
            $payment->payment_id = $payment->id;
            $payment->type = 'Payment';
            $payment->account = $request->account_id;
            Transaction::editTransaction($payment);

            if (!empty($vender)) {
                Utility::userBalance('vendor', $vender->id, $request->amount, 'debit');
            }

            Utility::bankAccountBalance($request->account_id, $request->amount, 'debit');

            //journal entry
            $journal = JournalEntry::where('type_id', $payment->id)->where('type', 'payment')->where('created_by', \Auth::user()->creatorId())->first();
            $journal->date = $payment->date;
            if ($journal->save()) {
                //Account payable
                $account_id = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "account-payable"])->first()->id;
                $journalItem = JournalItem::where('journal', $journal->id)->where('account', $account_id)->first();
                $journalItem->debit = $payment->amount;
                $journalItem->credit = 0;
                $journalItem->save();

                //Invoice Cash
                $account_id = ChartOfAccount::where(['created_by' => \Auth::user()->creatorId(), 'account_name' => "invoice-cash"])->first()->id;
                $journalItem = JournalItem::where('journal', $journal->id)->where('account', $account_id)->first();
                $journalItem->debit = 0;
                $journalItem->credit = $payment->amount;
                $journalItem->save();
            }

            return redirect()->route('payment.index')->with('success', __('Payment successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy(Payment $payment)
    {
        if (\Auth::user()->can('delete payment')) {
            if ($payment->created_by == \Auth::user()->creatorId()) {
                $payment->delete();
                $type = 'Payment';
                $user = 'Vender';
                Transaction::destroyTransaction($payment->id, $type, $user);

                if ($payment->vender_id != 0) {
                    Utility::userBalance('vendor', $payment->vender_id, $payment->amount, 'credit');
                }
                Utility::bankAccountBalance($payment->account_id, $payment->amount, 'credit');

                $journalEntry = JournalEntry::where('type_id', $payment->id)->where('type', 'payment')->where('created_by', \Auth::user()->creatorId())->first();
                if ($journalEntry) {
                    $journalEntry->delete();
                    JournalItem::where('journal', '=', $journalEntry->id)->delete();
                }

                return redirect()->route('payment.index')->with('success', __('Payment successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}

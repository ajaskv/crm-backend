<?php

namespace App\Http\Controllers;

use App\Models\EmailConfig;
use App\Models\Employee;
use App\Models\Mail\TripSend;
use App\Models\Travel;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TravelController extends Controller
{
    public function index()
    {
        if (\Auth::user()->can('manage travel')) {
            if (Auth::user()->type == 'employee') {
                $emp = Employee::where('user_id', '=', \Auth::user()->id)->first();
                $travels = Travel::where('created_by', '=', \Auth::user()->creatorId())->where('employee_id', '=', $emp->id)->get();
            } else {
                $travels = Travel::where('created_by', '=', \Auth::user()->creatorId())->get();
            }

            return view('travel.index', compact('travels'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if (\Auth::user()->can('create travel')) {
            $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('travel.create', compact('employees'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if (\Auth::user()->can('create travel')) {
            $validator = \Validator::make(
                $request->all(), [
                    'employee_id' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'purpose_of_visit' => 'required',
                    'place_of_visit' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $travel = new Travel();
            $travel->employee_id = $request->employee_id;
            $travel->start_date = $request->start_date;
            $travel->end_date = $request->end_date;
            $travel->purpose_of_visit = $request->purpose_of_visit;
            $travel->place_of_visit = $request->place_of_visit;
            $travel->description = $request->description;
            $travel->created_by = \Auth::user()->creatorId();
            $travel->save();

            $setings = Utility::settings();
            if ($setings['employee_trip'] == 1) {
                $employee = Employee::find($travel->employee_id);
                $travel->name = $employee->name;
                $travel->email = $employee->email;

                try
                {
                    EmailConfig::mymail();

                    Mail::to($travel->email)->send(new TripSend($travel));
                } catch (\Exception $e) {
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }

                return redirect()->route('travel.index')->with('success', __('Travel  successfully created.') . (isset($smtp_error) ? $smtp_error : ''));

            }

            return redirect()->route('travel.index')->with('success', __('Travel  successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(Travel $travel)
    {
        return redirect()->route('travel.index');
    }

    public function edit(Travel $travel)
    {

        if (\Auth::user()->can('edit travel')) {
            $employees = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            if ($travel->created_by == \Auth::user()->creatorId()) {
                return view('travel.edit', compact('travel', 'employees'));
            } else {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Travel $travel)
    {
        if (\Auth::user()->can('edit travel')) {
            if ($travel->created_by == \Auth::user()->creatorId()) {

                $validator = \Validator::make(
                    $request->all(), [
                        'employee_id' => 'required',
                        'start_date' => 'required',
                        'end_date' => 'required',
                        'purpose_of_visit' => 'required',
                        'place_of_visit' => 'required',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $travel->employee_id = $request->employee_id;
                $travel->start_date = $request->start_date;
                $travel->end_date = $request->end_date;
                $travel->purpose_of_visit = $request->purpose_of_visit;
                $travel->place_of_visit = $request->place_of_visit;
                $travel->description = $request->description;
                $travel->save();

                return redirect()->route('travel.index')->with('success', __('Travel successfully updated.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy(Travel $travel)
    {
        if (\Auth::user()->can('delete travel')) {
            if ($travel->created_by == \Auth::user()->creatorId()) {
                $travel->delete();

                return redirect()->route('travel.index')->with('success', __('Travel successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}

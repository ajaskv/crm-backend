@extends('layouts.admin')
@section('page-title')
    {{ __('Manage Payments') }}
@endsection

@section('action-button')
    <div class="row d-flex justify-content-end">
        <div class="col-auto">
            {{ Form::open(['route' => ['payment.index'], 'method' => 'GET', 'id' => 'payment_form']) }}
        </div>
        <div class="col-auto">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('date', __('Date'), ['class' => 'text-type']) }}
                    {{ Form::text('date', isset($_GET['date']) ? $_GET['date'] : null, ['class' => 'form-control month-btn datepicker-range']) }}
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('account', __('Account'), ['class' => 'text-type']) }}
                    {{ Form::select('account', $account, isset($_GET['account']) ? $_GET['account'] : '', ['class' => 'form-control select2']) }}
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('vender', __('Vendor'), ['class' => 'text-type']) }}
                    {{ Form::select('vender', $vender, isset($_GET['vender']) ? $_GET['vender'] : '', ['class' => 'form-control select2']) }}
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('category', __('Category'), ['class' => 'text-type']) }}
                    {{ Form::select('category', $category, isset($_GET['category']) ? $_GET['category'] : '', ['class' => 'form-control select2']) }}
                </div>
            </div>
        </div>
        <div class="col-auto">
            {{ Form::close() }}
        </div>
        <div class="col-auto my-custom-btn">
            <a href="#" class="apply-btn" onclick="document.getElementById('payment_form').submit(); return false;"
                data-toggle="tooltip" data-original-title="{{ __('apply') }}">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="{{ route('payment.index') }}" class="reset-btn" data-toggle="tooltip"
                data-original-title="{{ __('Reset') }}">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
        </div>
        @can('create payment')
            <div class="col-2 my-custom-btn">
                <div class="all-button-box">
                    <a href="#" data-url="{{ route('payment.create') }}" data-ajax-popup="true"
                        data-title="{{ __('Create New Payment') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
                        <i class="fas fa-plus"></i> {{ __('Create') }}
                    </a>
                </div>
            </div>
        @endcan
    </div>
@endsection

@section('content')
    <div class="">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-0 mt-2">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Account') }}</th>
                                    <th>{{ __('Vendor') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Reference') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Payment Receipt') }}</th>
                                    @if (Gate::check('edit payment') || Gate::check('delete payment'))
                                        <th>{{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($payments as $payment)
                                    <tr class="font-style">
                                        <td>{{ Auth::user()->dateFormat($payment->date) }}</td>
                                        <td>{{ Auth::user()->priceFormat($payment->amount) }}</td>
                                        <td>{{ !empty($payment->bankAccount) ? $payment->bankAccount->bank_name . ' ' . $payment->bankAccount->holder_name : '' }}
                                        </td>
                                        <td>{{ !empty($payment->vender) ? $payment->vender->name : '-' }}</td>
                                        <td>{{ !empty($payment->category) ? $payment->category->name : '-' }}</td>
                                        <td>{{ !empty($payment->reference) ? $payment->reference : '-' }}</td>

                                        <td>{{ !empty($payment->description) ? $payment->description : '-' }}</td>
                                        <td>
                                            @if (!empty($payment->add_receipt))
                                                <a href="{{ asset(Storage::url('uploads/payment')) . '/' . $payment->add_receipt }}"
                                                    download="" class="btn btn-sm btn-secondary btn-icon rounded-pill"
                                                    target="_blank"><span class="btn-inner--icon"><i
                                                            class="fas fa-download"></i></span></a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        @if (Gate::check('edit payment') || Gate::check('delete payment'))
                                            <td class="action text-right">
                                                @can('edit payment')
                                                    <a href="#" class="edit-icon"
                                                        data-url="{{ route('payment.edit', $payment->id) }}"
                                                        data-ajax-popup="true" data-title="{{ __('Edit Payment') }}"
                                                        data-toggle="tooltip" data-original-title="{{ __('Edit') }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                @endcan
                                                @can('delete payment')
                                                    <a href="#" class="delete-icon" data-toggle="tooltip"
                                                        data-original-title="{{ __('Delete') }}"
                                                        data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                        data-confirm-yes="document.getElementById('delete-form-{{ $payment->id }}').submit();">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['payment.destroy', $payment->id], 'id' => 'delete-form-' . $payment->id]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                                @if($payment->cheque == 1)
                                                <a href="{{ route('payment.cheque.pay', $payment->id) }}" class="edit-icon" data-toggle="tooltip"
                                                    data-original-title="{{ __('Cheque Pay') }}"
                                                    data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                    data-confirm-yes="window.location.href = '{{ route('payment.cheque.pay', $payment->id) }}'"; >
                                                    <i class="fas fa-thumbs-up ,"></i>
                                                </a>
                                                <a href="{{ route('payment.cheque.cancel', $payment->id) }}" class="delete-icon" data-toggle="tooltip"
                                                    data-original-title="{{ __('Cheque Cancel') }}"
                                                    data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                    data-confirm-yes="window.location.href = '{{ route('payment.cheque.cancel', $payment->id) }}'"; >
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')
@section('page-title')
    @if (\Auth::user()->bill_ipo == 0)
        {{ __('Manage Bills') }}
    @else
        {{ __('Manage Lpo') }}
    @endif
@endsection
@push('script-page')
    <script>
        $('.copy_link').click(function(e) {
            e.preventDefault();
            var copyText = $(this).attr('href');

            document.addEventListener('copy', function(e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');
            show_toastr('Success', 'Url copied to clipboard', 'success');
        });
    </script>
@endpush
@section('action-button')
    <div class="row d-flex justify-content-end">
        <div class="col-0">
            @if (!\Auth::guard('vender')->check())
                {{ Form::open(['route' => ['bill.index'], 'method' => 'GET', 'id' => 'frm_submit']) }}
            @else
                {{ Form::open(['route' => ['vender.bill'], 'method' => 'GET', 'id' => 'frm_submit']) }}
            @endif
        </div>
        <div class="col-2">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('bill_date', __('Date'), ['class' => 'text-type']) }}
                    {{ Form::text('bill_date', isset($_GET['bill_date']) ? $_GET['bill_date'] : null, ['class' => 'month-btn form-control datepicker-range']) }}
                </div>
            </div>
        </div>
        @if (!\Auth::guard('vender')->check())
            <div class="col-auto">
                <div class="all-select-box">
                    <div class="btn-box">
                        {{ Form::label('vender', __('Vender'), ['class' => 'text-type']) }}
                        {{ Form::select('vender', $vender, isset($_GET['vender']) ? $_GET['vender'] : '', ['class' => 'form-control select2']) }}
                    </div>
                </div>
            </div>
        @endif
        <div class="col-2">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('status', __('Status'), ['class' => 'text-type']) }}
                    {{ Form::select('status', ['' => 'All'] + $status, isset($_GET['status']) ? $_GET['status'] : '', ['class' => 'form-control select2']) }}
                </div>
            </div>
        </div>
        <div class="col-auto my-custom">
            <a href="#" class="apply-btn" onclick="document.getElementById('frm_submit').submit(); return false;"
                data-toggle="tooltip" data-original-title="{{ __('apply') }}">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            @if (!\Auth::guard('vender')->check())
                <a href="{{ route('bill.index') }}" class="reset-btn" data-toggle="tooltip"
                    data-original-title="{{ __('Reset') }}">
                    <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
                </a>
            @else
                <a href="{{ route('vender.index') }}" class="reset-btn" data-toggle="tooltip"
                    data-original-title="{{ __('Reset') }}">
                    <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
                </a>
            @endif
        </div>
        <div class="col-0">
            {{ Form::close() }}
        </div>
        @can('create bill')
            <div class="col-2 my-custom-btn">
                <div class="all-button-box">
                    <a href="{{ route('bill.create', 0) }}" class="btn btn-xs btn-white btn-icon-only width-auto">
                        <i class="fas fa-plus"></i> {{ __('Create') }}
                    </a>
                </div>
            </div>
        @endcan
        <div class="col-2 my-custom-btn">
            <div class="all-button-box">
                <a href="{{ route('bill.export') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fa fa-file-excel"></i> {{ __('Export') }}
                </a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0 mt-2">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                                <tr>
                                    <th>
                                        @if (\Auth::user()->bill_ipo == 0)
                                            {{ __('Bill') }}
                                        @else
                                            {{ __('Lpo') }}
                                        @endif
                                    </th>
                                    @if (!\Auth::guard('vender')->check())
                                        <th> {{ __('Vendor') }}</th>
                                    @endif
                                    <th> {{ __('Category') }}</th>
                                    <th> {{ __('Bill Date') }}</th>
                                    <th> {{ __('Due Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    @if (Gate::check('edit bill') || Gate::check('delete bill') || Gate::check('show bill'))
                                        <th> {{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $bill)
                                    <tr>
                                        <td class="Id">
                                            @if (\Auth::user()->bill_ipo == 0)
                                                @if (\Auth::guard('vender')->check())
                                                    <a
                                                        href="{{ route('vender.bill.show', \Crypt::encrypt($bill->id)) }}">{{ AUth::user()->billNumberFormat($bill->bill_id) }}</a>
                                                @else
                                                    <a
                                                        href="{{ route('bill.show', \Crypt::encrypt($bill->id)) }}">{{ AUth::user()->billNumberFormat($bill->bill_id) }}</a>
                                                @endif
                                            @else
                                                @if (\Auth::guard('vender')->check())
                                                    <a
                                                        href="{{ route('vender.bill.show', \Crypt::encrypt($bill->id)) }}">{{ AUth::user()->ipoNumberFormat($bill->bill_id) }}</a>
                                                @else
                                                    <a
                                                        href="{{ route('bill.show', \Crypt::encrypt($bill->id)) }}">{{ AUth::user()->ipoNumberFormat($bill->bill_id) }}</a>
                                                @endif
                                            @endif

                                        </td>
                                        @if (!\Auth::guard('vender')->check())
                                            <td> {{ !empty($bill->vender) ? $bill->vender->name : '' }} </td>
                                        @endif
                                        <td>{{ !empty($bill->category) ? $bill->category->name : '' }}</td>
                                        <td>{{ Auth::user()->dateFormat($bill->bill_date) }}</td>
                                        <td>{{ Auth::user()->dateFormat($bill->due_date) }}</td>
                                        <td>
                                            @if ($bill->status == 0)
                                                <span
                                                    class="badge badge-pill badge-primary">{{ __(\App\Models\Invoice::$statues[$bill->status]) }}</span>
                                            @elseif($bill->status == 1)
                                                <span
                                                    class="badge badge-pill badge-warning">{{ __(\App\Models\Invoice::$statues[$bill->status]) }}</span>
                                            @elseif($bill->status == 2)
                                                <span
                                                    class="badge badge-pill badge-danger">{{ __(\App\Models\Invoice::$statues[$bill->status]) }}</span>
                                            @elseif($bill->status == 3)
                                                <span
                                                    class="badge badge-pill badge-info">{{ __(\App\Models\Invoice::$statues[$bill->status]) }}</span>
                                            @elseif($bill->status == 4)
                                                <span
                                                    class="badge badge-pill badge-success">{{ __(\App\Models\Invoice::$statues[$bill->status]) }}</span>
                                            @endif
                                        </td>
                                        @if (Gate::check('edit bill') || Gate::check('delete bill') || Gate::check('show bill'))
                                            <td class="Action">
                                                <span>@php $billID= Crypt::encrypt($bill->id); @endphp
                                                    @can('copy invoice')
                                                        <a href="{{ route('bill.link.copy', [$billID]) }}"
                                                            class="edit-icon bg-info copy_link" data-toggle="tooltip"
                                                            data-original-title="{{ __('Click to copy') }}"><i
                                                                class="fas fa-link"></i></a>
                                                    @endcan
                                                    @can('duplicate bill')
                                                        <a href="#" class="edit-icon bg-success" data-toggle="tooltip"
                                                            data-original-title="{{ __('Duplicate') }}" data-toggle="tooltip"
                                                            data-original-title="{{ __('Delete') }}"
                                                            data-confirm="You want to confirm this action. Press Yes to continue or Cancel to go back"
                                                            data-confirm-yes="document.getElementById('duplicate-form-{{ $bill->id }}').submit();">
                                                            <i class="fas fa-copy"></i>
                                                            {!! Form::open(['method' => 'get', 'route' => ['bill.duplicate', $bill->id], 'id' => 'duplicate-form-' . $bill->id]) !!}
                                                            {!! Form::close() !!}
                                                        </a>
                                                    @endcan
                                                    @can('show bill')
                                                        @if (\Auth::guard('vender')->check())
                                                            <a href="{{ route('vender.bill.show', \Crypt::encrypt($bill->id)) }}"
                                                                class="edit-icon bg-warning" data-toggle="tooltip"
                                                                data-original-title="{{ __('Detail') }}">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('bill.show', \Crypt::encrypt($bill->id)) }}"
                                                                class="edit-icon bg-warning" data-toggle="tooltip"
                                                                data-original-title="{{ __('Detail') }}">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        @endif
                                                    @endcan
                                                    @can('edit bill')
                                                        <a href="{{ route('bill.edit', \Crypt::encrypt($bill->id)) }}"
                                                            class="edit-icon" data-toggle="tooltip"
                                                            data-original-title="{{ __('Edit') }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    @endcan
                                                    @can('delete bill')
                                                        <a href="#" class="delete-icon " data-toggle="tooltip"
                                                            data-original-title="{{ __('Delete') }}"
                                                            data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                            data-confirm-yes="document.getElementById('delete-form-{{ $bill->id }}').submit();">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['bill.destroy', $bill->id], 'id' => 'delete-form-' . $bill->id]) !!}
                                                        {!! Form::close() !!}
                                                    @endcan
                                                    <a href="{{ route('bill.pdf', \Crypt::encrypt($bill->id)) }}" target="_blank"
                                                        class="edit-icon ">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </span>
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

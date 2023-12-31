<div class="card bg-none card-box">
    {{ Form::open(['url' => 'loan', 'method' => 'post']) }}
    {{ Form::hidden('employee_id', $employee->id, []) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('title', __('Title'), ['class' => 'form-control-label']) }}
            {{ Form::text('title', null, ['class' => 'form-control ', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('loan_option', __('Loan Options'), ['class' => 'form-control-label']) }}<span
                class="text-danger">*</span>
            {{ Form::select('loan_option', $loan_options, null, ['class' => 'form-control select2', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('type', __('Type'), ['class' => 'form-control-label']) }}
            {{ Form::select('type', $loan, null, ['class' => 'form-control select2 amount_type', 'required' => 'required']) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Loan Amount'), ['class' => 'form-control-label amount_label']) }}
            {{ Form::number('amount', null, ['class' => 'form-control ', 'required' => 'required', 'step' => '0.01']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('start_date', __('Start Date'), ['class' => 'form-control-label']) }}
            {{ Form::text('start_date', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('end_date', __('End Date'), ['class' => 'form-control-label']) }}
            {{ Form::text('end_date', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
        </div>
        {{-- <div class="form-group col-md-12"> --}}
        {{-- {{ Form::label('reason', __('Reason'),['class'=>'form-control-label']) }} --}}
        {{-- {{ Form::textarea('reason',null, array('class' => 'form-control','rows'=>1,'required'=>'required')) }} --}}
        {{-- </div> --}}

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('reason', __('Reason')) }}
                {{ Form::textarea('reason', null, ['class' => 'form-control ', 'required' => 'required']) }}
            </div>
        </div>
        <div class="col-12 pt-5 text-right">
            <input type="submit" value="{{ __('Create') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

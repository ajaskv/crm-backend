<div class="card bg-none card-box">
    {{ Form::open(['url' => 'saturationdeduction', 'method' => 'post']) }}
    {{ Form::hidden('employee_id', $employee->id, []) }}
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('deduction_option', __('Deduction Options'), ['class' => 'form-control-label']) }}<span
                class="text-danger">*</span>
            {{ Form::select('deduction_option', $deduction_options, null, ['class' => 'form-control select2', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('title', __('Title'), ['class' => 'form-control-label']) }}
            {{ Form::text('title', null, ['class' => 'form-control ', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('type', __('Type'), ['class' => 'form-control-label']) }}
            {{ Form::select('type', $saturationdeduc, null, ['class' => 'form-control select2 amount_type', 'required' => 'required']) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Amount'), ['class' => 'form-control-label amount_label']) }}
            {{ Form::number('amount', null, ['class' => 'form-control ', 'required' => 'required', 'step' => '0.01']) }}
        </div>

        <div class="col-12 pt-5 text-right">
            <input type="submit" value="{{ __('Create') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

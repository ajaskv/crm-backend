<div class="card bg-none card-box">
    {{ Form::open(['url' => 'overtime', 'method' => 'post']) }}
    {{ Form::hidden('employee_id', $employee->id, []) }}
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('title', __('Overtime Title'), ['class' => 'form-control-label']) }}<span
                class="text-danger">*</span>
            {{ Form::text('title', null, ['class' => 'form-control ', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('number_of_days', __('Number of days'), ['class' => 'form-control-label']) }}
            {{ Form::number('number_of_days', null, ['class' => 'form-control ', 'required' => 'required', 'step' => '0.01']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('hours', __('Hours'), ['class' => 'form-control-label']) }}
            {{ Form::number('hours', null, ['class' => 'form-control ', 'required' => 'required', 'step' => '0.01']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('rate', __('Rate'), ['class' => 'form-control-label']) }}
            {{ Form::number('rate', null, ['class' => 'form-control ', 'required' => 'required', 'step' => '0.01']) }}
        </div>
        <div class="col-12 pt-5 text-right">
            <input type="submit" value="{{ __('Create') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

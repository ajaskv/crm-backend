<div class="card bg-none card-box">
    {{ Form::open(['url' => 'promotion', 'method' => 'post']) }}
    <div class="row">
        <div class="form-group col-lg-6 col-md-6">
            {{ Form::label('employee_id', __('Employee'), ['class' => 'form-control-label']) }}
            {{ Form::select('employee_id', $employees, null, ['class' => 'form-control select2', 'required' => 'required']) }}
        </div>
        <div class="form-group col-lg-6 col-md-6">
            {{ Form::label('designation_id', __('Designation'), ['class' => 'form-control-label']) }}
            {{ Form::select('designation_id', $designations, null, ['class' => 'form-control select2']) }}
        </div>
        <div class="form-group col-lg-6 col-md-6">
            {{ Form::label('promotion_title', __('Promotion Title'), ['class' => 'form-control-label']) }}
            {{ Form::text('promotion_title', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group col-lg-6 col-md-6">
            {{ Form::label('promotion_date', __('Promotion Date'), ['class' => 'form-control-label']) }}
            {{ Form::text('promotion_date', null, ['class' => 'form-control datepicker']) }}
        </div>
        <div class="form-group col-lg-12">
            {{ Form::label('description', __('Description'), ['class' => 'form-control-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Description')]) }}
        </div>
        <div class="col-12 pt-5 text-right">
            <input type="submit" value="{{ __('Create') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

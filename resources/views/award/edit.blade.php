<div class="card bg-none card-box">
    {{ Form::model($award, ['route' => ['award.update', $award->id], 'method' => 'PUT']) }}
    <div class="row">
        <div class="form-group col-md-6 col-lg-6">
            {{ Form::label('employee_id', __('Employee'), ['class' => 'form-control-label']) }}
            {{ Form::select('employee_id', $employees, null, ['class' => 'form-control select2', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6 col-lg-6">
            {{ Form::label('award_type', __('Award Type'), ['class' => 'form-control-label']) }}
            {{ Form::select('award_type', $awardtypes, null, ['class' => 'form-control select2', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6 col-lg-6">
            {{ Form::label('date', __('Date'), ['class' => 'form-control-label']) }}
            {{ Form::text('date', null, ['class' => 'form-control datepicker']) }}
        </div>
        <div class="form-group col-md-6 col-lg-6">
            {{ Form::label('gift', __('Gift'), ['class' => 'form-control-label']) }}
            {{ Form::text('gift', null, ['class' => 'form-control', 'placeholder' => __('Enter Gift')]) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('description', __('Description'), ['class' => 'form-control-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Description')]) }}
        </div>
        <div class="col-12 pt-5 text-right">
            <input type="submit" value="{{ __('Update') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

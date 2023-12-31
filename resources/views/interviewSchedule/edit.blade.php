<div class="card bg-none card-box">
    {{ Form::model($interviewSchedule, ['route' => ['interview-schedule.update', $interviewSchedule->id], 'method' => 'PUT']) }}
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('candidate', __('Interviewer'), ['class' => 'form-control-label']) }}
            {{ Form::select('candidate', $candidates, null, ['class' => 'form-control select2', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('employee', __('Assign Employee'), ['class' => 'form-control-label']) }}
            {{ Form::select('employee', $employees, null, ['class' => 'form-control select2', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('date', __('Interview Date'), ['class' => 'form-control-label']) }}
            {{ Form::text('date', null, ['class' => 'form-control datepicker']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('time', __('Interview Time'), ['class' => 'form-control-label']) }}
            {{ Form::text('time', null, ['class' => 'form-control timepicker']) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('comment', __('Comment'), ['class' => 'form-control-label']) }}
            {{ Form::textarea('comment', null, ['class' => 'form-control']) }}
        </div>
        <div class="col-12 pt-5 text-right">
            <input type="submit" value="{{ __('Update') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

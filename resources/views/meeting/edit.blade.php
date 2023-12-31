<div class="card bg-none card-box">
    {{ Form::model($meeting, ['route' => ['meeting.update', $meeting->id], 'method' => 'PUT']) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('title', __('Meeting Title'), ['class' => 'form-control-label']) }}
                {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter Meeting Title')]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('date', __('Meeting Date'), ['class' => 'form-control-label']) }}
                {{ Form::text('date', null, ['class' => 'form-control datepicker']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('time', __('Meeting Time'), ['class' => 'form-control-label']) }}
                {{ Form::text('time', null, ['class' => 'form-control timepicker']) }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('note', __('Meeting Note'), ['class' => 'form-control-label']) }}
                {{ Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => __('Enter Meeting Note')]) }}
            </div>
        </div>
        <div class="col-12 pt-5 text-right">
            <input type="submit" value="{{ __('Update') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

<div class="card bg-none card-box">
    {{ Form::open(['url' => 'complaint', 'method' => 'post']) }}
    <div class="row">
        @if (\Auth::user()->type != 'employee')
            <div class="form-group col-md-6 col-lg-6 ">
                {{ Form::label('complaint_from', __('Complaint From'), ['class' => 'form-control-label']) }}
                {{ Form::select('complaint_from', $employees, null, ['class' => 'form-control  select2', 'required' => 'required']) }}
            </div>
        @endif
        <div class="form-group col-md-6 col-lg-6">
            {{ Form::label('complaint_against', __('Complaint Against'), ['class' => 'form-control-label']) }}
            {{ Form::select('complaint_against', $employees, null, ['class' => 'form-control select2']) }}
        </div>
        <div class="form-group col-md-6 col-lg-6">
            {{ Form::label('title', __('Title'), ['class' => 'form-control-label']) }}
            {{ Form::text('title', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group col-md-6 col-lg-6">
            {{ Form::label('complaint_date', __('Complaint Date'), ['class' => 'form-control-label']) }}
            {{ Form::text('complaint_date', null, ['class' => 'form-control datepicker']) }}
        </div>
        <div class="form-group col-md-12">
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

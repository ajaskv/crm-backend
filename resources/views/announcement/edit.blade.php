<div class="card bg-none card-box">
    {{ Form::model($announcement, ['route' => ['announcement.update', $announcement->id], 'method' => 'PUT']) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('title', __('Announcement Title'), ['class' => 'form-control-label']) }}
                {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter Announcement Title')]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('branch_id', __('Branch'), ['class' => 'form-control-label']) }}
                {{ Form::select('branch_id', $branch, null, ['class' => 'form-control select2']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('department_id', __('Department'), ['class' => 'form-control-label']) }}
                {{ Form::select('department_id', $departments, null, ['class' => 'form-control select2']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('start_date', __('Announcement start Date'), ['class' => 'form-control-label']) }}
                {{ Form::text('start_date', null, ['class' => 'form-control datepicker']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('end_date', __('Announcement End Date'), ['class' => 'form-control-label']) }}
                {{ Form::text('end_date', null, ['class' => 'form-control datepicker']) }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('description', __('Announcement Description'), ['class' => 'form-control-label']) }}
                {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Announcement Title')]) }}
            </div>
        </div>
        <div class="col-12 pt-5 text-right">
            <input type="submit" value="{{ __('Update') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

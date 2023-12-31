<div class="card bg-none card-box">
    {{ Form::open(['url' => 'project-task-new-stage']) }}
    <div class="row">
        <div class="form-group col-12">
            {{ Form::label('name', __('Project Task Stage Name'), ['class' => 'form-control-label']) }}
            {{ Form::text('name', '', ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="form-group col-12">
            {{ Form::label('color', __('Color'), ['class' => 'form-control-label']) }}
            <input class="jscolor form-control" value="FFFFFF" name="color" id="color" required>
            <small class="small">{{ __('For chart representation') }}</small>
        </div>
        <div class="col-12 text-right">
            <input type="submit" value="{{ __('Create') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

<div class="card bg-none card-box">
    {{ Form::open(['url' => 'pipelines']) }}
    <div class="row">
        <div class="form-group col-12">
            {{ Form::label('name', __('Pipeline Name'), ['class' => 'form-control-label']) }}
            {{ Form::text('name', '', ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-12 pt-5 text-right">
            <input type="submit" value="{{ __('Create') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

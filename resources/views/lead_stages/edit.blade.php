<div class="card bg-none card-box">
    {{ Form::model($leadStage, ['route' => ['lead_stages.update', $leadStage->id], 'method' => 'PUT']) }}
    <div class="row">
        <div class="form-group col-12">
            {{ Form::label('name', __('Stage Name'), ['class' => 'form-control-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="form-group col-12">
            {{ Form::label('pipeline_id', __('Pipeline'), ['class' => 'form-control-label']) }}
            {{ Form::select('pipeline_id', $pipelines, null, ['class' => 'form-control select2', 'required' => 'required']) }}
        </div>
        <div class="col-12 text-right">
            <input type="submit" value="{{ __('Update') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

<div class="card bg-none card-box">
    {{ Form::open(['url' => 'custom-question', 'method' => 'post']) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('question', __('Question'), ['class' => 'form-control-label']) }}
                {{ Form::text('question', null, ['class' => 'form-control', 'placeholder' => __('Enter question')]) }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('is_required', __('Is Required'), ['class' => 'form-control-label']) }}
                {{ Form::select('is_required', $is_required, null, ['class' => 'form-control select2', 'required' => 'required']) }}
            </div>
        </div>
        <div class="col-12 pt-5 text-right">
            <input type="submit" value="{{ __('Create') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

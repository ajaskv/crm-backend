<div class="card bg-none card-box">
    {{ Form::model($unit, ['route' => ['product-unit.update', $unit->id], 'method' => 'PUT']) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('name', __('Unit Name'), ['class' => 'form-control-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
            @error('name')
                <small class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </small>
            @enderror
        </div>
        <div class="col-12 pt-5 text-right">
            <input type="submit" value="{{ __('Update') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

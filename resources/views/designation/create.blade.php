<div class="card bg-none card-box">
    {{ Form::open(['url' => 'designation', 'method' => 'post']) }}
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {{ Form::label('department_id', __('Department'), ['class' => 'form-control-label']) }}
                {{ Form::select('department_id', $departments, null, ['class' => 'form-control select2', 'required' => 'required']) }}
            </div>
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-control-label']) }}
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Designation Name')]) }}
                @error('name')
                    <span class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-12 pt-5 text-right">
            <input type="submit" value="{{ __('Create') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

<div class="card bg-none card-box">
    {{ Form::open(['route' => ['test.send.mail']]) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('email', __('Email')) }}
            {{ Form::text('email', '', ['class' => 'form-control', 'required' => 'required']) }}
            @error('email')
                <span class="invalid-email" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <input type="submit" value="{{ __('Create') }}" class="btn-create badge-blue">
        <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
    </div>
    {{ Form::close() }}
</div>

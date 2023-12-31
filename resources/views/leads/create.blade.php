<div class="card bg-none card-box">
    {{ Form::open(['url' => 'leads']) }}
    <div class="row">
        <div class="col-6 form-group">
            {{ Form::label('subject', __('Subject'), ['class' => 'form-control-label']) }}
            {{ Form::text('subject', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('user_id', __('User'), ['class' => 'form-control-label']) }}
            {{ Form::select('user_id', $users, null, ['class' => 'form-control select2', 'required' => 'required']) }}
            @if (count($users) == 1)
                <div class="text-muted text-xs">
                    {{ __('Please create new users') }} <a
                        href="{{ route('users.index') }}">{{ __('here') }}</a>.
                </div>
            @endif
        </div>
        <div class="col-6 form-group">
            {{ Form::label('name', __('Name'), ['class' => 'form-control-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('email', __('Email'), ['class' => 'form-control-label']) }}
            {{ Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('phone', __('Phone'), ['class' => 'form-control-label']) }}
            {{ Form::text('phone', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        @if (!$customFields->isEmpty())
            <div class="col-md-6">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    @include('customFields.formBuilder')
                </div>
            </div>
        @endif
        <div class="col-12 text-right">
            <input type="submit" value="{{ __('Create') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

<div class="card bg-none card-box">
    {{ Form::model($plan, ['route' => ['plans.update', $plan->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('name', __('Name'), ['class' => 'form-control-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control font-style', 'placeholder' => __('Enter Plan Name'), 'required' => 'required']) }}
        </div>
        @if ($plan->price > 0)
            <div class="form-group col-md-6">
                {{ Form::label('price', __('Price'), ['class' => 'form-control-label']) }}
                {{ Form::number('price', null, ['class' => 'form-control', 'placeholder' => __('Enter Plan Price'), 'required' => 'required']) }}
            </div>
        @endif
        <div class="form-group col-md-6">
            {{ Form::label('duration', __('Duration'), ['class' => 'form-control-label']) }}
            {!! Form::select('duration', $arrDuration, null, ['class' => 'form-control select2', 'required' => 'required']) !!}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('max_users', __('Maximum Users'), ['class' => 'form-control-label']) }}
            {{ Form::number('max_users', null, ['class' => 'form-control', 'required' => 'required']) }}
            <span class="small">{{ __('Note: "-1" for Unlimited') }}</span>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('max_customers', __('Maximum Customers'), ['class' => 'form-control-label']) }}
            {{ Form::number('max_customers', null, ['class' => 'form-control', 'required' => 'required']) }}
            <span class="small">{{ __('Note: "-1" for Unlimited') }}</span>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('max_venders', __('Maximum Venders'), ['class' => 'form-control-label']) }}
            {{ Form::number('max_venders', null, ['class' => 'form-control', 'required' => 'required']) }}
            <span class="small">{{ __('Note: "-1" for Unlimited') }}</span>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('max_clients', __('Maximum Clients'), ['class' => 'form-control-label']) }}
            {{ Form::number('max_clients', null, ['class' => 'form-control', 'required' => 'required']) }}
            <span class="small">{{ __('Note: "-1" for Unlimited') }}</span>
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('description', __('Description'), ['class' => 'form-control-label']) }}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}
        </div>
        <div class="form-group col-md-3">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="enable_crm" id="enable_crm"
                    {{ $plan['crm'] == 1 ? 'checked="checked"' : '' }}>
                <label class="custom-control-label form-control-label" for="enable_crm">{{ __('CRM') }}</label>
            </div>
        </div>
        <div class="form-group col-md-3">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="enable_project" id="enable_project"
                    {{ $plan['project'] == 1 ? 'checked="checked"' : '' }}>
                <label class="custom-control-label form-control-label"
                    for="enable_project">{{ __('Project') }}</label>
            </div>
        </div>
        <div class="form-group col-md-3">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="enable_hrm" id="enable_hrm"
                    {{ $plan['hrm'] == 1 ? 'checked="checked"' : '' }}>
                <label class="custom-control-label form-control-label" for="enable_hrm">{{ __('HRM') }}</label>
            </div>
        </div>
        <div class="form-group col-md-3">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="enable_account" id="enable_account"
                    {{ $plan['account'] == 1 ? 'checked="checked"' : '' }}>
                <label class="custom-control-label form-control-label"
                    for="enable_account">{{ __('Account') }}</label>
            </div>
        </div>
        <div class="form-group col-md-12">
            <input type="submit" value="{{ __('Update') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

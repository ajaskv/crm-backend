<div class="card bg-none card-box">
    {{ Form::model($vender, ['route' => ['vender.update', $vender->id], 'method' => 'PUT']) }}
    <h5 class="sub-title">{{ __('Basic Information') }}</h5>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-control-label']) }}
                <div class="form-icon-user">
                    <span><i class="fas fa-address-card"></i></span>
                    {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                {{ Form::label('contact', __('Contact'), ['class' => 'form-control-label']) }}
                <div class="form-icon-user">
                    <span><i class="fas fa-mobile-alt"></i></span>
                    {{ Form::text('contact', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                {{ Form::label('email', __('Email'), ['class' => 'form-control-label']) }}
                <div class="form-icon-user">
                    <span><i class="fas fa-envelope"></i></span>
                    {{ Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                {{ Form::label('tax_number', __('Tax Number'), ['class' => 'form-control-label']) }}
                <div class="form-icon-user">
                    <span><i class="fas fa-crosshairs"></i></span>
                    {{ Form::text('tax_number', null, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>
        @if (!$customFields->isEmpty())
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    @include('customFields.formBuilder')
                </div>
            </div>
        @endif
    </div>
    <h5 class="sub-title">{{ __('BIlling Address') }}</h5>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                {{ Form::label('billing_name', __('Name'), ['class' => 'form-control-label']) }}
                <div class="form-icon-user">
                    <span><i class="fas fa-address-card"></i></span>
                    {{ Form::text('billing_name', null, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                {{ Form::label('billing_country', __('Country'), ['class' => 'form-control-label']) }}
                <div class="form-icon-user">
                    <span><i class="fas fa-flag"></i></span>
                    {{ Form::text('billing_country', null, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                {{ Form::label('billing_state', __('State'), ['class' => 'form-control-label']) }}
                <div class="form-icon-user">
                    <span><i class="fas fa-chess-pawn"></i></span>
                    {{ Form::text('billing_state', null, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                {{ Form::label('billing_city', __('City'), ['class' => 'form-control-label']) }}
                <div class="form-icon-user">
                    <span><i class="fas fa-city"></i></span>
                    {{ Form::text('billing_city', null, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                {{ Form::label('billing_phone', __('Phone'), ['class' => 'form-control-label']) }}
                <div class="form-icon-user">
                    <span><i class="fas fa-mobile-alt"></i></span>
                    {{ Form::text('billing_phone', null, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                {{ Form::label('billing_zip', __('Zip Code'), ['class' => 'form-control-label']) }}
                <div class="form-icon-user">
                    <span><i class="fas fa-crosshairs"></i></span>
                    {{ Form::text('billing_zip', null, ['class' => 'form-control']) }}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('billing_address', __('Address'), ['class' => 'form-control-label']) }}
                <div class="input-group">
                    {{ Form::textarea('billing_address', null, ['class' => 'form-control', 'rows' => 3]) }}
                </div>
            </div>
        </div>
    </div>

    @if (Utility::getValByName('shipping_display') == 'on')
        <div class="col-md-12 text-right">
            <input type="button" id="billing_data" value="{{ __('Shipping Same As Billing') }}"
                class="btn-create btn-xs badge-blue">
        </div>
        <h5 class="sub-title">{{ __('Shipping Address') }}</h5>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="form-group">
                    {{ Form::label('shipping_name', __('Name'), ['class' => 'form-control-label']) }}
                    <div class="form-icon-user">
                        <span><i class="fas fa-address-card"></i></span>
                        {{ Form::text('shipping_name', null, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="form-group">
                    {{ Form::label('shipping_country', __('Country'), ['class' => 'form-control-label']) }}
                    <div class="form-icon-user">
                        <span><i class="fas fa-flag"></i></span>
                        {{ Form::text('shipping_country', null, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="form-group">
                    {{ Form::label('shipping_state', __('State'), ['class' => 'form-control-label']) }}
                    <div class="form-icon-user">
                        <span><i class="fas fa-chess-pawn"></i></span>
                        {{ Form::text('shipping_state', null, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="form-group">
                    {{ Form::label('shipping_city', __('City'), ['class' => 'form-control-label']) }}
                    <div class="form-icon-user">
                        <span><i class="fas fa-city"></i></span>
                        {{ Form::text('shipping_city', null, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="form-group">
                    {{ Form::label('shipping_phone', __('Phone'), ['class' => 'form-control-label']) }}
                    <div class="form-icon-user">
                        <span><i class="fas fa-mobile-alt"></i></span>
                        {{ Form::text('shipping_phone', null, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="form-group">
                    {{ Form::label('shipping_zip', __('Zip Code'), ['class' => 'form-control-label']) }}
                    <div class="form-icon-user">
                        <span><i class="fas fa-crosshairs"></i></span>
                        {{ Form::text('shipping_zip', null, ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('shipping_address', __('Address'), ['class' => 'form-control-label']) }}
                    <div class="input-group">
                        {{ Form::textarea('shipping_address', null, ['class' => 'form-control', 'rows' => 3]) }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="col-12 pt-5 text-right">
        <input type="submit" value="{{ __('Update') }}" class="btn-create badge-blue">
        <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
    </div>

    {{ Form::close() }}
</div>

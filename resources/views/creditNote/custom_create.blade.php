<div class="card bg-none card-box">
    {{ Form::open(['route' => ['invoice.custom.credit.note'], 'mothod' => 'post']) }}
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                {{ Form::label('invoice', __('Invoice'), ['class' => 'form-control-label']) }}
                <select class="form-control select2" required="required" id="invoice" name="invoice">
                    <option value="0">{{ __('Select Invoice') }}</option>
                    @foreach ($invoices as $key => $invoice)
                        <option value="{{ $key }}">{{ \Auth::user()->invoiceNumberFormat($invoice) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('amount', __('Amount'), ['class' => 'form-control-label']) }}
            <div class="form-icon-user">
                <span><i class="fas fa-money-bill-alt"></i></span>
                {{ Form::number('amount', null, ['class' => 'form-control', 'required' => 'required', 'step' => '0.01']) }}
            </div>
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('date', __('Date'), ['class' => 'form-control-label']) }}
            <div class="form-icon-user">
                <span><i class="fas fa-money-bill-alt"></i></span>
                {{ Form::text('date', '', ['class' => 'form-control datepicker']) }}
            </div>
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('description', __('Description'), ['class' => 'form-control-label']) }}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}
        </div>
        <div class="col-md-12">
            <input type="submit" value="{{ __('Create') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

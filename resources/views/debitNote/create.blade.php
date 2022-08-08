<div class="card bg-none card-box">
    {{ Form::open(['route' => ['bill.debit.note', $bill_id], 'mothod' => 'post']) }}
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('date', __('Date'), ['class' => 'form-control-label']) }}
            <div class="form-icon-user">
                <span><i class="fas fa-money-bill-alt"></i></span>
                {{ Form::text('date', '', ['class' => 'form-control datepicker']) }}
            </div>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Amount'), ['class' => 'form-control-label']) }}
            <div class="form-icon-user">
                <span><i class="fas fa-money-bill-alt"></i></span>
                {{ Form::number('amount', !empty($billDue) ? $billDue->getDue() : 0, ['class' => 'form-control', 'required' => 'required', 'step' => '0.01']) }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="input-group">
                {{ Form::label('account', __('Account'), ['class' => 'form-control-label']) }}
                <select class="form-control select2" required="required" id="account" name="account">
                    <option value="0">{{ __('Select Bill') }}</option>
                    @foreach ($products as $key => $product)
                        <option value="{{  $product['product']->expense_account_id }}">{{ $product['product']->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('description', __('Description'), ['class' => 'form-control-label']) }}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}
        </div>
        <div class="col-md-12">
            <input type="submit" value="{{ __('Add') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

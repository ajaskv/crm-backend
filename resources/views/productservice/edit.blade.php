<div class="card bg-none card-box">
    {{ Form::model($productService, ['route' => ['productservice.update', $productService->id], 'method' => 'PUT']) }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('name', __('Name'), ['class' => 'form-control-label']) }}<span
                    class="text-danger">*</span>
                <div class="form-icon-user">
                    <span><i class="fas fa-address-card"></i></span>
                    {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('sku', __('SKU'), ['class' => 'form-control-label']) }}<span
                    class="text-danger">*</span>
                <div class="form-icon-user">
                    <span><i class="fas fa-key"></i></span>
                    {{ Form::text('sku', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
            </div>
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('description', __('Description'), ['class' => 'form-control-label']) }}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('sale_price', __('Sale Price'), ['class' => 'form-control-label']) }}<span
                    class="text-danger">*</span>
                <div class="form-icon-user">
                    <span><i class="fas fa-money-bill-alt"></i></span>
                    {{ Form::number('sale_price', null, ['class' => 'form-control', 'required' => 'required', 'step' => '0.01']) }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('purchase_price', __('Purchase Price'), ['class' => 'form-control-label']) }}<span
                    class="text-danger">*</span>
                <div class="form-icon-user">
                    <span><i class="fas fa-money-bill-alt"></i></span>
                    {{ Form::number('purchase_price', null, ['class' => 'form-control', 'required' => 'required', 'step' => '0.01']) }}
                </div>
            </div>
        </div>

        <div class="form-group  col-md-6">
            {{ Form::label('tax_id', __('Tax'), ['class' => 'form-control-label']) }}
            {{ Form::select('tax_id[]', $tax, null, ['class' => 'form-control select2', 'multiple' => '']) }}

        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('category_id', __('Category'), ['class' => 'form-control-label']) }}<span
                class="text-danger">*</span>
            {{ Form::select('category_id', $category, null, ['class' => 'form-control select2', 'required' => 'required']) }}
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('unit_id', __('Unit'), ['class' => 'form-control-label']) }}<span
                class="text-danger">*</span>
            {{ Form::select('unit_id', $unit, null, ['class' => 'form-control select2', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('quantity', __('Quantity'), ['class' => 'form-control-label']) }}<span
                class="text-danger">*</span>
            {{ Form::text('quantity', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="d-block form-control-label">{{ __('Type') }}</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input product" id="customRadio5" name="type"
                                value="product" @if ($productService->type == 'product') checked @endif
                                onclick="hide_show(this)">
                            <label class="custom-control-label form-control-label"
                                for="customRadio5">{{ __('Product') }}</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input product" id="customRadio6" name="type"
                                value="service" @if ($productService->type == 'service') checked @endif
                                onclick="hide_show(this)">
                            <label class="custom-control-label form-control-label"
                                for="customRadio6">{{ __('Service') }}</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input product" id="customRadio7" name="type"
                                value="expense" @if ($productService->type == 'expense') checked @endif
                                onclick="hide_show(this)">
                            <label class="custom-control-label form-control-label"
                                for="customRadio7">{{ __('Expense') }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6" id="expense_account_div">
            {{ Form::label('expense_account_id', __('Account'), ['class' => 'form-control-label']) }}<span
                class="text-danger">*</span>
            {{ Form::select('expense_account_id', $expenseAccounts, null, ['class' => 'form-control select2']) }}
        </div>
        @if (!$customFields->isEmpty())
            <div class="col-md-6">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    @include('customFields.formBuilder')
                </div>
            </div>
        @endif
        <div class="col-12 pt-5 text-right">
            <input type="submit" value="{{ __('Update') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
@if ($productService->type != 'expense')
    <script>
        $('#expense_account_div').hide();
    </script>
@endif
<script>
    $('input[type=radio][name=type]').change(function() {
        if (this.value == 'expense') {
            $('#expense_account_div').show();
        } else {
            $('#expense_account_div').hide();
        }
    })
</script>

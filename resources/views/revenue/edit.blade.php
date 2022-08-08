<div class="card bg-none card-box">
    {{ Form::model($revenue, ['route' => ['revenue.update', $revenue->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
    <div class="row">
        <div class="form-group  col-md-6">
            {{ Form::label('date', __('Date'), ['class' => 'form-control-label']) }}
            <div class="form-icon-user">
                <span><i class="fas fa-calendar"></i></span>
                {{ Form::text('date', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
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
            <div class="input-group">
                {{ Form::label('account_id', __('Account'), ['class' => 'form-control-label']) }}
                {{ Form::select('account_id', $accounts, null, ['class' => 'form-control select2', 'required' => 'required']) }}
            </div>
        </div>
        <div class="form-group  col-md-6">
            <div class="input-group">
                {{ Form::label('customer_id', __('Customer'), ['class' => 'form-control-label']) }}
                {{ Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'required' => 'required']) }}
            </div>
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('description', __('Description'), ['class' => 'form-control-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) }}
        </div>
        <div class="form-group  col-md-6">
            <div class="input-group">
                {{ Form::label('category_id', __('Category'), ['class' => 'form-control-label']) }}
                {{ Form::select('category_id', $categories, null, ['class' => 'form-control select2', 'required' => 'required']) }}
            </div>
        </div>

        <div class="form-group  col-md-6">
            {{ Form::label('reference', __('Reference'), ['class' => 'form-control-label']) }}
            <div class="form-icon-user">
                <span><i class="fas fa-sticky-note"></i></span>
                {{ Form::text('reference', null, ['class' => 'form-control']) }}
            </div>
        </div>
        @if(!is_null($revenue->cheque))
        <div class="form-group col-md-6">
            <div class="custom-control custom-checkbox mt-4">
                <input class="custom-control-input" type="checkbox" name="cheque" id="cheque" @if($revenue->cheque  > 0) checked @endif>
                <label class="custom-control-label form-control-label" for="cheque">{{ __('Cheque') }}</label>
            </div>
        </div>
        <div class="form-group col-md-6 cheque-data">
            {{ Form::label('cheque_no', __('Cheque No'), ['class' => 'form-control-label']) }}
            <div class="form-icon-user">
                {{-- <span><i class="fas fa-sticky-note"></i></span> --}}
                {{ Form::text('cheque_no', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group col-md-6 cheque-data">
            {{ Form::label('cheque_date', __('Cheque Date'), ['class' => 'form-control-label']) }}
            <div class="form-icon-user">
                {{-- <span><i class="fas fa-sticky-note"></i></span> --}}
                {{ Form::date('cheque_date', null, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group col-md-6 cheque-data">
            {{ Form::label('cheque_bank', __('Cheque Bank'), ['class' => 'form-control-label']) }}
            <div class="form-icon-user">
                {{-- <span><i class="fas fa-sticky-note"></i></span> --}}
                {{ Form::text('cheque_bank', null, ['class' => 'form-control']) }}
            </div>
        </div>
        @endif
        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                {{ Form::label('add_receipt', __('Payment Receipt'), ['class' => 'form-control-label']) }}
                <input type="file" name="add_receipt" id="image" class="custom-input-file"
                    accept="image/*, .txt, .rar, .zip">
                <label for="image">
                    <i class="fa fa-upload"></i>
                    <span>Choose a file…</span>
                </label>
            </div>
        </div>

        <div class="col-md-12">
            <input type="submit" value="{{ __('Update') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
<script>
    if (document.getElementById('cheque').checked) {
        $('.cheque-data').show();
    }else{
        $('.cheque-data').hide();
    }
    $('#cheque').change(function() {
        if (document.getElementById('cheque').checked) {
            $('.cheque-data').show();
        } else {
            $('.cheque-data').hide();
        }
    })
</script>
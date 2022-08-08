<div class="card bg-none card-box">
    {{ Form::open(['route' => ['invoice.payment', $invoice->id], 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
    <div class="row">
        <div class="form-group  col-md-6">
            {{ Form::label('date', __('Date')) }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fas fa-calendar"></i>
                    </div>
                </div>
                {{ Form::text('date', '', ['class' => 'form-control datepicker', 'required' => 'required']) }}
            </div>
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('amount', __('Amount')) }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="far fa-money-bill-alt"></i>
                    </div>
                </div>
                {{ Form::text('amount', $invoice->getDue(), ['class' => 'form-control', 'required' => 'required']) }}
            </div>
        </div>
        <div class="form-group  col-md-6">
            <div class="input-group">
                {{ Form::label('account_id', __('Account')) }}
                {{ Form::select('account_id', $accounts, null, ['class' => 'form-control select2', 'required' => 'required']) }}
            </div>
        </div>

        <div class="form-group  col-md-6">
            {{ Form::label('reference', __('Reference')) }}
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="far fa-sticky-note"></i>
                    </div>
                </div>
                {{ Form::text('reference', '', ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="custom-control custom-checkbox mt-4">
                <input class="custom-control-input" type="checkbox" name="cheque"
                    id="cheque">
                <label class="custom-control-label form-control-label"
                    for="cheque">{{ __('Cheque') }}</label>
            </div>
        </div>
        <div class="form-group col-md-6 cheque-data">
            {{ Form::label('cheque_no', __('Cheque No'), ['class' => 'form-control-label']) }}
            <div class="form-icon-user">
                {{-- <span><i class="fas fa-sticky-note"></i></span> --}}
                {{ Form::text('cheque_no', '', ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group col-md-6 cheque-data">
            {{ Form::label('cheque_date', __('Cheque Date'), ['class' => 'form-control-label']) }}
            <div class="form-icon-user">
                {{-- <span><i class="fas fa-sticky-note"></i></span> --}}
                {{ Form::date('cheque_date', '', ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group col-md-6 cheque-data">
            {{ Form::label('cheque_bank', __('Cheque Bank'), ['class' => 'form-control-label']) }}
            <div class="form-icon-user">
                {{-- <span><i class="fas fa-sticky-note"></i></span> --}}
                {{ Form::text('cheque_bank', '', ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('description', __('Description')) }}
            {{ Form::textarea('description', '', ['class' => 'form-control', 'rows' => 3]) }}
        </div>

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
        <div class="col-md-12 px-0">
            <input type="submit" value="{{ __('Add') }}" class="btn-create badge-blue">
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
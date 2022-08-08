<div class="card bg-none card-box">
    {{ Form::model($lead, ['route' => ['leads.products.update', $lead->id], 'method' => 'PUT']) }}
    <div class="row">
        <div class="col-12 form-group">
            {{ Form::label('products', __('Products'), ['class' => 'form-control-label']) }}
            {{ Form::select('products[]', $products, false, ['class' => 'form-control select2', 'multiple' => '', 'required' => 'required']) }}
        </div>
        <div class="col-12 form-group text-right">
            <input type="submit" value="{{ __('Save') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

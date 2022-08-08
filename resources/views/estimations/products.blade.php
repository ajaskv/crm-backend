<div class="card bg-none card-box">
    @if (isset($product))
        {{ Form::model($product, ['route' => ['estimations.products.update', $estimation->id, $product->id], 'method' => 'PUT']) }}
    @else
        {{ Form::model($estimation, ['route' => ['estimations.products.store', $estimation->id], 'method' => 'POST']) }}
    @endif
    <div class="row">
        <div class="col-6 form-group">
            {{ Form::label('product_id', __('Product'), ['class' => 'form-control-label']) }}
            {{ Form::select('product_id', $products, null, ['class' => 'form-control select2', 'required' => 'required']) }}
        </div>
        <div class="col-6 form-group">
            {{ Form::label('quantity', __('Quantity'), ['class' => 'form-control-label']) }}
            {{ Form::number('quantity', isset($product) ? null : 1, ['class' => 'form-control', 'required' => 'required', 'min' => '1']) }}
        </div>
        <div class="col-12 form-group">
            {{ Form::label('description', __('Description'), ['class' => 'form-control-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group col-md-12 text-right">
            @if (isset($product))
                <input type="submit" value="{{ __('Update') }}" class="btn-create badge-blue">
            @else
                <input type="submit" value="{{ __('Add') }}" class="btn-create badge-blue">
            @endif
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

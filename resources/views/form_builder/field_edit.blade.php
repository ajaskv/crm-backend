<div class="card bg-none card-box">
    {{ Form::model($form_field, ['route' => ['form.field.update', $form->id, $form_field->id], 'method' => 'post']) }}
    <div class="row" id="frm_field_data">
        <div class="col-12 form-group">
            {{ Form::label('name', __('Question Name'), ['class' => 'form-control-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
        <div class="col-12 form-group">
            {{ Form::label('type', __('Type'), ['class' => 'form-control-label']) }}
            {{ Form::select('type', $types, null, ['class' => 'form-control', 'data-toggle' => 'select', 'required' => 'required']) }}
        </div>
        <div class="col-12 pt-5 text-right">
            <input type="submit" value="{{ __('Update') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

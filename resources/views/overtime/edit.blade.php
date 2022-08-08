<div class="card bg-none card-box">
    {{ Form::model($overtime, ['route' => ['overtime.update', $overtime->id], 'method' => 'PUT']) }}
    <div class="card-body p-0">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('title', __('Title')) }}
                    {{ Form::text('title', null, ['class' => 'form-control ', 'required' => 'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('number_of_days', __('Number Of Days')) }}
                    {{ Form::text('number_of_days', null, ['class' => 'form-control ', 'required' => 'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('hours', __('Hours')) }}
                    {{ Form::text('hours', null, ['class' => 'form-control ', 'required' => 'required']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('rate', __('Rate')) }}
                    {{ Form::number('rate', null, ['class' => 'form-control ', 'required' => 'required']) }}
                </div>
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{ __('Update') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}

</div>

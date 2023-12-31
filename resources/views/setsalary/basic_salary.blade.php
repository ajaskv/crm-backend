<div class="card bg-none card-box">
    {{ Form::model($employee, ['route' => ['employee.salary.update', $employee->id], 'method' => 'POST']) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('salary_type', __('Payslip Type'), ['class' => 'form-control-label']) }}<span
                class="text-danger">*</span>
            {{ Form::select('salary_type', $payslip_type, null, ['class' => 'form-control select2', 'required' => 'required']) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('salary', __('Salary'), ['class' => 'form-control-label']) }}
            {{ Form::number('salary', null, ['class' => 'form-control ', 'required' => 'required']) }}
        </div>
        <div class="col-12">
            <input type="submit" value="{{ __('Save Change') }}" class="btn-create badge-blue">
            <input type="button" value="{{ __('Cancel') }}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>

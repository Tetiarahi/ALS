@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.employee.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.employees.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.employee.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="surmane">{{ trans('cruds.employee.fields.surmane') }}</label>
                            <input class="form-control" type="text" name="surmane" id="surmane" value="{{ old('surmane', '') }}" required>
                            @if($errors->has('surmane'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('surmane') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.surmane_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="dob">{{ trans('cruds.employee.fields.dob') }}</label>
                            <input class="form-control date" type="text" name="dob" id="dob" value="{{ old('dob') }}" required>
                            @if($errors->has('dob'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('dob') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.dob_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.employee.fields.status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Employee::STATUS_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.status_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="emp_qua_id">{{ trans('cruds.employee.fields.emp_qua') }}</label>
                            <select class="form-control select2" name="emp_qua_id" id="emp_qua_id" required>
                                @foreach($emp_quas as $id => $entry)
                                    <option value="{{ $id }}" {{ old('emp_qua_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('emp_qua'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('emp_qua') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.emp_qua_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="workstatus_id">{{ trans('cruds.employee.fields.workstatus') }}</label>
                            <select class="form-control select2" name="workstatus_id" id="workstatus_id" required>
                                @foreach($workstatuses as $id => $entry)
                                    <option value="{{ $id }}" {{ old('workstatus_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('workstatus'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('workstatus') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.employee.fields.workstatus_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
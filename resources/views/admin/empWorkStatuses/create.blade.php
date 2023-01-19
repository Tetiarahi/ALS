@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.empWorkStatus.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.emp-work-statuses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="work_status">{{ trans('cruds.empWorkStatus.fields.work_status') }}</label>
                <input class="form-control {{ $errors->has('work_status') ? 'is-invalid' : '' }}" type="text" name="work_status" id="work_status" value="{{ old('work_status', '') }}" required>
                @if($errors->has('work_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('work_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.empWorkStatus.fields.work_status_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
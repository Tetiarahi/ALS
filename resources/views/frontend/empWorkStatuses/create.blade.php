@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.empWorkStatus.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.emp-work-statuses.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="work_status">{{ trans('cruds.empWorkStatus.fields.work_status') }}</label>
                            <input class="form-control" type="text" name="work_status" id="work_status" value="{{ old('work_status', '') }}" required>
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

        </div>
    </div>
</div>
@endsection
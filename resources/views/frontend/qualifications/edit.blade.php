@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.qualification.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.qualifications.update", [$qualification->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="qua_name">{{ trans('cruds.qualification.fields.qua_name') }}</label>
                            <input class="form-control" type="text" name="qua_name" id="qua_name" value="{{ old('qua_name', $qualification->qua_name) }}" required>
                            @if($errors->has('qua_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('qua_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.qualification.fields.qua_name_helper') }}</span>
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
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.spa.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.spas.update", [$spa->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="emp_name_id">{{ trans('cruds.spa.fields.emp_name') }}</label>
                <select class="form-control select2 {{ $errors->has('emp_name') ? 'is-invalid' : '' }}" name="emp_name_id" id="emp_name_id" required>
                    @foreach($emp_names as $id => $entry)
                        <option value="{{ $id }}" {{ (old('emp_name_id') ? old('emp_name_id') : $spa->emp_name->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('emp_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('emp_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.spa.fields.emp_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="spa_file">{{ trans('cruds.spa.fields.spa_file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('spa_file') ? 'is-invalid' : '' }}" id="spa_file-dropzone">
                </div>
                @if($errors->has('spa_file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('spa_file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.spa.fields.spa_file_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedSpaFileMap = {}
Dropzone.options.spaFileDropzone = {
    url: '{{ route('admin.spas.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="spa_file[]" value="' + response.name + '">')
      uploadedSpaFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedSpaFileMap[file.name]
      }
      $('form').find('input[name="spa_file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($spa) && $spa->spa_file)
          var files =
            {!! json_encode($spa->spa_file) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="spa_file[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection
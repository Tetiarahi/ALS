<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySpaRequest;
use App\Http\Requests\StoreSpaRequest;
use App\Http\Requests\UpdateSpaRequest;
use App\Models\Employee;
use App\Models\Spa;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SpaController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('spa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $spas = Spa::with(['emp_name', 'media'])->get();

        return view('admin.spas.index', compact('spas'));
    }

    public function create()
    {
        abort_if(Gate::denies('spa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emp_names = Employee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.spas.create', compact('emp_names'));
    }

    public function store(StoreSpaRequest $request)
    {
        $spa = Spa::create($request->all());

        foreach ($request->input('spa_file', []) as $file) {
            $spa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('spa_file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $spa->id]);
        }

        return redirect()->route('admin.spas.index');
    }

    public function edit(Spa $spa)
    {
        abort_if(Gate::denies('spa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emp_names = Employee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $spa->load('emp_name');

        return view('admin.spas.edit', compact('emp_names', 'spa'));
    }

    public function update(UpdateSpaRequest $request, Spa $spa)
    {
        $spa->update($request->all());

        if (count($spa->spa_file) > 0) {
            foreach ($spa->spa_file as $media) {
                if (!in_array($media->file_name, $request->input('spa_file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $spa->spa_file->pluck('file_name')->toArray();
        foreach ($request->input('spa_file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $spa->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('spa_file');
            }
        }

        return redirect()->route('admin.spas.index');
    }

    public function show(Spa $spa)
    {
        abort_if(Gate::denies('spa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $spa->load('emp_name');

        return view('admin.spas.show', compact('spa'));
    }

    public function destroy(Spa $spa)
    {
        abort_if(Gate::denies('spa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $spa->delete();

        return back();
    }

    public function massDestroy(MassDestroySpaRequest $request)
    {
        Spa::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('spa_create') && Gate::denies('spa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Spa();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

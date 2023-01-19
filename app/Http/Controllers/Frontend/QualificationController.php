<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyQualificationRequest;
use App\Http\Requests\StoreQualificationRequest;
use App\Http\Requests\UpdateQualificationRequest;
use App\Models\Qualification;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QualificationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('qualification_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qualifications = Qualification::all();

        return view('frontend.qualifications.index', compact('qualifications'));
    }

    public function create()
    {
        abort_if(Gate::denies('qualification_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.qualifications.create');
    }

    public function store(StoreQualificationRequest $request)
    {
        $qualification = Qualification::create($request->all());

        return redirect()->route('frontend.qualifications.index');
    }

    public function edit(Qualification $qualification)
    {
        abort_if(Gate::denies('qualification_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.qualifications.edit', compact('qualification'));
    }

    public function update(UpdateQualificationRequest $request, Qualification $qualification)
    {
        $qualification->update($request->all());

        return redirect()->route('frontend.qualifications.index');
    }

    public function show(Qualification $qualification)
    {
        abort_if(Gate::denies('qualification_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.qualifications.show', compact('qualification'));
    }

    public function destroy(Qualification $qualification)
    {
        abort_if(Gate::denies('qualification_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $qualification->delete();

        return back();
    }

    public function massDestroy(MassDestroyQualificationRequest $request)
    {
        Qualification::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

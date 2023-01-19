<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEmpWorkStatusRequest;
use App\Http\Requests\StoreEmpWorkStatusRequest;
use App\Http\Requests\UpdateEmpWorkStatusRequest;
use App\Models\EmpWorkStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmpWorkStatusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('emp_work_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empWorkStatuses = EmpWorkStatus::all();

        return view('admin.empWorkStatuses.index', compact('empWorkStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('emp_work_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.empWorkStatuses.create');
    }

    public function store(StoreEmpWorkStatusRequest $request)
    {
        $empWorkStatus = EmpWorkStatus::create($request->all());

        return redirect()->route('admin.emp-work-statuses.index');
    }

    public function edit(EmpWorkStatus $empWorkStatus)
    {
        abort_if(Gate::denies('emp_work_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.empWorkStatuses.edit', compact('empWorkStatus'));
    }

    public function update(UpdateEmpWorkStatusRequest $request, EmpWorkStatus $empWorkStatus)
    {
        $empWorkStatus->update($request->all());

        return redirect()->route('admin.emp-work-statuses.index');
    }

    public function show(EmpWorkStatus $empWorkStatus)
    {
        abort_if(Gate::denies('emp_work_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.empWorkStatuses.show', compact('empWorkStatus'));
    }

    public function destroy(EmpWorkStatus $empWorkStatus)
    {
        abort_if(Gate::denies('emp_work_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empWorkStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmpWorkStatusRequest $request)
    {
        EmpWorkStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

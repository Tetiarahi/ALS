<?php

namespace App\Http\Requests;

use App\Models\EmpWorkStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEmpWorkStatusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('emp_work_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:emp_work_statuses,id',
        ];
    }
}

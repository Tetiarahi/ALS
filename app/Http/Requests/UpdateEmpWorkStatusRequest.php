<?php

namespace App\Http\Requests;

use App\Models\EmpWorkStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmpWorkStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('emp_work_status_edit');
    }

    public function rules()
    {
        return [
            'work_status' => [
                'string',
                'required',
            ],
        ];
    }
}

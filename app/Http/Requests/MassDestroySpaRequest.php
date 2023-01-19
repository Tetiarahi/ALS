<?php

namespace App\Http\Requests;

use App\Models\Spa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySpaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('spa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:spas,id',
        ];
    }
}

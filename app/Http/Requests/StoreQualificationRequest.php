<?php

namespace App\Http\Requests;

use App\Models\Qualification;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreQualificationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('qualification_create');
    }

    public function rules()
    {
        return [
            'qua_name' => [
                'string',
                'required',
            ],
        ];
    }
}

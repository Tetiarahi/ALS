<?php

namespace App\Http\Requests;

use App\Models\Spa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSpaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('spa_create');
    }

    public function rules()
    {
        return [
            'emp_name_id' => [
                'required',
                'integer',
            ],
            'spa_file' => [
                'array',
                'required',
            ],
            'spa_file.*' => [
                'required',
            ],
        ];
    }
}

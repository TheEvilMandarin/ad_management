<?php

namespace App\Http\ApiV1\Modules\Categories\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class CreateCategoryRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'category_name' => ['required', 'string', 'unique:categories,category_name'],
        ];
    }
}

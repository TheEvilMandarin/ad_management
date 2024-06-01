<?php

namespace App\Http\ApiV1\Modules\Advertisements\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class UpdateAdvertisementRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string'],
            'description' => ['sometimes', 'string'],
            'price' => ['sometimes', 'numeric'],
            'category_id' => ['sometimes', 'exists:categories,id'],
            'status' => ['sometimes', 'string'],
        ];
    }
}

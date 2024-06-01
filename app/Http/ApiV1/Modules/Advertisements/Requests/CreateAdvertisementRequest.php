<?php

namespace App\Http\ApiV1\Modules\Advertisements\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class CreateAdvertisementRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'category_id' => ['required', 'exists:categories,id'],
//            'user_id' => ['required', 'exists:users,id'],
//            'status' => ['required', 'string'],
        ];
    }
}

<?php

namespace App\Http\ApiV1\Modules\Favorites\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class CreateFavoriteRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            // 'user_id' => ['required', 'exists:users,id'],
            'ad_id' => ['required', 'exists:advertisements,id'],
        ];
    }
}

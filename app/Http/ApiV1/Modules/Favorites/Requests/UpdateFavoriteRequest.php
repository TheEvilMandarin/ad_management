<?php

namespace App\Http\ApiV1\Modules\Favorites\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class UpdateFavoriteRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['sometimes', 'exists:users,id'],
            'ad_id' => ['sometimes', 'exists:advertisements,id'],
        ];
    }
}

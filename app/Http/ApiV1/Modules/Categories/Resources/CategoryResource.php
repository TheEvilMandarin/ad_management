<?php

namespace App\Http\ApiV1\Modules\Categories\Resources;

use App\Domain\AdManagement\Models\Category;
use App\Http\ApiV1\Support\Resources\BaseJsonResource;

/**
 * @mixin Category
 */
class CategoryResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'category_name' => $this->category_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

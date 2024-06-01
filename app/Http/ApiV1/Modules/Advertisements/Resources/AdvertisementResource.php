<?php

namespace App\Http\ApiV1\Modules\Advertisements\Resources;

use App\Domain\AdManagement\Models\Advertisement;
use App\Http\ApiV1\Support\Resources\BaseJsonResource;

/**
 * @mixin Advertisement
 */
class AdvertisementResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

<?php

namespace App\Http\ApiV1\Modules\Favorites\Resources;

use App\Domain\AdManagement\Models\Favorite;
use App\Http\ApiV1\Support\Resources\BaseJsonResource;

/**
 * @mixin Favorite
 */
class FavoriteResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'ad_id' => $this->ad_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

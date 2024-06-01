<?php

namespace App\Http\ApiV1\Modules\Favorites\Queries;

use App\Domain\AdManagement\Models\Favorite;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FavoriteQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Favorite::query());
        $this->allowedSorts(['id', 'created_at', 'updated_at']);
        $this->allowedFilters(['user_id', 'ad_id']);
    }

    public static function allWithFilters($request)
    {
        return self::for(Favorite::class)
            ->allowedSorts(['id', 'created_at', 'updated_at'])
            ->allowedFilters([
                'user_id',
                'ad_id',
            ])
            ->get();
    }
}

<?php

namespace App\Http\ApiV1\Modules\Advertisements\Queries;

use App\Domain\AdManagement\Models\Advertisement;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdvertisementQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(Advertisement::query());
        $this->allowedSorts(['id', 'created_at', 'updated_at', 'price', 'status']);
        $this->allowedFilters(['title', 'description', 'price', AllowedFilter::exact('category_id'), 'user_id', 'status']);
    }

    public static function allWithFilters($request)
    {
        return self::for(Advertisement::class)
            ->allowedSorts(['id', 'created_at', 'updated_at', 'price', 'status'])
            ->allowedFilters([
                'title',
                'description',
                'price',
                AllowedFilter::exact('category_id'),
                'user_id',
                'status',
            ])
            ->get();
    }

}

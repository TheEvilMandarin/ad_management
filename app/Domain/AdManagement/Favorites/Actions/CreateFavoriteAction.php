<?php

namespace App\Domain\AdManagement\Favorites\Actions;

use App\Domain\AdManagement\Models\Favorite;

class CreateFavoriteAction
{
    public function execute(array $fields): Favorite
    {
        return Favorite::create($fields);
    }
}

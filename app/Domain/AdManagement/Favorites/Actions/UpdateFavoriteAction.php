<?php

namespace App\Domain\AdManagement\Favorites\Actions;

use App\Domain\AdManagement\Models\Favorite;

class UpdateFavoriteAction
{
    public function execute(Favorite $favorite, array $fields): Favorite
    {
        $favorite->update($fields);
        return $favorite;
    }
}

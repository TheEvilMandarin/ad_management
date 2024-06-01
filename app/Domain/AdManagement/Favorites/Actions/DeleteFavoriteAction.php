<?php

namespace App\Domain\AdManagement\Favorites\Actions;

use App\Domain\AdManagement\Models\Favorite;

class DeleteFavoriteAction
{
    public function execute(Favorite $favorite): void
    {
        $favorite->delete();
    }
}

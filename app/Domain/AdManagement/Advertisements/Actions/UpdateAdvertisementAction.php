<?php

namespace App\Domain\AdManagement\Advertisements\Actions;

use App\Domain\AdManagement\Models\Advertisement;

class UpdateAdvertisementAction
{
    public function execute(Advertisement $advertisement, array $fields): Advertisement
    {
        $advertisement->update($fields);
        return $advertisement;
    }
}

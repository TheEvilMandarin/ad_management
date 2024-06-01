<?php

namespace App\Domain\AdManagement\Advertisements\Actions;

use App\Domain\AdManagement\Models\Advertisement;

class DeleteAdvertisementAction
{
    public function execute(Advertisement $advertisement): void
    {
        $advertisement->delete();
    }
}

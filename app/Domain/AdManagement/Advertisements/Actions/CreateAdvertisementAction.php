<?php

namespace App\Domain\AdManagement\Advertisements\Actions;

use App\Domain\AdManagement\Models\Advertisement;

class CreateAdvertisementAction
{
    public function execute(array $fields): Advertisement
    {
        // Установка статуса по умолчанию
        $fields['status'] = 'active';
        // Установка текущей даты и времени для поля date_posted
        $fields['date_posted'] = now();
        $advertisement = new Advertisement();
        $advertisement->fill($fields);
        $advertisement->save();

        return $advertisement;
    }
}

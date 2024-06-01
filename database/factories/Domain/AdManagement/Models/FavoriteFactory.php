<?php

namespace Database\Factories\Domain\AdManagement\Models;

use App\Domain\AdManagement\Models\Favorite;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    // Указываем соответствующую модель для фабрики
    protected $model = Favorite::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100), // Генерация случайного user_id
            'ad_id' => $this->faker->numberBetween(1, 100),   // Генерация случайного ad_id
        ];
    }
}

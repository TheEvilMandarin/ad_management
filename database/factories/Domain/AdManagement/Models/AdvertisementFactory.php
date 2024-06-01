<?php

namespace Database\Factories\Domain\AdManagement\Models;

use App\Domain\AdManagement\Models\Advertisement;
use App\Domain\AdManagement\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertisementFactory extends Factory
{
    protected $model = Advertisement::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->numberBetween(100, 10000),
            'category_id' => Category::factory(),
            'user_id' => 1, // Фиктивный ID пользователя
            'status' => 'active',
            'date_posted' => now(),
        ];
    }
}

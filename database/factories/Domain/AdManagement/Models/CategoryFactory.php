<?php

namespace Database\Factories\Domain\AdManagement\Models;

use App\Domain\AdManagement\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'category_name' => $this->faker->word,
        ];
    }
}

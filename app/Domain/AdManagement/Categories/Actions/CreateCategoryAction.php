<?php

namespace App\Domain\AdManagement\Categories\Actions;

use App\Domain\AdManagement\Models\Category;

class CreateCategoryAction
{
    public function execute(array $fields): Category
    {
        $category = new Category();
        $category->fill($fields);
        $category->save();

        return $category;
    }
}

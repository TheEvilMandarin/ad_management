<?php

namespace App\Domain\AdManagement\Categories\Actions;

use App\Domain\AdManagement\Models\Category;

class UpdateCategoryAction
{
    public function execute(Category $category, array $fields): Category
    {
        $category->update($fields);
        return $category;
    }
}

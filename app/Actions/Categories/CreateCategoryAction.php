<?php

namespace App\Actions\Categories;

use App\Models\Category;

class CreateCategoryAction
{
    public function execute(array $data): Category
    {
        // Validate and create a new Category
        // TODO: Add your validation and creation logic here

        return Category::create($data);
    }
}

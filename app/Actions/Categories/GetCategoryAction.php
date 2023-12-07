<?php

    namespace App\Actions\Categories;

use App\Models\Category;

class GetCategoryAction
{
    public function execute(int $id): ?Category
    {
        return Category::find($id);
    }
}

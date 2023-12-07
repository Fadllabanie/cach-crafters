<?php

namespace App\Actions\Categories;

use App\Models\Category;

class DeleteCategoryAction
{
    public function execute(Category $model): bool
    {

        return $model->delete();
    }
}

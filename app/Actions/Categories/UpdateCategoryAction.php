<?php

namespace App\Actions\Categories;

use App\Models\Category;

class UpdateCategoryAction
{
    public function execute(Category $model, array $data): Category
    {

        $model->update($data);

        return $model;
    }
}

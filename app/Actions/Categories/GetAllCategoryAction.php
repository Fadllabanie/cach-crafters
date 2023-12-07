<?php

    namespace App\Actions\Categories;

use App\Models\Category;

class GetAllCategoryAction
{
    public function execute()
    {
        return Category::all();
    }
}

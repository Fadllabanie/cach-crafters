<?php

namespace App\Actions\Budgets;

use App\Models\Budget;

class UpdateBudgetAction
{
    public function execute(Budget $model, array $data): Budget
    {

        $model->update($data);

        return $model;
    }
}

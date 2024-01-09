<?php

namespace App\Actions\Budgets;

use App\Models\Budget;

class DeleteBudgetAction
{
    public function execute(Budget $model): bool
    {
        return $model->delete();
    }
}

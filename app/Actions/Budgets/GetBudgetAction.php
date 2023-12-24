<?php

    namespace App\Actions\Budgets;

use App\Models\Budget;

class GetBudgetAction
{
    public function execute(int $id): ?Budget
    {
        return Budget::find($id);
    }
}

<?php

    namespace App\Actions\Budgets;

use App\Models\Budget;

class GetAllBudgetAction
{
    public function execute()
    {
        return Budget::all();
    }
}

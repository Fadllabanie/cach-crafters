<?php

namespace App\Actions\Budgets;

use App\Models\Budget;

class CreateBudgetAction
{
    public function execute(array $data): Budget
    {
        // Validate and create a new Budget
        // TODO: Add your validation and creation logic here
        $data['user_id'] = auth()->id();
        return Budget::create($data);
    }
}

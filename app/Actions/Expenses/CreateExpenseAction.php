<?php

namespace App\Actions\Expenses;

use App\Models\Expense;

class CreateExpenseAction
{
    public function execute(array $data): Expense
    {
        // Validate and create a new Expense
        // TODO: Add your validation and creation logic here

        return Expense::create($data);
    }
}

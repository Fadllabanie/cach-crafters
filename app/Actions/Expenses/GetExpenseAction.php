<?php

    namespace App\Actions\Expenses;

use App\Models\Expense;

class GetExpenseAction
{
    public function execute(int $id): ?Expense
    {
        return Expense::find($id);
    }
}

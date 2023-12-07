<?php

    namespace App\Actions\Expenses;

use App\Models\Expense;

class GetAllExpenseAction
{
    public function execute()
    {
        return Expense::all();
    }
}

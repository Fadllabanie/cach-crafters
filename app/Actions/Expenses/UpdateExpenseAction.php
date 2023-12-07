<?php

namespace App\Actions\Expenses;

use App\Models\Expense;

class UpdateExpenseAction
{
    public function execute(Expense $model, array $data): Expense
    {

        $model->update($data);

        return $model;
    }
}

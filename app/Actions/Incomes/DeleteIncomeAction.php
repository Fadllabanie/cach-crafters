<?php

namespace App\Actions\Incomes;

use App\Models\Income;

class DeleteIncomeAction
{
    public function execute(Income $model): bool
    {

        return $model->delete();
    }
}

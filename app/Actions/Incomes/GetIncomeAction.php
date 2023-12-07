<?php

    namespace App\Actions\Incomes;

use App\Models\Income;

class GetIncomeAction
{
    public function execute(int $id): ?Income
    {
        return Income::find($id);
    }
}

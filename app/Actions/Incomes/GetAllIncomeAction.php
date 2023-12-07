<?php

    namespace App\Actions\Incomes;

use App\Models\Income;

class GetAllIncomeAction
{
    public function execute()
    {
        return Income::all();
    }
}

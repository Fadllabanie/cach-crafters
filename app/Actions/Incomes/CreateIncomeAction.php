<?php

namespace App\Actions\Incomes;

use App\Models\Income;

class CreateIncomeAction
{
    public function execute(array $data): Income
    {
        // Validate and create a new Income
        // TODO: Add your validation and creation logic here

        return Income::create($data);
    }
}

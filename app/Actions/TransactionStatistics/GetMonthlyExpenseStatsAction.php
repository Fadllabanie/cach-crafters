<?php

namespace App\Actions\TransactionStatistics;

use App\Models\Transaction;

class GetMonthlyExpenseStatsAction
{
    public function execute($request)
    {
        $userId = auth()->id(); // or however you get the authenticated user's id
        $specificMonth = $request->input('specificMonth', null); // default to 'expense' if not provided

        return Transaction::getMonthlyExpenseStats($userId, $specificMonth);
    }
}

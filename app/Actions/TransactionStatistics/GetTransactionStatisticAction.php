<?php

namespace App\Actions\TransactionStatistics;

use App\Models\Transaction;

class GetTransactionStatisticAction
{
    public function execute($request)
    {
        $userId = auth()->id(); // or however you get the authenticated user's id
        $timeFrame = $request->input('timeFrame'); // default to 'month' if not provided
        $specificMonth = $request->input('specificMonth', null); // default to 'expense' if not provided
        $type = $request->input('type'); // default to 'expense' if not provided

        return  Transaction::getStatistics($userId, $type, $timeFrame, $specificMonth);
    }
}

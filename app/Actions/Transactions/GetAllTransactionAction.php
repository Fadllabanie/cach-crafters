<?php

namespace App\Actions\Transactions;

use App\Models\Transaction;

class GetAllTransactionAction
{
    public function execute($request)
    {
        return Transaction::with('source')
            ->mine()
            ->OfMonth($request->month)
            ->orderByDESC('id')
            ->get();
    }
}

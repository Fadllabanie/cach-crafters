<?php

namespace App\Actions\Home;

use App\Http\Resources\Api\Transactions\TransactionResource;
use App\Models\Transaction;

class HomeAction
{
    public function execute()
    {

        $data['balance']  = Transaction::getSummary(auth()->id());

        $transactions  = Transaction::with('source')->mine()->orderByDESC('id')->take(4)->get();
        $data['transactions']  =  TransactionResource::collection($transactions);

        return $data;
    }
}

<?php

namespace App\Actions\Home;

use App\Models\Transaction;

class HomeAction
{
    public function execute()
    {

        $data['balance']  = Transaction::getSummary(auth()->id());

        $data['transactions']  = Transaction::with('source')->mine()->orderByDESC('id')->take(4)->get();

        return $data;
    }
}

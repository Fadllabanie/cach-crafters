<?php

namespace App\Actions\General;

use Illuminate\Support\Facades\DB;

class GetCurrencyAction
{
    public function execute()
    {

        return DB::table('currencies')->get();
    }
}

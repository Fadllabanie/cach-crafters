<?php

namespace App\Http\Controllers\Api\V1\Transactions;

use App\Actions\TransactionStatistics\GetMonthlyExpenseStatsAction;
use App\Actions\TransactionStatistics\GetTransactionStatisticAction;
use App\Http\Controllers\Controller;
use App\Traits\HandlesErrors;
use Illuminate\Http\Request;

class TransactionStatisticController extends Controller
{
    use HandlesErrors;

    public function index(Request $request ,GetTransactionStatisticAction $action)
    {
        return $this->executeCrudOperation(function () use ($request,$action) {
            $models = $action->execute($request);
            return $this->respondWithCollection($models);
        }, 'index');
    }
    
    public function getMonthlyExpenseStats(Request $request ,GetMonthlyExpenseStatsAction $action)
    {
        return $this->executeCrudOperation(function () use ($request,$action) {
            $models = $action->execute($request);
            return $this->respondWithCollection($models);
        }, 'getMonthlyExpenseStats');
    }

}
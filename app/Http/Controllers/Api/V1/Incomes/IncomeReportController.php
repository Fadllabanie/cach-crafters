<?php

namespace App\Http\Controllers\Api\V1\Incomes;

use App\Actions\ExpensesReport\GetIncomesReportAction;
use App\Http\Controllers\Controller;
use App\Traits\HandlesErrors;

class IncomeReportController extends Controller
{
    use HandlesErrors;

    public function index(Request $request, GetIncomesReportAction $action)
    {
        return $this->executeCrudOperation(function () use ($action) {
            $models = $action->execute($request->date);
            return response()->json($models);
        }, 'index');
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Expenses;

use App\Actions\ExpensesReport\GetExpensesReportAction;
use App\Http\Controllers\Controller;
use App\Traits\HandlesErrors;
use Illuminate\Http\Request;

class ExpenseReportController extends Controller
{
    use HandlesErrors;

    public function index(Request $request, GetExpensesReportAction $action)
    {
        return $this->executeCrudOperation(function () use ($action) {
            $models = $action->execute('');
            return response()->json($models);
        }, 'index');
    }
}

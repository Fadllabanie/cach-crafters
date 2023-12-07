<?php

namespace App\Http\Controllers\Api\V1\Expenses;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Actions\Expenses\CreateExpenseAction;
use App\Actions\Expenses\UpdateExpenseAction;
use App\Actions\Expenses\DeleteExpenseAction;
use App\Actions\Expenses\GetAllExpenseAction;
use App\Actions\Expenses\GetExpenseAction;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Traits\HandlesErrors;

class ExpenseController extends Controller
{
    use HandlesErrors;

    public function index(GetAllExpenseAction $action)
    {
        return $this->executeCrudOperation(function () use ($action) {
            $models = $action->execute();
            return response()->json($models);
        }, 'index');
    }

    public function store(StoreExpenseRequest $request, CreateExpenseAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $action) {
            $model = $action->execute($request->validated());
            return response()->json($model, 201);
        }, 'store');
    }

    public function show($id, GetExpenseAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = $action->execute($id);
            if (!$model) {
                return response()->json(['error' => 'Not Found'], 404);
            }

            return response()->json($model);
        }, 'show');
    }

    public function update(UpdateExpenseRequest $request, $id, UpdateExpenseAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $id, $action) {
            $model = Expense::findOrFail($id);
            $action->execute($model, $request->validated());
            return response()->json($model);
        }, 'update');
    }

    public function destroy($id, DeleteExpenseAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = Expense::findOrFail($id);
            $action->execute($model);
            return response()->json(null, 204);
        }, 'destroy');
    }
}

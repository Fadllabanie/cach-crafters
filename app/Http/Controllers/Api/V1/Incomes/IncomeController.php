<?php

namespace App\Http\Controllers\Api\V1\Incomes;

use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use App\Actions\Incomes\CreateIncomeAction;
use App\Actions\Incomes\UpdateIncomeAction;
use App\Actions\Incomes\DeleteIncomeAction;
use App\Actions\Incomes\GetAllIncomeAction;
use App\Actions\Incomes\GetIncomeAction;
use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Traits\HandlesErrors;

class IncomeController extends Controller
{
    use HandlesErrors;

    public function index(GetAllIncomeAction $action)
    {
        return $this->executeCrudOperation(function () use ($action) {
            $models = $action->execute();
            return response()->json($models);
        }, 'index');
    }

    public function store(StoreIncomeRequest $request, CreateIncomeAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $action) {
            $model = $action->execute($request->validated());
            return response()->json($model, 201);
        }, 'store');
    }

    public function show($id, GetIncomeAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = $action->execute($id);
            if (!$model) {
                return response()->json(['error' => 'Not Found'], 404);
            }

            return response()->json($model);
        }, 'show');
    }

    public function update(UpdateIncomeRequest $request, $id, UpdateIncomeAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $id, $action) {
            $model = Income::findOrFail($id);
            $action->execute($model, $request->validated());
            return response()->json($model);
        }, 'update');
    }

    public function destroy($id, DeleteIncomeAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = Income::findOrFail($id);
            $action->execute($model);
            return response()->json(null, 204);
        }, 'destroy');
    }
}

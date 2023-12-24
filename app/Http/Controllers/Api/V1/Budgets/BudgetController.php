<?php

namespace App\Http\Controllers\Api\V1\Budgets;

use App\Http\Requests\Api\Budgets\StoreBudgetRequest;
use App\Http\Requests\Api\Budgets\UpdateBudgetRequest;
use App\Actions\Budgets\CreateBudgetAction;
use App\Actions\Budgets\UpdateBudgetAction;
use App\Actions\Budgets\DeleteBudgetAction;
use App\Actions\Budgets\GetAllBudgetAction;
use App\Actions\Budgets\GetBudgetAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Budgets\BudgetResource;
use App\Models\Budget;
use App\Traits\HandlesErrors;

class BudgetController extends Controller
{
    use HandlesErrors;

    public function index(GetAllBudgetAction $action)
    {
        return $this->executeCrudOperation(function () use ($action) {
            $models = $action->execute();
            return $this->respondWithCollection(BudgetResource::collection($models));
        }, 'BudgetController-index');
    }

    public function store(StoreBudgetRequest $request, CreateBudgetAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $action) {
            $model = $action->execute($request->validated());
            return $this->respondCreated(BudgetResource::make($model));
        }, 'BudgetController-store');
    }

    public function show($id, GetBudgetAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = $action->execute($id);
            if (!$model) {
                return $this->errorNotFound('Not Found');
            }

            return $this->respondWithItem(BudgetResource::make($model));
        }, 'BudgetController-show');
    }

    public function update(UpdateBudgetRequest $request, $id, UpdateBudgetAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $id, $action) {
            $model = Budget::find($id);
            if (!$model) {
                return $this->errorNotFound('Not Found');
            }
            $action->execute($model, $request->validated());
            return $this->respondCreated(BudgetResource::make($model));
        }, 'BudgetController-update');
    }

    public function destroy($id, DeleteBudgetAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = Budget::find($id);
            if (!$model) {
                return $this->errorNotFound('Not Found');
            }
            $action->execute($model);
            return $this->successStatus();
        }, 'destroy');
    }
}

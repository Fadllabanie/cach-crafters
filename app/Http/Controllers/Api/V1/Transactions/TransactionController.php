<?php

namespace App\Http\Controllers\Api\V1\Transactions;

use App\Http\Requests\Api\Transactions\StoreTransactionRequest;
use App\Http\Requests\Api\Transactions\UpdateTransactionRequest;
use App\Actions\Transactions\CreateTransactionAction;
use App\Actions\Transactions\UpdateTransactionAction;
use App\Actions\Transactions\DeleteTransactionAction;
use App\Actions\Transactions\GetAllTransactionAction;
use App\Actions\Transactions\GetTransactionAction;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Traits\HandlesErrors;

class TransactionController extends Controller
{
    use HandlesErrors;

    public function index(GetAllTransactionAction $action)
    {
        return $this->executeCrudOperation(function () use ($action) {
            $models = $action->execute();
            return response()->json($models);
        }, 'index');
    }

    public function store(StoreTransactionRequest $request, CreateTransactionAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $action) {
            $model = $action->execute($request->validated());
            return response()->json($model, 201);
        }, 'store');
    }

    public function show($id, GetTransactionAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = $action->execute($id);
            if (!$model) {
                return response()->json(['error' => 'Not Found'], 404);
            }

            return response()->json($model);
        }, 'show');
    }

    public function update(UpdateTransactionRequest $request, $id, UpdateTransactionAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $id, $action) {
            $model = Transaction::findOrFail($id);
            $action->execute($model, $request->validated());
            return response()->json($model);
        }, 'update');
    }

    public function destroy($id, DeleteTransactionAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = Transaction::findOrFail($id);
            $action->execute($model);
            return response()->json(null, 204);
        }, 'destroy');
    }
}

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
use App\Http\Resources\Api\Transactions\TransactionResource;
use App\Models\Transaction;
use App\Traits\HandlesErrors;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    use HandlesErrors;

    public function index(Request $request, GetAllTransactionAction $action)
    {
        return $this->executeCrudOperation(function () use ($action, $request) {
            $models = $action->execute($request);
            return $this->respondWithCollection(TransactionResource::collection($models));
        }, 'index');
    }

    public function store(StoreTransactionRequest $request, CreateTransactionAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $action) {
            $model = $action->execute($request->validated());
            return $this->respondCreated(TransactionResource::make($model));
        }, 'store');
    }

    public function show($id, GetTransactionAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = $action->execute($id);
            if (!$model) {
                return $this->errorNotFound('Not Found');
            }
            return $this->respondWithItem(TransactionResource::make($model));
        }, 'show');
    }

    public function update(UpdateTransactionRequest $request, $id, UpdateTransactionAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $id, $action) {
            $model = Transaction::findOrFail($id);
            $action->execute($model, $request->validated());
            return $this->respondCreated(TransactionResource::make($model));
        }, 'update');
    }

    public function destroy($id, DeleteTransactionAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = Transaction::findOrFail($id);
            $action->execute($model);
            return $this->successStatus();
        }, 'destroy');
    }
}

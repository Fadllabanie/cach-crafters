<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Actions\Users\CreateUserAction;
use App\Actions\Users\UpdateUserAction;
use App\Actions\Users\DeleteUserAction;
use App\Actions\Users\GetAllUserAction;
use App\Actions\Users\GetUserAction;
use App\Models\User;
use App\Traits\HandlesErrors;

class UserController extends Controller
{
    use HandlesErrors;

    public function index(GetAllUserAction $action)
    {
        return $this->executeCrudOperation(function () use ($action) {
            $models = $action->execute();
            return response()->json($models);
        }, 'index'); 
    }

    public function store(StoreUserRequest $request, CreateUserAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $action) {
            $model = $action->execute($request->validated());
            return response()->json($model, 201);
        }, 'store');
    }

    public function show($id, GetUserAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = $action->execute($id);
            if (!$model) {
                return response()->json(['error' => 'Not Found'], 404);
            }
            
            return response()->json($model);
        }, 'show');
    }

    public function update(UpdateUserRequest $request, $id, UpdateUserAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $id, $action) {
            $model = User::findOrFail($id);
            $action->execute($model,$request->validated());
            return response()->json($model);
        }, 'update');

    }

    public function destroy($id, DeleteUserAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = User::findOrFail($id);
            $action->execute($model);
            return response()->json(null, 204);
        }, 'destroy');
    }
}

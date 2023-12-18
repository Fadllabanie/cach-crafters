<?php

namespace App\Http\Controllers\Api\V1\General;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Actions\Categories\CreateCategoryAction;
use App\Actions\Categories\UpdateCategoryAction;
use App\Actions\Categories\DeleteCategoryAction;
use App\Actions\Categories\GetAllCategoryAction;
use App\Actions\Categories\GetCategoryAction;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\HandlesErrors;

class CategoryController extends Controller
{
    use HandlesErrors;

    public function index(GetAllCategoryAction $action)
    {
        return $this->executeCrudOperation(function () use ($action) {
            $models = $action->execute();
            return $this->respondWithCollection($models);
        }, 'index');
    }

    public function store(StoreCategoryRequest $request, CreateCategoryAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $action) {
            $model = $action->execute($request->validated());
            return response()->json($model, 201);
        }, 'store');
    }

    public function show($id, GetCategoryAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = $action->execute($id);
            if (!$model) {
                return response()->json(['error' => 'Not Found'], 404);
            }

            return response()->json($model);
        }, 'show');
    }

    public function update(UpdateCategoryRequest $request, $id, UpdateCategoryAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $id, $action) {
            $model = Category::findOrFail($id);
            $action->execute($model, $request->validated());
            return response()->json($model);
        }, 'update');
    }

    public function destroy($id, DeleteCategoryAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = Category::findOrFail($id);
            $action->execute($model);
            return response()->json(null, 204);
        }, 'destroy');
    }
}

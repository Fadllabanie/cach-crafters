<?php

namespace App\Http\Controllers\Api\V1\General;

use App\Http\Requests\StoreSourceRequest;
use App\Http\Requests\UpdateSourceRequest;
use App\Actions\Sources\CreateSourceAction;
use App\Actions\Sources\UpdateSourceAction;
use App\Actions\Sources\DeleteSourceAction;
use App\Actions\Sources\GetAllSourceAction;
use App\Actions\Sources\GetSourceAction;
use App\Http\Controllers\Controller;
use App\Models\Source;
use App\Traits\HandlesErrors;

class SourceController extends Controller
{
    use HandlesErrors;

    public function index(GetAllSourceAction $action)
    {
        return $this->executeCrudOperation(function () use ($action) {
            $models = $action->execute();
            return response()->json($models);
        }, 'index');
    }

    public function store(StoreSourceRequest $request, CreateSourceAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $action) {
            $model = $action->execute($request->validated());
            return response()->json($model, 201);
        }, 'store');
    }

    public function show($id, GetSourceAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = $action->execute($id);
            if (!$model) {
                return response()->json(['error' => 'Not Found'], 404);
            }

            return response()->json($model);
        }, 'show');
    }

    public function update(UpdateSourceRequest $request, $id, UpdateSourceAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $id, $action) {
            $model = Source::findOrFail($id);
            $action->execute($model, $request->validated());
            return response()->json($model);
        }, 'update');
    }

    public function destroy($id, DeleteSourceAction $action)
    {
        return $this->executeCrudOperation(function () use ($id, $action) {
            $model = Source::findOrFail($id);
            $action->execute($model);
            return response()->json(null, 204);
        }, 'destroy');
    }
}

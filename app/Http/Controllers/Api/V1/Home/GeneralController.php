<?php

namespace App\Http\Controllers\Api\V1\Home;

use App\Actions\General\GetCurrencyAction;
use App\Actions\Home\HomeAction;
use App\Actions\Sources\GetAllSourceAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\General\CurrencyResource;
use App\Http\Resources\Api\General\SourceResource;
use App\Traits\HandlesErrors;

class GeneralController extends Controller
{
    use HandlesErrors;

    public function getSource(GetAllSourceAction $action)
    {
        return $this->executeCrudOperation(function () use ($action) {
            $models = $action->execute();
            return $this->respondWithCollection(SourceResource::collection($models));
        }, 'getSource');
    }

    public function getCurrency(GetCurrencyAction $action)
    {
        return $this->executeCrudOperation(function () use ($action) {
            $models = $action->execute();
            return $this->respondWithCollection(CurrencyResource::collection($models));
        }, 'getCurrency');
    }
}

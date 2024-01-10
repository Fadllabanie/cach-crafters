<?php

namespace App\Http\Controllers\Api\V1\Badges;

use App\Actions\Badges\GetAllBadgeAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Badges\BadgeResource;
use App\Traits\HandlesErrors;

class BadgeController extends Controller
{
    use HandlesErrors;

    public function index(GetAllBadgeAction $action)
    {
        return $this->executeCrudOperation(function () use ($action) {
            $models = $action->execute();
            return $this->respondWithCollection(BadgeResource::collection($models));
        }, 'BadgeController-index');
    }
}
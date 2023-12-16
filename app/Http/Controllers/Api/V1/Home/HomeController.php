<?php

namespace App\Http\Controllers\Api\V1\Home;

use App\Actions\Home\HomeAction;
use App\Http\Controllers\Controller;
use App\Traits\HandlesErrors;

class HomeController extends Controller
{
    use HandlesErrors;

    public function index(HomeAction $action)
    {
        return $this->executeCrudOperation(function () use ($action) {
            $models = $action->execute();
            return response()->json($models);
        }, 'index');
    }
}
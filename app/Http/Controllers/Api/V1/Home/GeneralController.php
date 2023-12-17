<?php

namespace App\Http\Controllers\Api\V1\Home;

use App\Actions\General\GetCurrencyAction;
use App\Actions\Home\HomeAction;
use App\Http\Controllers\Controller;
use App\Traits\HandlesErrors;

class GeneralController extends Controller
{
    use HandlesErrors;

    public function getSource(HomeAction $action)
    {
        return $this->executeCrudOperation(function () use ($action) {
            $models = $action->execute();
            return response()->json($models);
        }, 'index');
    } 
    
    public function getCurrency(GetCurrencyAction $action)
    {
        return $this->executeCrudOperation(function () use ($action) {
            $models = $action->execute();
            return response()->json($models);
        }, 'getCurrency');
    }
}
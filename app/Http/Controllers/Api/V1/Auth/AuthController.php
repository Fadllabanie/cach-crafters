<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\RegisterAction;
use App\Actions\Profiles\UserProfileAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Traits\HandlesErrors;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HandlesErrors;

    public function register(RegisterRequest $request, RegisterAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $action) {
            $model = $action->execute($request->validated());
            return response()->json($model, 201);
        }, 'register');
    }

    public function login(LoginRequest $request, LoginAction $action)
    {
        return $this->executeCrudOperation(function () use ($request, $action) {
            $model = $action->execute($request->validated());
            return response()->json([
                'user' => $model,
            ], 201);
        }, 'login');
    }
}

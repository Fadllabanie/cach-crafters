<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Expenses\ExpenseController;
use App\Http\Controllers\Api\V1\General\CategoryController;
use App\Http\Controllers\Api\V1\General\SourceController;
use App\Http\Controllers\Api\V1\Incomes\IncomeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {

    Route::get('/login/{provider}', [AuthController::class, 'redirectToProvider']);
    Route::get('/login/{provider}/callback', [AuthController::class, 'handleProviderCallback']);


    Route::apiResources(['users' => UserController::class]);
    Route::apiResources(['incomes' => IncomeController::class]);
    Route::apiResources(['expenses' => ExpenseController::class]);

    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('sources', [SourceController::class, 'index']);
});

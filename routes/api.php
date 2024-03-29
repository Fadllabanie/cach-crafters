<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\SocialiteAuthController;
use App\Http\Controllers\Api\V1\Badges\BadgeController;
use App\Http\Controllers\Api\V1\Budgets\BudgetController;
use App\Http\Controllers\Api\V1\Expenses\ExpenseController;
use App\Http\Controllers\Api\V1\General\CategoryController;
use App\Http\Controllers\Api\V1\General\SourceController;
use App\Http\Controllers\Api\V1\Home\GeneralController;
use App\Http\Controllers\Api\V1\Incomes\IncomeController;
use App\Http\Controllers\Api\V1\Home\HomeController;
use App\Http\Controllers\Api\V1\Transactions\TransactionController;
use App\Http\Controllers\Api\V1\Transactions\TransactionStatisticController;
use App\Http\Controllers\UserController;
use App\Services\Badges\BadgeService;
use App\Services\Badges\BudgetMasterBadge;
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

Route::prefix('v1')->group(function () {
    
   

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login/{provider}', [SocialiteAuthController::class, 'redirectToProvider']);
    Route::get('/login/{provider}/callback', [SocialiteAuthController::class, 'handleProviderCallback']);



    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/test', function (BadgeService $badgeService) {
            
            $badgeService->awardBadge(auth()->user(), new BudgetMasterBadge());
        });

        Route::apiResources(['users' => UserController::class]);
        Route::apiResources(['incomes' => IncomeController::class]);
        Route::apiResources(['expenses' => ExpenseController::class]);

        Route::get('home', [HomeController::class, 'index'])->name('home');
        // Route::get('get-sources', [GeneralController::class, 'getSource'])->name('home.get-source');
        Route::apiResources(['transactions' => TransactionController::class]);
        Route::apiResources(['budgets' => BudgetController::class]);
        Route::get('statistics', [TransactionStatisticController::class, 'index'])->name('statistics.home');
        Route::get('monthly-expense-stats', [TransactionStatisticController::class, 'getMonthlyExpenseStats'])->name('statistics.monthly-expense-stats');
        
        
        Route::get('my-badges', [BadgeController::class, 'index'])->name('badges.list-all');

        // Route::get('categories', [CategoryController::class, 'index']);
        // Route::get('sources', [SourceController::class, 'index']);

        Route::get('sources', [GeneralController::class, 'getSource'])->name('home.get-source');
        Route::get('currencies', [GeneralController::class, 'getCurrency'])->name('home.get-currency');
    });
});

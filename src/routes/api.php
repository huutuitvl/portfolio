<?php

use App\Modules\Education\Interface\Http\Controllers\EducationController;
use Illuminate\Support\Facades\Route;

use App\Modules\Profile\Interface\Http\Controllers\ProfileController;
use App\Modules\User\Interface\Http\Controllers\AuthController;

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

// ✅ Auth routes
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});

// ✅ CMS routes (auth middleware)
Route::prefix('cms')->middleware('auth:api')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::post('/', [ProfileController::class, 'store']);
        Route::get('{id}', [ProfileController::class, 'show']);
        Route::put('{id}', [ProfileController::class, 'update']);
        Route::delete('{id}', [ProfileController::class, 'destroy']);
    });
});

// ✅ Education CMS routes (admin middleware)
Route::prefix('cms/education')->middleware(['auth:api'])->group(function () {
    Route::get('/', [EducationController::class, 'index']);
    Route::post('/', [EducationController::class, 'store']);
    Route::get('{id}', [EducationController::class, 'show']);
    Route::put('{id}', [EducationController::class, 'update']);
    Route::delete('{id}', [EducationController::class, 'destroy']);
});

// ✅ Public profile
Route::get('profile', [ProfileController::class, 'showPublic']);
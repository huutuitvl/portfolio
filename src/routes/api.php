<?php

use App\Modules\Education\Interface\Http\Controllers\EducationController;
use Illuminate\Support\Facades\Route;

use App\Modules\Profile\Interface\Http\Controllers\ProfileController;
use App\Modules\User\Interface\Http\Controllers\AuthController;
use App\Modules\Blog\Interface\Http\Controllers\BlogController;
use App\Modules\Experience\Interface\Http\Controllers\ExperienceController;
use App\Modules\Skill\Interface\Http\Controllers\SkillController;
use App\Modules\Certificate\Interface\Http\Controllers\CertificateController;
use App\Modules\Contact\Interface\Http\Controllers\ContactController;

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

// Auth routes
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});

// CMS routes
Route::prefix('cms')->middleware('auth:api')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::post('/', [ProfileController::class, 'store']);
        Route::get('{id}', [ProfileController::class, 'show']);
        Route::put('{id}', [ProfileController::class, 'update']);
        Route::delete('{id}', [ProfileController::class, 'destroy']);
    });
});

// Education CMS routes
Route::prefix('cms/educations')->middleware(['auth:api'])->group(function () {
    Route::get('/', [EducationController::class, 'index']);
    Route::post('/', [EducationController::class, 'store']);
    Route::get('{id}', [EducationController::class, 'show']);
    Route::put('{id}', [EducationController::class, 'update']);
    Route::delete('{id}', [EducationController::class, 'destroy']);
});

// Blog CMS routes
Route::prefix('cms/blogs')->middleware('auth:api')->group(function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::get('/{id}', [BlogController::class, 'show']);
    Route::post('/', [BlogController::class, 'store']);
    Route::put('/{id}', [BlogController::class, 'update']);
    Route::delete('/{id}', [BlogController::class, 'destroy']);
});

// Skill CMS routes
Route::prefix('cms/skills')->middleware('auth:api')->group(function () {
    Route::get('/', [SkillController::class, 'index']);
    Route::get('/{id}', [SkillController::class, 'show']);
    Route::post('/', [SkillController::class, 'store']);
    Route::put('/{id}', [SkillController::class, 'update']);
    Route::delete('/{id}', [SkillController::class, 'destroy']);
    Route::post('import', [SkillController::class, 'import']);
    Route::get('export', [SkillController::class, 'export']);
    Route::get('export-excel', [SkillController::class, 'exportExcel']);
});

// Experience CMS routes
Route::prefix('cms/experiences')->middleware('auth:api')->group(function () {
    Route::get('/', [ExperienceController::class, 'index']);
    Route::get('/{id}', [ExperienceController::class, 'show']);
    Route::post('/', [ExperienceController::class, 'store']);
    Route::put('/{id}', [ExperienceController::class, 'update']);
    Route::delete('/{id}', [ExperienceController::class, 'destroy']);
});

// Eertificates CMS routes 
Route::prefix('cms/certificates')->middleware(['auth:api'])->group(function () {
    Route::get('/', [CertificateController::class, 'index']);
    Route::post('/', [CertificateController::class, 'store']);
    Route::get('{id}', [CertificateController::class, 'show']);
    Route::put('{id}', [CertificateController::class, 'update']);
    Route::delete('{id}', [CertificateController::class, 'destroy']);
});

// Contacts cms/contact
Route::prefix('cms/contacts')->middleware(['auth:api'])->group(function () {
    Route::get('/', [ContactController::class, 'index']);
    Route::post('/', [ContactController::class, 'store']);
    Route::get('{id}', [ContactController::class, 'show']);
    Route::put('{id}', [ContactController::class, 'update']);
    Route::delete('{id}', [ContactController::class, 'destroy']);
});


// Public routes
Route::get('profile', [ProfileController::class, 'showPublic']);

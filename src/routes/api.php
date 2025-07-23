<?php

use App\Modules\User\Interface\Http\Controllers\AuthController;
use App\Modules\Profile\Interface\Http\Controllers\ProfileController;
use App\Modules\Education\Interface\Http\Controllers\EducationController;
use App\Modules\Blog\Interface\Http\Controllers\BlogController;
use App\Modules\Experience\Interface\Http\Controllers\ExperienceController;
use App\Modules\Skill\Interface\Http\Controllers\SkillController;
use App\Modules\Certificate\Interface\Http\Controllers\CertificateController;
use App\Modules\Contact\Interface\Http\Controllers\ContactController;
use App\Modules\Project\Interface\Http\Controllers\ProjectController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Auth
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
});

// CMS (protected by auth:api)
Route::prefix('cms')->middleware('auth:api')->group(function () {
    // Profile (manual routes)
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::post('/', [ProfileController::class, 'store']);
        Route::get('{id}', [ProfileController::class, 'show']);
        Route::put('{id}', [ProfileController::class, 'update']);
        Route::delete('{id}', [ProfileController::class, 'destroy']);
    });

    // Resourceful routes
    Route::apiResources([
        'educations' => EducationController::class,
        'blogs' => BlogController::class,
        'skills' => SkillController::class,
        'experiences' => ExperienceController::class,
        'certificates' => CertificateController::class,
        'contacts' => ContactController::class,
        'projects' => ProjectController::class,
    ]);

    // Extra routes for skills
    Route::post('skills/import', [SkillController::class, 'import']);
    Route::get('skills/export', [SkillController::class, 'export']);
    Route::get('skills/export-excel', [SkillController::class, 'exportExcel']);
});

// Public routes
Route::get('profile', [ProfileController::class, 'showPublic']);

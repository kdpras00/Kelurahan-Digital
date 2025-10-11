<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventParticipantController;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\HeadOfFamilyController;
use App\Http\Controllers\JobApplicantController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAssistanceController;
use App\Http\Controllers\SocialAssistanceRecipientController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('dashboard/get-dashboard-data', [DashboardController::class, 'getDashboardData']);
    Route::apiResource('user', UserController::class);
    Route::get('user/all/paginated', [UserController::class, 'getAllPaginated']);

    Route::apiResource('head-of-family', HeadOfFamilyController::class);
    Route::get('head-of-family/all/paginated', [HeadOfFamilyController::class, 'getAllPaginated']);

    Route::apiResource('family-member', FamilyMemberController::class);
    Route::get('family-member/all/paginated', [FamilyMemberController::class, 'getAllPaginated']);

    Route::apiResource('social-assistance', SocialAssistanceController::class);
    Route::get('social-assistance/all/paginated', [SocialAssistanceController::class, 'getAllPaginated']);

    Route::apiResource('social-assistance-recipient', SocialAssistanceRecipientController::class);
    Route::get('social-assistance-recipient/all/paginated', [SocialAssistanceRecipientController::class, 'getAllPaginated']);

    Route::apiResource('event', EventController::class);
    Route::get('event/all/paginated', [EventController::class, 'getAllPaginated']);

    Route::apiResource('event-participant', EventParticipantController::class);
    Route::get('event-participant/all/paginated', [EventParticipantController::class, 'getAllPaginated']);

    Route::apiResource('job-vacancy', JobVacancyController::class);
    Route::get('job-vacancy/all/paginated', [JobVacancyController::class, 'getAllPaginated']);

    Route::apiResource('job-applicant', JobApplicantController::class);
    Route::get('job-applicant/all/paginated', [JobApplicantController::class, 'getAllPaginated']);

    Route::get('Profile', [ProfileController::class, 'index']);
    Route::post('Profile', [ProfileController::class, 'store']);
    Route::put('Profile', [ProfileController::class, 'update']);
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me'])->name('me');

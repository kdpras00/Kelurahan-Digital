<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Login');
})->name('login');

// Add authentication routes - remove middleware from here since we'll handle it in Vue
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/kepala-rumah', function () {
    return Inertia::render('HeadOfFamily/Index');
})->name('head-of-family.index');

Route::get('/kepala-rumah/create', function () {
    return Inertia::render('HeadOfFamily/Create');
})->name('head-of-family.create');

Route::get('/kepala-rumah/{id}/edit', function ($id) {
    return Inertia::render('HeadOfFamily/Edit', [
        'id' => $id
    ]);
})->name('head-of-family.edit');

Route::get('/kepala-rumah/{id}/anggota-keluarga', function ($id) {
    return Inertia::render('HeadOfFamily/FamilyMembers', [
        'id' => $id
    ]);
})->name('head-of-family.family-members');

// Routes for Bantuan Sosial dropdown
Route::get('/bantuan-sosial/list', function () {
    return Inertia::render('SocialAssistanceList');
})->name('social-assistance.list');

Route::get('/bantuan-sosial/pengajuan', function () {
    return Inertia::render('SocialAssistanceApplication');
})->name('social-assistance.application');

Route::get('/bantuan-sosial/{id}', function ($id) {
    return Inertia::render('SocialAssistanceDetail', [
        'id' => $id
    ]);
})->name('social-assistance.detail');

// Routes for Jadwal Desa dropdown
Route::get('/jadwal-desa/job-vacancy', function () {
    return Inertia::render('JobVacancy');
})->name('job-vacancy.index');

Route::get('/jadwal-desa/job-vacancy/detail/{id}', function ($id) {
    return Inertia::render('JobVacancyDetail', [
        'id' => $id
    ]);
})->name('job-vacancy.detail');

Route::get('/jadwal-desa/events', function () {
    return Inertia::render('VillageEvents');
})->name('village-events.index');

Route::get('/jadwal-desa/events/create', function () {
    return Inertia::render('VillageEventsCreate');
})->name('village-events.create');

Route::get('/jadwal-desa/events/{id}', function ($id) {
    return Inertia::render('VillageEventsDetail', [
        'id' => $id
    ]);
})->name('village-events.detail');

Route::get('/jadwal-desa/events/{id}/edit', function ($id) {
    return Inertia::render('VillageEventsEdit', [
        'id' => $id
    ]);
})->name('village-events.edit');

// Profile Desa route
Route::get('/profile-desa', function () {
    return Inertia::render('VillageProfile');
})->name('village-profile.index');

Route::get('/profile-desa/edit', function () {
    return Inertia::render('VillageProfileEdit');
})->name('village-profile.edit');
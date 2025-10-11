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

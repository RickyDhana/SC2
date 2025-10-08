<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Verifikator1Controller;
use App\Http\Controllers\Verifikator2Controller;
use App\Http\Controllers\Verifikator3Controller;
use App\Http\Controllers\Verifikator4Controller;

// VERIFIKATOR 1
Route::get('/verifikator1', [Verifikator1Controller::class, 'index'])->name('v1.index');
Route::get('/verifikator1/{id}', [Verifikator1Controller::class, 'show'])->name('v1.show');
Route::post('/verifikator1/{id}/setujui', [Verifikator1Controller::class, 'setujui'])->name('v1.setujui');
Route::post('/verifikator1/{id}/tolak', [Verifikator1Controller::class, 'tolak'])->name('v1.tolak');

// VERIFIKATOR 2
Route::get('/verifikator2', [Verifikator2Controller::class, 'index'])->name('v2.index');
Route::get('/verifikator2/{id}', [Verifikator2Controller::class, 'show'])->name('v2.show');
Route::post('/verifikator2/{id}/setujui', [Verifikator2Controller::class, 'setujui'])->name('v2.setujui');
Route::post('/verifikator2/{id}/tolak', [Verifikator2Controller::class, 'tolak'])->name('v2.tolak');

Route::get('/verifikator3', [Verifikator3Controller::class, 'index'])->name('v3.index');
Route::get('/verifikator3/{id}', [Verifikator3Controller::class, 'show'])->name('v3.show');
Route::post('/verifikator3/{id}/setujui', [Verifikator3Controller::class, 'setujui'])->name('v3.setujui');
Route::post('/verifikator3/{id}/tolak', [Verifikator3Controller::class, 'tolak'])->name('v3.tolak');

Route::get('/verifikator4', [Verifikator4Controller::class, 'index'])->name('v4.index');
Route::get('/verifikator4/{id}', [Verifikator4Controller::class, 'show'])->name('v4.show');
Route::post('/verifikator4/{id}/setujui', [Verifikator4Controller::class, 'setujui'])->name('v4.setujui');
Route::post('/verifikator4/{id}/tolak', [Verifikator4Controller::class, 'tolak'])->name('v4.tolak');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [VendorController::class, 'index'])->name('home');
Route::get('/input-dokumen', [VendorController::class, 'create'])->name('vendor.create');
Route::post('/input-dokumen', [VendorController::class, 'store'])->name('vendor.store');
Route::get('/dashboard', [VendorController::class, 'showDashboard'])->name('dashboard.show');
Route::get('/dashboard/search', [VendorController::class, 'search'])->name('dashboard.search');

// View PDF Dokumen
Route::get('/dokumen/{id}/view', [VendorController::class, 'showFile'])->name('vendor.showFile');




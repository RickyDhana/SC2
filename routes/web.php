<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Jurubeli1Controller;
use App\Http\Controllers\Jurubeli2Controller;
/*use App\Http\Controllers\Jurubeli3Controller;
use App\Http\Controllers\Jurubeli3Controller;
use App\Http\Controllers\Jurubeli3Controller;
use App\Http\Controllers\Jurubeli3Controller;
use App\Http\Controllers\Jurubeli3Controller;
use App\Http\Controllers\Jurubeli3Controller;
use App\Http\Controllers\Jurubeli3Controller;
use App\Http\Controllers\Jurubeli3Controller;
use App\Http\Controllers\Jurubeli3Controller;
use App\Http\Controllers\Jurubeli3Controller;
use App\Http\Controllers\Jurubeli3Controller;*/
use App\Http\Controllers\Verifikator4Controller;

// VERIFIKATOR 1
Route::get('/Jurubeli1', [Jurubeli1Controller::class, 'index'])->name('j1.index');
Route::get('/Jurubeli1/{id}', [Jurubeli1Controller::class, 'show'])->name('j1.show');
Route::post('/Jurubeli1/{id}/setujui', [Jurubeli1Controller::class, 'setujui'])->name('j1.setujui');
Route::post('/Jurubeli1/{id}/tolak', [Jurubeli1Controller::class, 'tolak'])->name('j1.tolak');
Route::get('/Jurubeli1/{id}/json', [Jurubeli1Controller::class, 'showJson'])->name('j1.showJson');

// VERIFIKATOR 2
Route::get('/Jurubeli2', [Jurubeli2Controller::class, 'index'])->name('j2.index');
Route::get('/Jurubeli2/{id}', [Jurubeli2Controller::class, 'show'])->name('j2.show');
Route::post('/Jurubeli2/{id}/setujui', [Jurubeli2Controller::class, 'setujui'])->name('j2.setujui');
Route::post('/Jurubeli2/{id}/tolak', [Jurubeli2Controller::class, 'tolak'])->name('j2.tolak');
Route::get('/Jurubeli2/{id}/json', [Jurubeli2Controller::class, 'showJson'])->name('j2.showJson');

/*Route::get('/verifikator3', [Verifikator3Controller::class, 'index'])->name('v3.index');
Route::get('/verifikator3/{id}', [Verifikator3Controller::class, 'show'])->name('v3.show');
Route::post('/verifikator3/{id}/setujui', [Verifikator3Controller::class, 'setujui'])->name('v3.setujui');
Route::post('/verifikator3/{id}/tolak', [Verifikator3Controller::class, 'tolak'])->name('v3.tolak');*/

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
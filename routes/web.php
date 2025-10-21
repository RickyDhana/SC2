<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Jurubeli1_1Controller;
use App\Http\Controllers\Jurubeli1_2Controller;
use App\Http\Controllers\Jurubeli1_3Controller;


//Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Vendor
Route::get('/', [VendorController::class, 'index'])->name('home');
Route::get('/input-dokumen', [VendorController::class, 'create'])->name('vendor.create');
Route::post('/input-dokumen', [VendorController::class, 'store'])->name('vendor.store');
Route::get('/dashboard', [VendorController::class, 'showDashboard'])->name('dashboard.show');
Route::get('/dashboard/search', [VendorController::class, 'search'])->name('dashboard.search');
Route::get('/dokumen/{id}/view', [VendorController::class, 'showFile'])->name('vendor.showFile');

//Jurubeli_1
Route::get('/Jurubeli1_1', [Jurubeli1_1Controller::class, 'index'])->name('Jurubeli1_1.index');
Route::get('/Jurubeli1_1/{id}', [Jurubeli1_1Controller::class, 'show'])->name('Jurubeli1_1.show');
Route::post('/Jurubeli1_1/{id}/setujui', [Jurubeli1_1Controller::class, 'setujui'])->name('Jurubeli1_1.setujui');
Route::post('/Jurubeli1_1/{id}/tolak', [Jurubeli1_1Controller::class, 'tolak'])->name('Jurubeli1_1.tolak');
Route::get('/Jurubeli1_1/{id}/json', [Jurubeli1_1Controller::class, 'showJson'])->name('Jurubeli1_1.showJson');

//Jurubeli_2
Route::get('/Jurubeli1_2', [Jurubeli1_2Controller::class, 'index'])->name('Jurubeli1_2.index');
Route::get('/Jurubeli1_2/{id}', [Jurubeli1_2Controller::class, 'show'])->name('Jurubeli1_2.show');
Route::post('/Jurubeli1_2/{id}/setujui', [Jurubeli1_2Controller::class, 'setujui'])->name('Jurubeli1_2.setujui');
Route::post('/Jurubeli1_2/{id}/tolak', [Jurubeli1_2Controller::class, 'tolak'])->name('Jurubeli1_2.tolak');
Route::get('/Jurubeli1_2/{id}/json', [Jurubeli1_2Controller::class, 'showJson'])->name('Jurubeli1_2.showJson');

//Jurubeli_3
Route::get('/Jurubeli1_3', [Jurubeli1_3Controller::class, 'index'])->name('Jurubeli1_3.index');
Route::get('/Jurubeli1_3/{id}', [Jurubeli1_3Controller::class, 'show'])->name('Jurubeli1_3.show');
Route::post('/Jurubeli1_3/{id}/setujui', [Jurubeli1_3Controller::class, 'setujui'])->name('Jurubeli1_3.setujui');
Route::post('/Jurubeli1_3/{id}/tolak', [Jurubeli1_3Controller::class, 'tolak'])->name('Jurubeli1_3.tolak');
Route::get('/Jurubeli1_3/{id}/json', [Jurubeli1_3Controller::class, 'showJson'])->name('Jurubeli1_3.showJson');
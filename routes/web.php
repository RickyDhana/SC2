<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\Jurubeli1_1Controller;
use App\Http\Controllers\Jurubeli1_2Controller;
use App\Http\Controllers\Jurubeli1_3Controller;
use App\Http\Controllers\Jurubeli1_4Controller;
use App\Http\Controllers\Jurubeli1_5Controller;
use App\Http\Controllers\Jurubeli1_6Controller;
use App\Http\Controllers\Jurubeli1_7Controller;
use App\Http\Controllers\Jurubeli1_8Controller;
use App\Http\Controllers\Jurubeli1_9Controller;
use App\Http\Controllers\Jurubeli1_10Controller;
use App\Http\Controllers\Jurubeli1_11Controller;
use App\Http\Controllers\Jurubeli1_12Controller;
use App\Http\Controllers\Jurubeli1_13Controller;
use App\Http\Controllers\Jurubeli1_14Controller;


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

//Jurubeli_4
Route::get('/Jurubeli1_4', [Jurubeli1_4Controller::class, 'index'])->name('Jurubeli1_4.index');
Route::get('/Jurubeli1_4/{id}', [Jurubeli1_4Controller::class, 'show'])->name('Jurubeli1_4.show');
Route::post('/Jurubeli1_4/{id}/setujui', [Jurubeli1_4Controller::class, 'setujui'])->name('Jurubeli1_4.setujui');
Route::post('/Jurubeli1_4/{id}/tolak', [Jurubeli1_4Controller::class, 'tolak'])->name('Jurubeli1_4.tolak');
Route::get('/Jurubeli1_4/{id}/json', [Jurubeli1_4Controller::class, 'showJson'])->name('Jurubeli1_4.showJson');

//Jurubeli_5
Route::get('/Jurubeli1_5', [Jurubeli1_5Controller::class, 'index'])->name('Jurubeli1_5.index');
Route::get('/Jurubeli1_5/{id}', [Jurubeli1_5Controller::class, 'show'])->name('Jurubeli1_5.show');
Route::post('/Jurubeli1_5/{id}/setujui', [Jurubeli1_5Controller::class, 'setujui'])->name('Jurubeli1_5.setujui');
Route::post('/Jurubeli1_5/{id}/tolak', [Jurubeli1_5Controller::class, 'tolak'])->name('Jurubeli1_5.tolak');
Route::get('/Jurubeli1_5/{id}/json', [Jurubeli1_5Controller::class, 'showJson'])->name('Jurubeli1_5.showJson');

//Jurubeli_6
Route::get('/Jurubeli1_6', [Jurubeli1_6Controller::class, 'index'])->name('Jurubeli1_6.index');
Route::get('/Jurubeli1_6/{id}', [Jurubeli1_6Controller::class, 'show'])->name('Jurubeli1_6.show');
Route::post('/Jurubeli1_6/{id}/setujui', [Jurubeli1_6Controller::class, 'setujui'])->name('Jurubeli1_6.setujui');
Route::post('/Jurubeli1_6/{id}/tolak', [Jurubeli1_6Controller::class, 'tolak'])->name('Jurubeli1_6.tolak');
Route::get('/Jurubeli1_6/{id}/json', [Jurubeli1_6Controller::class, 'showJson'])->name('Jurubeli1_6.showJson');

//Jurubeli_7
Route::get('/Jurubeli1_7', [Jurubeli1_7Controller::class, 'index'])->name('Jurubeli1_7.index');
Route::get('/Jurubeli1_7/{id}', [Jurubeli1_7Controller::class, 'show'])->name('Jurubeli1_7.show');
Route::post('/Jurubeli1_7/{id}/setujui', [Jurubeli1_7Controller::class, 'setujui'])->name('Jurubeli1_7.setujui');
Route::post('/Jurubeli1_7/{id}/tolak', [Jurubeli1_7Controller::class, 'tolak'])->name('Jurubeli1_7.tolak');
Route::get('/Jurubeli1_7/{id}/json', [Jurubeli1_7Controller::class, 'showJson'])->name('Jurubeli1_7.showJson');

//Jurubeli_8
Route::get('/Jurubeli1_8', [Jurubeli1_8Controller::class, 'index'])->name('Jurubeli1_8.index');
Route::get('/Jurubeli1_8/{id}', [Jurubeli1_8Controller::class, 'show'])->name('Jurubeli1_8.show');
Route::post('/Jurubeli1_8/{id}/setujui', [Jurubeli1_8Controller::class, 'setujui'])->name('Jurubeli1_8.setujui');
Route::post('/Jurubeli1_8/{id}/tolak', [Jurubeli1_8Controller::class, 'tolak'])->name('Jurubeli1_8.tolak');
Route::get('/Jurubeli1_8/{id}/json', [Jurubeli1_8Controller::class, 'showJson'])->name('Jurubeli1_8.showJson');

//Jurubeli_9
Route::get('/Jurubeli1_9', [Jurubeli1_9Controller::class, 'index'])->name('Jurubeli1_9.index');
Route::get('/Jurubeli1_9/{id}', [Jurubeli1_9Controller::class, 'show'])->name('Jurubeli1_9.show');
Route::post('/Jurubeli1_9/{id}/setujui', [Jurubeli1_9Controller::class, 'setujui'])->name('Jurubeli1_9.setujui');
Route::post('/Jurubeli1_9/{id}/tolak', [Jurubeli1_9Controller::class, 'tolak'])->name('Jurubeli1_9.tolak');
Route::get('/Jurubeli1_9/{id}/json', [Jurubeli1_9Controller::class, 'showJson'])->name('Jurubeli1_9.showJson');

//Jurubeli_10
Route::get('/Jurubeli1_10', [Jurubeli1_10Controller::class, 'index'])->name('Jurubeli1_10.index');
Route::get('/Jurubeli1_10/{id}', [Jurubeli1_10Controller::class, 'show'])->name('Jurubeli1_10.show');
Route::post('/Jurubeli1_10/{id}/setujui', [Jurubeli1_10Controller::class, 'setujui'])->name('Jurubeli1_10.setujui');
Route::post('/Jurubeli1_10/{id}/tolak', [Jurubeli1_10Controller::class, 'tolak'])->name('Jurubeli1_10.tolak');
Route::get('/Jurubeli1_10/{id}/json', [Jurubeli1_10Controller::class, 'showJson'])->name('Jurubeli1_10.showJson');

//Jurubeli_11
Route::get('/Jurubeli1_11', [Jurubeli1_11Controller::class, 'index'])->name('Jurubeli1_11.index');
Route::get('/Jurubeli1_11/{id}', [Jurubeli1_11Controller::class, 'show'])->name('Jurubeli1_11.show');
Route::post('/Jurubeli1_11/{id}/setujui', [Jurubeli1_11Controller::class, 'setujui'])->name('Jurubeli1_11.setujui');
Route::post('/Jurubeli1_11/{id}/tolak', [Jurubeli1_11Controller::class, 'tolak'])->name('Jurubeli1_11.tolak');
Route::get('/Jurubeli1_11/{id}/json', [Jurubeli1_11Controller::class, 'showJson'])->name('Jurubeli1_11.showJson');

//Jurubeli_12
Route::get('/Jurubeli1_12', [Jurubeli1_12Controller::class, 'index'])->name('Jurubeli1_12.index');
Route::get('/Jurubeli1_12/{id}', [Jurubeli1_12Controller::class, 'show'])->name('Jurubeli1_12.show');
Route::post('/Jurubeli1_12/{id}/setujui', [Jurubeli1_12Controller::class, 'setujui'])->name('Jurubeli1_12.setujui');
Route::post('/Jurubeli1_12/{id}/tolak', [Jurubeli1_12Controller::class, 'tolak'])->name('Jurubeli1_12.tolak');
Route::get('/Jurubeli1_12/{id}/json', [Jurubeli1_12Controller::class, 'showJson'])->name('Jurubeli1_12.showJson');

//Jurubeli_13
Route::get('/Jurubeli1_13', [Jurubeli1_13Controller::class, 'index'])->name('Jurubeli1_13.index');
Route::get('/Jurubeli1_13/{id}', [Jurubeli1_13Controller::class, 'show'])->name('Jurubeli1_13.show');
Route::post('/Jurubeli1_13/{id}/setujui', [Jurubeli1_13Controller::class, 'setujui'])->name('Jurubeli1_13.setujui');
Route::post('/Jurubeli1_13/{id}/tolak', [Jurubeli1_13Controller::class, 'tolak'])->name('Jurubeli1_13.tolak');
Route::get('/Jurubeli1_13/{id}/json', [Jurubeli1_13Controller::class, 'showJson'])->name('Jurubeli1_13.showJson');

//Jurubeli_14
Route::get('/Jurubeli1_14', [Jurubeli1_14Controller::class, 'index'])->name('Jurubeli1_14.index');
Route::get('/Jurubeli1_14/{id}', [Jurubeli1_14Controller::class, 'show'])->name('Jurubeli1_14.show');
Route::post('/Jurubeli1_14/{id}/setujui', [Jurubeli1_14Controller::class, 'setujui'])->name('Jurubeli1_14.setujui');
Route::post('/Jurubeli1_14/{id}/tolak', [Jurubeli1_14Controller::class, 'tolak'])->name('Jurubeli1_14.tolak');
Route::get('/Jurubeli1_14/{id}/json', [Jurubeli1_14Controller::class, 'showJson'])->name('Jurubeli1_14.showJson');
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) 
{return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\DataKitchenController;
Route::get('data_kitchen', [DataKitchenController::class, 'index']);
Route::post('data_kitchen', [DataKitchenController::class, 'store']);
Route::get('data_kitchen/search', [DataKitchenController::class, 'showByLantaiAndUnit']);
Route::put('data_kitchen/update', [DataKitchenController::class, 'updateByLantaiAndUnit']);
Route::delete('data_kitchen/delete', [DataKitchenController::class, 'destroyByLantaiAndUnit']);
Route::get('/problematic-units', [DataKitchenController::class, 'getProblematicUnits']);


use App\Http\Controllers\TabelLantaiController;
Route::get('tabel_lantai', [TabelLantaiController::class, 'index']);
Route::post('tabel_lantai', [TabelLantaiController::class, 'store']);
Route::get('tabel_lantai/{lantai}', [TabelLantaiController::class, 'show']);
Route::put('tabel_lantai/{lantai}', [TabelLantaiController::class, 'update']);
Route::delete('tabel_lantai/{lantai}', [TabelLantaiController::class, 'destroy']);


use App\Http\Controllers\UnitController;
Route::get('units', [UnitController::class, 'index']);
Route::post('units', [UnitController::class, 'store']);
Route::get('units/{nama_unit}', [UnitController::class, 'show']);
Route::put('units/{nama_unit}', [UnitController::class, 'update']);
Route::delete('units/{nama_unit}', [UnitController::class, 'destroy']);


use App\Http\Controllers\DataStatikController;
Route::get('/data-statik', [DataStatikController::class, 'index']);
Route::post('/data-statik', [DataStatikController::class, 'store']);
Route::get('/data-statik/{type_unit}', [DataStatikController::class, 'showByTypeUnit']);
Route::put('/data-statik/{type_unit}', [DataStatikController::class, 'update']);
Route::delete('/data-statik/{type_unit}', [DataStatikController::class, 'destroy']);

use App\Http\Controllers\UserStaffController;
Route::apiResource('user_staff', UserStaffController::class);

use App\Http\Controllers\UserAdminController;
Route::apiResource('user_admin', UserAdminController::class);

use App\Http\Controllers\UserVendorController;
Route::apiResource('user_vendor', UserVendorController::class);

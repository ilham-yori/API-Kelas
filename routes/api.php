<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\NilaiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('kelas', KelasController::class)->only(['store','update']);
Route::get('kelas/list', [KelasController::class, 'list']);
Route::get('kelas/detail/{id}', [KelasController::class, 'detail']);

Route::resource('murid', MuridController::class)->only(['store',]);
Route::get('murid/list', [MuridController::class, 'list']);
Route::get('murid/detail/{id}', [MuridController::class,'detail']);

Route::resource('nilai', NilaiController::class)->only(['store']);
Route::get('nilai/detail/{mata_pelajaran}', [NilaiController::class,'showByMataPelajaran']);



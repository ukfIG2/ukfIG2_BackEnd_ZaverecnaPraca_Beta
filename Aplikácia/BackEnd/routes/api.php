<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\StageController;

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

Route::get('/conferences', [ConferenceController::class, 'index']);
Route::post('/conferences', [ConferenceController::class, 'store']);
Route::get('/conferences/{id}', [ConferenceController::class, 'show']);
Route::put('/conferences/{id}', [ConferenceController::class, 'update']);
Route::delete('/conferences/{id}', [ConferenceController::class, 'destroy']);

Route::get('/stages', [StageController::class, 'index']);
Route::post('/stages', [StageController::class, 'store']);
Route::get('/stages/{id}', [StageController::class, 'show']);
Route::put('/stages/{id}', [StageController::class, 'update']);
Route::delete('/stages/{id}', [StageController::class, 'destroy']);


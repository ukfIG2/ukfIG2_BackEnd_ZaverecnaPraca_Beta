<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\Time_tableController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ImageController;

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

Route::get('/time_tables', [Time_tableController::class, 'index']);
Route::post('/time_tables', [Time_tableController::class, 'store']);
Route::get('/time_tables/{id}', [Time_tableController::class, 'show']);
Route::put('/time_tables/{id}', [Time_tableController::class, 'update']);
Route::delete('/time_tables/{id}', [Time_tableController::class, 'destroy']);

Route::get('/presentations', [PresentationController::class, 'index']);
Route::post('/presentations', [PresentationController::class, 'store']);
Route::get('/presentations/{id}', [PresentationController::class, 'show']);
Route::put('/presentations/{id}', [PresentationController::class, 'update']);
Route::delete('/presentations/{id}', [PresentationController::class, 'destroy']);

Route::get('/sponsors', [SponsorController::class, 'index']);
Route::post('/sponsors', [SponsorController::class, 'store']);
Route::get('/sponsors/{id}', [SponsorController::class, 'show']);
Route::put('/sponsors/{id}', [SponsorController::class, 'update']);
Route::delete('/sponsors/{id}', [SponsorController::class, 'destroy']);

Route::get('/speakers', [SpeakerController::class, 'index']);
Route::post('/speakers', [SpeakerController::class, 'store']);
Route::get('/speakers/{id}', [SpeakerController::class, 'show']);
Route::put('/speakers/{id}', [SpeakerController::class, 'update']);
Route::delete('/speakers/{id}', [SpeakerController::class, 'destroy']);

Route::post('/adminRegister', [AdministrationController::class, 'register']);
Route::post('/adminLogin', [AdministrationController::class, 'login']);

Route::post('/participantRegister', [ParticipantController::class, 'register']);
Route::post('/participantLogin', [ParticipantController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/adminLogout', [AdministrationController::class, 'logout']);;
    Route::post('participantLogout', [ParticipantController::class, 'logout']);
});
/*
Route::middleware(['auth:sanctum', 'checkUserParticipant'])->group(function () {
    Route::post('participantLogout', [ParticipantController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'checkUserAdministration'])->group(function () {
    Route::post('/adminLogout', [AdministrationController::class, 'logout']);
});*/


Route::get('/administrations', [AdministrationController::class, 'index']);
Route::delete('/administrations/{id}', [AdministrationController::class, 'destroy']);
Route::put('/changePassword', [AdministrationController::class, 'changePassword']);
Route::put('/changeComment', [AdministrationController::class, 'changeComment']);

Route::get('/participants', [ParticipantController::class, 'index']);
Route::post('/participants', [ParticipantController::class, 'store']);
Route::get('/participants/{id}', [ParticipantController::class, 'show']);
Route::put('/participants/{id}', [ParticipantController::class, 'update']);
Route::delete('/participants/{id}', [ParticipantController::class, 'destroy']);

Route::post('/upload', [ImageController::class, 'upload']);
Route::get('/images', [ImageController::class, 'index']);
Route::delete('/images/{id}', [ImageController::class, 'delete']);
Route::put('/images/{id}', [ImageController::class, 'update']);
Route::get('/images/{id}', [ImageController::class, 'show']);
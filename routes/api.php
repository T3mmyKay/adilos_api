<?php

use App\Http\Controllers\RecordingController;
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
Route::get('/recordings', [RecordingController::class, 'index']);
Route::get('/recordings/{id}', [RecordingController::class, 'show']);
Route::post('/recordings', [RecordingController::class, 'store']);
Route::put('/recordings/{id}', [RecordingController::class, 'update']);
Route::delete('/recordings/{id}', [RecordingController::class, 'destroy']);


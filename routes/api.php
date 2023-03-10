<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\ZipCodeController;
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

Route::controller(PatientController::class)->group(function () {
    Route::post('/patients', 'store');
    Route::get('/patients', 'index');
    Route::get('/patients/{patientId}', 'show');
    Route::delete('/patients/{patientId}', 'destroy');
    Route::put('/patients/{patientId}', 'update');
    Route::post('/patients/import', 'import')->name('import');
});

Route::get('/zipcode/{code}', [ZipCodeController::class, 'find']);

Route::get('/', function () use ($router) {
    return 'api patient';
});
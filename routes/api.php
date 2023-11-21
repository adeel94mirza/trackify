<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\VisitsController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // need to add in a separate file later when v2 is in development
    Route::prefix('v1')->group(function () {
        // logs new visit
        Route::get('/track-visit/{externalId}', [VisitsController::class, 'trackVisit']);
    
        // updates visit stage
        Route::patch('/update-stage', [VisitsController::class, 'updateStage']);
    });    
});


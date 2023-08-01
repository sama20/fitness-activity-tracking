<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;

Route::prefix('activities')->group(function () {
    Route::get('/', [ActivityController::class, 'getAllActivities']);
    Route::get('/{type}', [ActivityController::class, 'getActivitiesByType']);
    Route::get('/{type}/total-distance', [ActivityController::class, 'getTotalDistanceByType']);
    Route::get('/{type}/total-time', [ActivityController::class, 'getTotalTimeByType']);

    Route::post('/', [ActivityController::class, 'store']);
});




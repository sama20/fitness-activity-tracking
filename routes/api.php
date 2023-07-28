<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;

Route::get('activities', [ActivityController::class, 'getAllActivities']);
Route::get('activities/{type}', [ActivityController::class, 'getActivitiesByType']);
Route::get('activities/{type}/total-distance', [ActivityController::class, 'getTotalDistanceByType']);
Route::get('activities/{type}/total-time', [ActivityController::class, 'getTotalTimeByType']);

Route::post('/activities', [ActivityController::class, 'store']);


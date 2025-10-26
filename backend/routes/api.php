<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

// Debug-Ping zum schnellen Test
Route::get('ping', fn () => response()->json(['ok' => true], 200));

// REST-Routen für Kurse
Route::apiResource('courses', CourseController::class);

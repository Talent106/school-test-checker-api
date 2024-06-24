<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());

    Route::apiResource('schools', SchoolController::class);
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('students', StudentController::class);
    Route::post('attachments/upload', [AttachmentController::class, 'upload']);
    Route::apiResource('attachments', AttachmentController::class);
});

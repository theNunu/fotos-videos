<?php

use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('any', [FileController::class, 'any']);
Route::get('files', [FileController::class, 'index']);

Route::prefix('news')->group(function () {
    Route::get('', [NewsController::class, 'index']);
    Route::post('create', [NewsController::class, 'create']);
    Route::get('{new_id}', [NewsController::class, 'show']);
    Route::put('{new_id}', [NewsController::class, 'update']);

});

Route::post('files/upload', [FileController::class, 'upload']);
Route::get('/files/{id}', [FileController::class, 'show']);

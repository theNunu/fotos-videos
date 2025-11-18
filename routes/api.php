<?php

use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::get('any', [FileController::class, 'any']);
Route::get('files', [FileController::class, 'index']);

Route::post('news', [NewsController::class, 'create']);

Route::post('files/upload', [FileController::class, 'upload']);
Route::get('/files/{id}', [FileController::class, 'show']);

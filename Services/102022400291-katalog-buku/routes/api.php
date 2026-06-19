<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

Route::middleware('apikey')->group(function () {
Route::get('/v1/catalog/books', [BookController::class, 'index']);
Route::get('/v1/catalog/books/{id}', [BookController::class, 'show']);
Route::post('/v1/catalog/books', [BookController::class, 'store']);

});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Services\MemberService;

Route::middleware('apikey')->group(function () {
Route::get('/v1/catalog/books', [BookController::class, 'index']);
Route::get('/v1/catalog/books/{id}', [BookController::class, 'show']);
Route::post('/v1/catalog/books', [BookController::class, 'store']);
Route::get('/catalog/member/{memberId}/books',[BookController::class, 'booksForMember']);
});

Route::get('/test-member/{id}', function ($id) {
    return MemberService::getMemberStatus($id);
});
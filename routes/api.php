<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/create', [UserController::class, 'store']);
Route::get('/login', [UserController::class, 'login']);
Route::get('/getall', [UserController::class, 'index'])
->middleware(CheckToken::class);
Route::get('/get{id}', [UserController::class, 'show']);


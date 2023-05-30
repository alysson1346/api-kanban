<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

//Rotas User
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

//Rotas Card com autenticação obrigatória
Route::group(['middleware' => ['jwt.auth']], function () {
    Route::get('/card', [CardController::class, 'index']);
    Route::get('/card/{id}', [CardController::class, 'show']);
    Route::post('/card', [CardController::class, 'store']);
    Route::put('/card/{id}', [CardController::class, 'update']);
    Route::delete('/card/{id}', [CardController::class, 'destroy']);    
}); 


<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', [UserContoller::class,'user'])->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
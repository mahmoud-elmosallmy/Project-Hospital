<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;


Route::get('/user', [UserController::class,'user'])->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('services', ServiceController::class);
Route::apiResource('audit-logs', AuditLogController::class);
Route::apiResource('appointments', AppointmentController::class);
Route::apiResource('doctor-schedules', DoctorScheduleController::class);
Route::apiResource('notifications', NotificationController::class);
Route::apiResource('medical-records', MedicalRecordController::class);
<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ContactMessagesController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorDepartmentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;


Route::apiResource('/users', UserController::class);
Route::apiResource('/doctors', DoctorController::class);
Route::apiResource('/role', RoleController::class);
Route::apiResource('/patient', PatientController::class);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// إنشاء جميع crud لل department
Route::get("/departments",[DepartmentController::class, 'index']);
Route::post("/departments",[DepartmentController::class, 'store']);
Route::get("/departments/{id}",[DepartmentController::class, 'show']);
Route::post('/departments/{id}', [DepartmentController::class, 'update']);
Route::delete('/departments/{id}', [DepartmentController::class, 'destroy']);


Route::get("/doctors_department",[DoctorDepartmentController::class, 'index']);
Route::post("/doctors_department",[DoctorDepartmentController::class, 'store']);
Route::get('/doctors_department/{id}',[DoctorDepartmentController::class, 'show']);
Route::post('/doctors_department/{id}',[DoctorDepartmentController::class,'update']);
Route::delete('/doctors_department/{id}',[DoctorDepartmentController::class,'destroy']);

Route::get('/contact_message',[ContactMessagesController::class,'index']);
Route::post('/contact_message',[ContactMessagesController::class,'store']);
Route::get('/contact_message/{id}',[ContactMessagesController::class,'show']);
Route::post('/contact_message/{id}',[ContactMessagesController::class,'update']);
Route::delete('/contact_message/{id}',[ContactMessagesController::class,'destroy']);

Route::get('/setting',[SettingController::class,'index']);
Route::post('/setting',[SettingController::class,'store']);
Route::get('/setting/{id}',[SettingController::class,'show']);
Route::post('/setting/{id}',[SettingController::class,'update']);


Route::get('/user', [UserController::class,'user'])->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('services', ServiceController::class);
Route::apiResource('audit-logs', AuditLogController::class);
Route::apiResource('appointments', AppointmentController::class);
Route::apiResource('doctor-schedules', DoctorScheduleController::class);
Route::apiResource('notifications', NotificationController::class);
Route::apiResource('medical-records', MedicalRecordController::class);


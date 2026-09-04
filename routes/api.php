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
use App\Models\Permission;
use App\Models\Role;

Route::get('/test-role', function () {

    $admin = Role::where('name', 'Admin')->firstOrFail();
    $permissions = Permission::all()->keyBy("name");
    return response()->json($permissions);
});

Route::middleware(['auth:sanctum'])->group(function () {
    // mnia
    Route::apiResource('/users', UserController::class);
    Route::apiResource('/doctors', DoctorController::class);
    Route::apiResource('/role', RoleController::class);
    Route::apiResource('/patient', PatientController::class);

    // mahmoud

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource("/departments",DepartmentController::class)
        ->middlewareFor(['index','show'],'permission:departments.view')
        ->middlewareFor('store', 'permission:departments.create')
        ->middlewareFor('update', 'permission:departments.update')
        ->middlewareFor('destroy', 'permission:departments.delete');

    Route::apiResource("/doctors_department",DoctorDepartmentController::class)
        ->middlewareFor(['index','show'],'permission:departments.view')
        ->middlewareFor('store', 'permission:departments.create')
        ->middlewareFor('update', 'permission:departments.update')
        ->middlewareFor('destroy', 'permission:departments.delete');

    Route::apiResource("/contact_message",ContactMessagesController::class)
        ->middlewareFor(['index','show'],'permission:departments.view')
        ->middlewareFor('store', 'permission:departments.create')
        ->middlewareFor('update', 'permission:departments.update')
        ->middlewareFor('destroy', 'permission:departments.delete');

    Route::apiResource("/setting",SettingController::class)
        ->middlewareFor(['index','show'],'permission:departments.view')
        ->middlewareFor('store', 'permission:departments.create')
        ->middlewareFor('update', 'permission:departments.update')
        ->middlewareFor('destroy', 'permission:departments.delete');

    // othman
    Route::apiResource('services', ServiceController::class);
    Route::apiResource('audit-logs', AuditLogController::class);
    Route::apiResource('appointments', AppointmentController::class);
    Route::apiResource('doctor-schedules', DoctorScheduleController::class);
    Route::apiResource('notifications', NotificationController::class);
    Route::apiResource('medical-records', MedicalRecordController::class);
});




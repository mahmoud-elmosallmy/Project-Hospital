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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    // mnia
    Route::apiResource('/users', UserController::class)
       ->middleware([
        'index' => 'permission:users.view',
        'show' => 'permission:users.view',
        'store' => 'permission:users.create',
        'update' => 'permission:users.update',
        'destroy' => 'permission:users.delete',
    ])
    ;
    Route::apiResource('/doctors', DoctorController::class)
        ->middleware([
        'index' => 'permission:doctors.view',
        'show' => 'permission:doctors.view',
        'store' => 'permission:doctors.create',
        'update' => 'permission:doctors.update',
        'destroy' => 'permission:doctors.delete',
    ])
    ;
    Route::apiResource('/roles', RoleController::class)
      ->middleware([
        'index' => 'permission:roles.view',
        'show' => 'permission:roles.view',
        'store' => 'permission:roles.create',
        'update' => 'permission:roles.update',
        'destroy' => 'permission:roles.delete',
    ])
    ;
    Route::apiResource('/patients', PatientController::class)
       ->middleware([
        'index' => 'permission:patients.view',
        'show' => 'permission:patients.view',
        'store' => 'permission:patients.create',
        'update' => 'permission:patients.update',
        'destroy' => 'permission:patients.delete',
    ])
    ;

    // mahmoud


    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource("/departments", DepartmentController::class)
        ->middleware([
        'index' => 'permission:departments.view',
        'show' => 'permission:departments.view',
        'store' => 'permission:departments.create',
        'update' => 'permission:departments.update',
        'destroy' => 'permission:departments.delete',
    ]);

    Route::apiResource("/doctors_departments", DoctorDepartmentController::class)
     ->middleware([
        'index' => 'permission:doctor_departments.view',
        'show' => 'permission:doctor_departments.view',
        'store' => 'permission:doctor_departments.create',
        'update' => 'permission:doctor_departments.update',
        'destroy' => 'permission:doctor_departments.delete',
    ]);

    Route::apiResource("/contact_messages", ContactMessagesController::class)
  ->middleware([
        'index' => 'permission:contact_messages.view',
        'show' => 'permission:contact_messages.view',
        'store' => 'permission:contact_messages.create',
        'update' => 'permission:contact_messages.update',
        'destroy' => 'permission:contact_messages.delete',
    ]);

    Route::apiResource("/settings", SettingController::class)
   ->middleware([
        'index' => 'permission:settings.view',
        'show' => 'permission:settings.view',
        'store' => 'permission:settings.create',
        'update' => 'permission:settings.update',
        'destroy' => 'permission:settings.delete',
    ]);

    // othman
    Route::apiResource('services', ServiceController::class)
    ->middleware([
        'index' => 'permission:services.view',
        'show' => 'permission:services.view',
        'store' => 'permission:services.create',
        'update' => 'permission:services.update',
        'destroy' => 'permission:services.delete',
    ])
    ;
    Route::apiResource('audit_logs', AuditLogController::class)
    ->middleware([
        'index' => 'permission:audit_logs.view',
        'show' => 'permission:audit_logs.view',
        'store' => 'permission:audit_logs.create',
        'update' => 'permission:audit_logs.update',
        'destroy' => 'permission:audit_logs.delete',
    ])
    ;
    Route::apiResource('appointments', AppointmentController::class)
    ->middleware([
        'index' => 'permission:appointments.view',
        'show' => 'permission:appointments.view',
        'store' => 'permission:appointments.create',
        'update' => 'permission:appointments.update',
        'destroy' => 'permission:appointments.delete',
    ]);
    Route::apiResource('doctor_schedules', DoctorScheduleController::class)
    ->middleware([
        'index' => 'permission:doctor_schedules.view',
        'show' => 'permission:doctor_schedules.view',
        'store' => 'permission:doctor_schedules.create',
        'update' => 'permission:doctor_schedules.update',
        'destroy' => 'permission:doctor_schedules.delete',
    ])
    ;
    Route::apiResource('notifications', NotificationController::class)
    ->middleware([
        'index' => 'permission:notifications.view',
        'show' => 'permission:notifications.view',
        'store' => 'permission:notifications.create',
        'update' => 'permission:notifications.update',
        'destroy' => 'permission:notifications.delete',
    ])
    ;
    Route::apiResource('medical_records', MedicalRecordController::class)
    ->middleware([
        'index' => 'permission:medical_records.view',
        'show' => 'permission:medical_records.view',
        'store' => 'permission:medical_records.create',
        'update' => 'permission:medical_records.update',
        'destroy' => 'permission:medical_records.delete',
    ])
    ;
});

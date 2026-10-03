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

// Route::get('/test-role', function () {

//     $admin = Role::where('name', 'Admin')->firstOrFail();
//     $permissions = Permission::all()->keyBy("name");
//     return response()->json($permissions);
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json([
        'user' => $request->user()
    ]);
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    // mnia
  Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->middleware('permission:users.view');
        Route::get('/{id}', [UserController::class, 'show'])->middleware('permission:users.view');
        Route::post('/', [UserController::class, 'store'])->middleware('permission:users.create');
        Route::put('/{id}', [UserController::class, 'update'])->middleware('permission:users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->middleware('permission:users.delete');
    });
    Route::prefix('doctors')->group(function () {
        Route::get('/', [DoctorController::class, 'index'])->middleware('permission:doctors.view');
        Route::get('/{id}', [DoctorController::class, 'show'])->middleware('permission:doctors.view');
        Route::post('/', [DoctorController::class, 'store'])->middleware('permission:doctors.create');
        Route::put('/{id}', [DoctorController::class, 'update'])->middleware('permission:doctors.update');
        Route::delete('/{id}', [DoctorController::class, 'destroy'])->middleware('permission:doctors.delete');
    });
  Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->middleware('permission:roles.view');
        Route::get('/{id}', [RoleController::class, 'show'])->middleware('permission:roles.view');
        Route::post('/', [RoleController::class, 'store'])->middleware('permission:roles.create');
        Route::put('/{id}', [RoleController::class, 'update'])->middleware('permission:roles.update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->middleware('permission:roles.delete');
    });
 Route::prefix('patients')->group(function () {
        Route::get('/', [PatientController::class, 'index'])->middleware('permission:patients.view');
        Route::get('/{id}', [PatientController::class, 'show'])->middleware('permission:patients.view');
        Route::post('/', [PatientController::class, 'store'])->middleware('permission:patients.create');
        Route::put('/{id}', [PatientController::class, 'update'])->middleware('permission:patients.update');
        Route::delete('/{id}', [PatientController::class, 'destroy'])->middleware('permission:patients.delete');
    });

    // mahmoud


    Route::post('/logout', [AuthController::class, 'logout']);

  Route::apiResource("/departments",DepartmentController::class)
        ->middlewareFor(['index','show'],'permission:departments.view')
        ->middlewareFor('store', 'permission:departments.create')
        ->middlewareFor('update', 'permission:departments.update')
        ->middlewareFor('destroy', 'permission:departments.delete');

  Route::apiResource("/doctor_departments",DoctorDepartmentController::class)
        ->middlewareFor(['index','show'],'permission:departments.view')
        ->middlewareFor('store', 'permission:departments.create')
        ->middlewareFor('update', 'permission:departments.update')
        ->middlewareFor('destroy', 'permission:departments.delete');

  Route::apiResource("/contact_messages",ContactMessagesController::class)
        ->middlewareFor(['index','show'],'permission:departments.view')
        ->middlewareFor('store', 'permission:departments.create')
        ->middlewareFor('update', 'permission:departments.update')
        ->middlewareFor('destroy', 'permission:departments.delete');

  Route::apiResource("/settings",ContactMessagesController::class)
        ->middlewareFor(['index','show'],'permission:departments.view')
        ->middlewareFor('store', 'permission:departments.create')
        ->middlewareFor('update', 'permission:departments.update')
        ->middlewareFor('destroy', 'permission:departments.delete');

    // othman
   Route::prefix('services')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->middleware('permission:services.view');
        Route::get('/{id}', [ServiceController::class, 'show'])->middleware('permission:services.view');
        Route::post('/', [ServiceController::class, 'store'])->middleware('permission:services.create');
        Route::put('/{id}', [ServiceController::class, 'update'])->middleware('permission:services.update');
        Route::delete('/{id}', [ServiceController::class, 'destroy'])->middleware('permission:services.delete');
    });
   Route::prefix('audit_logs')->group(function () {
        Route::get('/', [AuditLogController::class, 'index'])->middleware('permission:audit_logs.view');
        Route::get('/{id}', [AuditLogController::class, 'show'])->middleware('permission:audit_logs.view');
    });
  Route::prefix('appointments')->group(function () {
        Route::get('/', [AppointmentController::class, 'index'])->middleware('permission:appointments.view');
        Route::get('/{id}', [AppointmentController::class, 'show'])->middleware('permission:appointments.view');
        Route::post('/', [AppointmentController::class, 'store'])->middleware('permission:appointments.create');
        Route::put('/{id}', [AppointmentController::class, 'update'])->middleware('permission:appointments.update');
        Route::delete('/{id}', [AppointmentController::class, 'destroy'])->middleware('permission:appointments.delete');
    });
    Route::prefix('doctor_schedules')->group(function () {
        Route::get('/', [DoctorScheduleController::class, 'index'])->middleware('permission:doctor_schedules.view');
        Route::get('/{id}', [DoctorScheduleController::class, 'show'])->middleware('permission:doctor_schedules.view');
        Route::post('/', [DoctorScheduleController::class, 'store'])->middleware('permission:doctor_schedules.create');
        Route::put('/{id}', [DoctorScheduleController::class, 'update'])->middleware('permission:doctor_schedules.update');
        Route::delete('/{id}', [DoctorScheduleController::class, 'destroy'])->middleware('permission:doctor_schedules.delete');
    });
   Route::prefix('notifications')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->middleware('permission:notifications.view');
        Route::get('/{id}', [NotificationController::class, 'show'])->middleware('permission:notifications.view');
        Route::post('/', [NotificationController::class, 'store'])->middleware('permission:notifications.create');
        Route::put('/{id}', [NotificationController::class, 'update'])->middleware('permission:notifications.update');
        Route::delete('/{id}', [NotificationController::class, 'destroy'])->middleware('permission:notifications.delete');
    });
 Route::prefix('medical_records')->group(function () {
        Route::get('/', [MedicalRecordController::class, 'index'])->middleware('permission:medical_records.view');
        Route::get('/{id}', [MedicalRecordController::class, 'show'])->middleware('permission:medical_records.view');
        Route::post('/', [MedicalRecordController::class, 'store'])->middleware('permission:medical_records.create');
        Route::put('/{id}', [MedicalRecordController::class, 'update'])->middleware('permission:medical_records.update');
        Route::delete('/{id}', [MedicalRecordController::class, 'destroy'])->middleware('permission:medical_records.delete');
    });
});
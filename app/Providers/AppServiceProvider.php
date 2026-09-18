<?php

namespace App\Providers;

use App\Models\Appointment;
use App\Models\DoctorDepartment;
use App\Models\DoctorSchedule;
use App\Models\MedicalRecord;
use App\Policies\MedicalRecordPolicy;
use App\Models\Patient;
use App\Models\User;
use App\Policies\AppointmentPolicy;
use App\Policies\DoctorDepartmentPolicy;
use App\Policies\DoctorSchedulePolicy;
use App\Policies\PatientPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(DoctorSchedule::class , DoctorSchedulePolicy::class);
        Gate::policy(Appointment::class , AppointmentPolicy::class);
        Gate::policy(DoctorDepartment::class , DoctorDepartmentPolicy::class);
        Gate::policy(Patient::class , PatientPolicy::class);
        Gate::policy(MedicalRecord::class , MedicalRecordPolicy::class);
        Gate::policy(User::class , UserPolicy::class);
    }
}

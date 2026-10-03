<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DoctorDepartment;

class DoctorDepartmentPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->role_id === 1) {
            return true;
        }
        return null;
    }

    public function view(User $user, DoctorDepartment $doctorDepartment): bool
    {
        if ($user->role_id === 3) {
            return true;
        }
        if ($user->role_id === 2) {
            $doctor = \App\Models\Doctor::where('user_id', $user->id)->first();
            return $doctor && $doctor->id === $doctorDepartment->doctor_id;
        }
        return false;
    }
}

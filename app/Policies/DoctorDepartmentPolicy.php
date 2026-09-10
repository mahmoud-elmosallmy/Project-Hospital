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
        return $user->id === $doctorDepartment->doctor_id;
    }
   
}
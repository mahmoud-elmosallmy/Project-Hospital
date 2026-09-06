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
        return $user->id === $doctorDepartment->doctor_id;
    }

    public function delete(User $user, DoctorDepartment $doctorDepartment): bool
    {
        return $user->id === $doctorDepartment->doctor_id;
    }
}
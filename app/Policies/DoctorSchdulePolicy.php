<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DoctorSchedule;

class DoctorSchedulePolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->role_id === 1) {
            return true;
        }
        return null;
    }

    public function view(User $user, DoctorSchedule $doctorSchedule): bool
    {
        if ($user->role_id === 3 || $user->role_id === 4) {
            return true;
        }
        return $user->id === $doctorSchedule->doctor_id;
    }

    public function create(User $user): bool
    {
        return $user->role_id === 2; // Only doctors can create schedules and admin can create schedules
    }
    public function update(User $user, DoctorSchedule $doctorSchedule): bool
    {
        return $user->id === $doctorSchedule->doctor_id;
    }

    public function delete(User $user, DoctorSchedule $doctorSchedule): bool
    {
        return $user->id === $doctorSchedule->doctor_id;
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Appointment;

class AppointmentPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->role_id === 1) {
            return true;
        }
        return null;
    }

   public function view(User $user, Appointment $appointment): bool
    {
        return $user->id === $appointment->doctor_id 
            || $user->id === optional($appointment->patient)->user_id;
    }

    public function update(User $user, Appointment $appointment): bool
    {
        return $user->id === $appointment->doctor_id;
    }

    public function delete(User $user, Appointment $appointment): bool
    {
        return $user->id === $appointment->doctor_id;
    }
}
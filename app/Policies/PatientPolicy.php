<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Patient;

class PatientPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->role_id === 1) {
            return true;
        }
        return null;
    }

    public function view(User $user, Patient $patient): bool
    {
      
        return $patient->appointments()->where('doctor_id', $user->id)->exists()
            || $patient->medicalRecords()->where('doctor_id', $user->id)->exists();
    }
}
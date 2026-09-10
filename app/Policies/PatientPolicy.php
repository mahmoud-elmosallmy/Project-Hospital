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
      if ($user->role_id === 3) {
            return true;
        }
        return $patient->appointments()->where('doctor_id', $user->id)->exists()
            || $patient->medicalRecords()->where('doctor_id', $user->id)->exists();
    }
    public function create(User $user): bool
    {
      if ($user->role_id === 3) {
            return true;
        }
        return false;
    }
    public function update(User $user, Patient $patient): bool
    {
      if ($user->role_id === 3) {
            return true;
        }
        return false;
    }
    public function delete(User $user, Patient $patient): bool
    {
      if ($user->role_id === 3) {
            return true;
        }
        return false;
    }
}
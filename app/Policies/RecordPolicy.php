<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MedicalRecord;

class RecordPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->role_id === 1) {
            return true;
        }
        return null; 
    }
    public function view(User $user, MedicalRecord $record): bool
    {
        return $user->id === $record->doctor_id
        || $user->id === optional($record->patient)->user_id;
    }
    public function create(User $user): bool
    {
        return $user->role_id === 2;
    }
    public function update(User $user, MedicalRecord $record): bool
    {
        return $user->id === $record->doctor_id;
    }
    public function delete(User $user, MedicalRecord $record): bool
    {
        return $user->id === $record->doctor_id;
    }
}
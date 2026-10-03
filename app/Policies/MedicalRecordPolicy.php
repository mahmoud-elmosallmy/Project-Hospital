<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MedicalRecord;

class MedicalRecordPolicy
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
        
        if($user->role_id === 2){
             $doctor = \App\Models\Doctor::where('user_id', $user->id)->first();
    return $doctor && $doctor->id === $record->doctor_id;
        }
     return optional($record->patient)->user_id === $user->id;
    }
    public function create(User $user): bool
    {
        return $user->role_id === 2;
    }
    public function update(User $user, MedicalRecord $record): bool
    {
           if($user->role_id === 2){
             $doctor = \App\Models\Doctor::where('user_id', $user->id)->first();
    return $doctor && $doctor->id === $record->doctor_id;
        }
     return false;
    }
    
    public function delete(User $user, MedicalRecord $record): bool
    {
        return false;
    }
}
<?php
namespace App\Policies;
use App\Models\User;
use App\Models\Appointment;
class AppointmentPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->role_id === 1 || $user->role_id === 3) {
            return true;
        }
        return null;
    }
public function viewAny(User $user): bool
{
    return true;
}
public function view(User $user, Appointment $appointment): bool
{
   
    if (in_array($user->role_id, [1, 3])) {
        return true;
    }
    if ($user->role_id === 2) {
        $doctor = \App\Models\Doctor::where('user_id', $user->id)->first();
        return $doctor && $doctor->id === $appointment->doctor_id;
    }
    return optional($appointment->patient)->user_id === $user->id;
}
    public function create(User $user): bool
    {
        return $user->role_id === 4; //patient can create appointment
    }
    public function update(User $user, Appointment $appointment): bool
    {
        return $user->id === $appointment->doctor_id;
    }

    public function delete(User $user, Appointment $appointment): bool
    {
        return false; // Only Admin and reception can delete appointments
    }
}
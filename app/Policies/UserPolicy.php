<?php
namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role_id == 1; 
    }

    public function view(User $user, User $model): bool
    {
       
        return $user->role_id == 1 || $user->id === $model->id;
    }

  
    public function create(User $user): bool
    {
        return $user->role_id == 1;
    }

 
    public function update(User $user, User $model): bool
    {
       
        return $user->role_id == 1 || $user->id === $model->id;
    }

    
    public function delete(User $user, User $model): bool
    {
        return $user->role_id == 1;
    }
}

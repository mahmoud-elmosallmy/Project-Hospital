<?php

namespace App\Models;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\LogsActivity;

class User extends Authenticatable

{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity;
    protected $fillable = [
        'first_name',
        'last_name',
        'role_id',
        'email',
        'phone',
        'password',
        'status',
        'email_verified_at'
    ];
    protected static function booted()
    {
        static::saved(function ($user) {
            if ($user->role_id == 2 && !$user->doctor) {
                \App\Models\Doctor::create(['user_id' => $user->id]);
            }

            if ($user->role_id == 4 && !$user->patient) {
                \App\Models\Patient::create(['user_id' => $user->id]);
            }
        });
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'user_id');
    }

    public function patient()
    {
        return $this->hasOne(Patient::class, 'user_id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

 
}
    


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
        'license_number',
        'qualification',
        'specialization',
        'experience_years',
        'bio',
        'consultation_fee',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department() {
        return $this->belongsToMany(
            Department::class,
            "doctor_department",
        );
    }
}

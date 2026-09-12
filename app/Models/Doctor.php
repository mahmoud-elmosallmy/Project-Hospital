<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;
class Doctor extends Model
{
    use LogsActivity;
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
    public function doctorSchedules()
    {
        return $this->hasMany(DoctorSchedule::class);
    }
}

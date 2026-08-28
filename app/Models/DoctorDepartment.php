<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorDepartment extends Model
{
    protected $fillable = [
        'doctor_id',
        'department_id',
        ];

    public function doctor()
    {
     return $this->belongsTo(Doctor::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}


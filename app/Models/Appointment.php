<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;
class Appointment extends Model
{
    use HasFactory , LogsActivity;
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'doctor_schedule_id',
        'appointment_date',
        'appointment_time',
        'status',
        'notes',
    ];
}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;
class MedicalRecord extends Model
{
    use HasFactory , LogsActivity;
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_id',
        'diagnosis',
        'treatment',
        'prescription',
        'notes',
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}

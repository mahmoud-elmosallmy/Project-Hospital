<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogsActivity;
class Department extends Model
{
    use LogsActivity;
    protected $fillable = [
        "name",
        "description",
        "image_department",
        "status",
    ];
   
    public function doctors() {
        return $this->belongsToMany(
            Doctor::class,
            "doctor_department",
        );
    }
}

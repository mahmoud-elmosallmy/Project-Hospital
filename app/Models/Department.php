<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        "name",
        "description",
        "image_department",
        "status",
    ];
    /*
    status = 1
    القسم يعمل
    status = 0
    القسم متوقف
    -------------
    1 = Active
    0 = Inactive
    */

    public function doctors() {
        return $this->belongsToMany(
            Doctor::class,
            "doctor_department",
        );
    }
}

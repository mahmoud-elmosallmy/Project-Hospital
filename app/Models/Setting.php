<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        "hospital_name",
        "logo",
        "phone",
        "email",
        "address",
        "description",
        "facebook",
        "instagram",
        "status",
    ];
}

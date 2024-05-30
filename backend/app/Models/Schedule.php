<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['receptionist_id', 'patient_id', 'doctor_id', 'ubs_id', 'scheduled_time', 'status'];
}

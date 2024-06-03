<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['receptionist_id', 'patient_id', 'doctor_id', 'ubs_id', 'scheduled_time', 'status'];
    protected $hidden = [ 'created_at', 'updated_at', 'pivot'];
  
    public function assessment()
    {
        return $this->hasOne(Assessment::class);
    }

    public function doctor()
    {
        return $this->hasOne(User::class, "id", "doctor_id");
    }

    public function patient()
    {      
        return $this->hasOne(User::class, "id", "patient_id");
    }

    public function ubs()
    {      
        return $this->hasOne(UBS::class, "id", "ubs_id");
    }
}

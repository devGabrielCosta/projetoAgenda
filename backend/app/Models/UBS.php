<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UBS extends Model
{
    use HasFactory;

    protected $table = "ubs";

    protected $fillable = ['name'];

    public function doctors()
    {
        return $this->belongsToMany(User::class, 'doctors_ubs', 'ubs_id', 'doctor_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'ubs_id');
    }
}

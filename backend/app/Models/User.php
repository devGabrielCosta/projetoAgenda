<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Enums\UserType;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];
  
    public function UBS()
    {
        return $this->belongsToMany(User::class, 'doctors_ubs', 'doctor_id', 'ubs_id');
    }
}
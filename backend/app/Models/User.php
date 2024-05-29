<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];
  
    public function UBS()
    {
        if($this->type == App\Models\Enums\UserTypes::Doctor)
            return $this->belongsToMany(User::class, 'doctors_ubs', 'doctor_id', 'ubs_id');
    }
}
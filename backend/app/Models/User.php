<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];
    protected $hidden = [ 'created_at', 'updated_at', 'pivot'];
  
    public function UBS()
    {
        return $this->belongsToMany(UBS::class, 'doctors_ubs', 'doctor_id', 'ubs_id');
    }
   
    public function schedules()
    {   
        $pivot = [
            'Doctor' => 'doctor_id',
            'Patient' => 'patient_id',
            'Receptionist' =>'receptionist_id'
        ];
        
        $pivotKey = $pivot[$this->type] ?? null;
    
        if ($pivotKey) 
            return $this->hasMany(Schedule::class, $pivotKey);
        else 
            throw new \Exception("Tipo de usuário não suportado: {$this->type}");       
    }
}
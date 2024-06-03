<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;
    
    protected $fillable = ['schedule_id', 'comment'];
    protected $hidden = [ 'created_at', 'updated_at', 'pivot'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patientData extends Model
{
    use HasFactory;
    
    
    public $table="patients";
    protected $fillable = [
        'pname',
        'page',
        'assigned_user',
      
    ];

    public $timestamps = false;
}

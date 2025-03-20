<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class behaviroval_tracker extends Model
{
    use HasFactory;
    
     public $table="Behavioural_tracking";

    protected $fillable=[
        'pid',
        'uid',
        'data_details',
        'details',
        'page_source',
        'aid',
        'pname',
        'uname',
       
    ];

    public $timestamps=false;
}

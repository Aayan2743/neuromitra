<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class useraddressdetail extends Model
{
    use HasFactory;
    
       public $table="user_address";

    protected $fillable=[
        'uid',
        'Flat_no',
        'street',
        'area',
        'landmark',
        'pincode',
        'type_of_address',
        'address_name',
       
    ];

    public $timestamps=false;
}

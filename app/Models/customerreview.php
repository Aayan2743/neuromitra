<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customerreview extends Model
{
    use HasFactory;
    public $table="customer_reviwes";

    protected $fillable = [
        'app_id',
        'rating',
        'details',
        'page_source',
        'user_id',
        'user_name',
       
    ];

    public $timestamps = false;
}

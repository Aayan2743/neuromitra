<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assement_guide_answer extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $guarded=[];

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}

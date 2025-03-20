<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\useraddressdetail;
class appointments extends Model
{
    use HasFactory;

    public $table="appiontment";

    protected $fillable=[
        'Full_Name',
        'phone_Number',
        'appointment',
        'age',
        'appointment_type',
        'Date_of_appointment',
        'location',
        'page_source',
        'time_of_appointment',
        'user_id',
        'file_path',
        'rating_status',
        'pid',
    ];

    public $timestamps=false;

    public function therapist()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function location()
    {
        return $this->belongsTo(useraddressdetail::class, 'id', 'location'); // Assuming the primary key of the locations table is 'id'
    }


    public function session_details()
    {
        return $this->belongsTo(User::class,'user_id');
    }

            public function therapist_user()
        {
            return $this->belongsTo(User::class, 'therapist_id');
        }


}

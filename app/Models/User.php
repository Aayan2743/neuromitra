<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\appointments;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     public function getJWTIdentifier(){
        return $this->getKey();
     }
     
     public function getJWTCustomClaims(){
        return [];
     }
     

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'user_type',
    //     'phone',
    //     'user_profile',
    //     'fcm_token',
    //     'address_id',
    // ];
    
    protected $guarded = [];


    

  /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function patients()
    {
        return $this->hasMany(appointments::class);
    }

    public function appointnentdetails()
    {
        return $this->hasMany(appointments::class,'user_id');
    }


    public function healthReports()
    {
        return $this->hasMany(health_daily_reports::class, 'user_id');
    }
   


}

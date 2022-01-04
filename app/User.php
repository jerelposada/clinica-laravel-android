<?php

namespace App;

use App\Models\Specialty;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','identity_card','address','phone','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','pivot'
    ];


    public  function scopePatients($query){
        return $query->where('role','patient');
    }

    public  function scopeDoctors($query){
        return $query->where('role','doctor');
    }

    public function specialty(){
       return  $this->belongsToMany(Specialty::class)->withTimestamps();
    }
}

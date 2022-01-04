<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $table = 'specialties';

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}

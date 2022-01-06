<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Appointment extends Model
{
    protected $fillable = [
        'description' ,
        'specialty_id',
        'doctor_id',
        'patient_id',
        'scheduled_date',
        'scheduled_time',
        'type'
    ];

    //$appointment->specialty  n a 1
    public function specialty(){
        return $this->belongsTo(Specialty::class);
    }


    //$appointment->doctor n a 1
    public function doctor(){
        return $this->belongsTo(User::class);
    }

    //$appointment->doctor 1
    public function patient(){
        return $this->belongsTo(User::class);
    }



    // $appointment 1 -  1/0 CancelledAppointment
    //$appointment->cancelation->juatification
    public function cancellation(){
        return $this->hasOne(CancelledAppointment::class);
    }


    // accesor
    //$appointment->scheduled_time_12
    public function getScheduledTime12Attribute(){
            return (new Carbon($this->scheduled_time))->format('g:i A');
    }
}


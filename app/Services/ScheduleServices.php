<?php

namespace App\Services;

use App\interfaces\ScheduleServicesInterface;
use App\Models\Appointment;
use App\Models\WorkDay;
use Carbon\Carbon;

class ScheduleServices implements  ScheduleServicesInterface
{
    private  function  getDayFromDate($date){
        $dayCarbon = new Carbon($date);

        //dayOfweek
        //carbon :0 (sunday) -6(saturday)
        //workday: 0(monday)-6(sunday)
        $i = $dayCarbon->dayOfWeek;
        return $day = ($i==0? 6 :$i-1);


    }
    public function getAvailableIntervals($date, $doctorId)
    {

        $workDay =  WorkDay::where('active',true)->where('day',$this->getDayFromDate($date))->where('user_id',$doctorId)->first([
            'morning_start','morning_end','afternoon_start','afternoon_end'
        ]);

        if (!$workDay){
            return [];
        }
        $MorningIntervals = $this->getIntervals($workDay->morning_start,$workDay->morning_end,$date,$doctorId);
        $AfternoonIntervals = $this->getIntervals($workDay->afternoon_start,$workDay->afternoon_end,$date,$doctorId);

        $data = [];
        $data['MorningIntervals'] = $MorningIntervals;
        $data['AfternoonIntervals'] = $AfternoonIntervals;

        return $data;
    }

    private function  getIntervals($start , $end,$date,$doctorId){
        $Start = new Carbon($start);
        $End = new Carbon($end);
        $intervals = [];
        while($Start < $End){
            $interval = [];

            $interval['start'] = $Start->format('g:i A');
            $exists = Appointment::where('doctor_id',$doctorId)
                ->where('scheduled_date',$date)
                ->where('scheduled_time',$Start->format('H:i:s ')) ->exists();

            $Start->addMinutes(30);
            $interval['end'] = $Start->format('g:i A');


            if(!$exists){
                $intervals[] = $interval;
            }
        }

        return $intervals;
    }
}

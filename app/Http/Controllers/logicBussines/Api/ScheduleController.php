<?php

namespace App\Http\Controllers\logicBussines\Api;

use App\Http\Controllers\Controller;
use App\interfaces\ScheduleServicesInterface;
use App\Models\WorkDay;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function hours(Request $request, ScheduleServicesInterface $scheduleServices){
        $rules = [
            'date' =>'required|date_format:"Y-m-d"',
           'doctor_id'=>'required|exists:users,id'
        ];

        $this->validate($request,$rules);


        $date = $request->input('date');
        $dayCarbon = new Carbon($date);
        $doctorId = $request->input('doctor_id');

        return $scheduleServices->getAvailableIntervals($date,$doctorId);
    }

}

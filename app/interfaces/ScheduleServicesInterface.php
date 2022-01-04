<?php

namespace App\interfaces;

use Carbon\Carbon;

interface ScheduleServicesInterface
{
    public function getAvailableIntervals($date,$doctorId);
    public  function isAvailableInterval($date,$doctorId, Carbon $start);
}

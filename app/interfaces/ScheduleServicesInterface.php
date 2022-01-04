<?php

namespace App\interfaces;

interface ScheduleServicesInterface
{
    public function getAvailableIntervals($date,$doctorId);
}

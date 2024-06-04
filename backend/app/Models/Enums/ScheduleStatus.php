<?php

namespace App\Models\Enums;

enum ScheduleStatus
{
    case Created;
    case NoShow;
    case Attended;
}
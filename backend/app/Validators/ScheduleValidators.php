<?php

namespace App\Validators;
use App\Models\Enums\ScheduleStatus;

class ScheduleValidators
{
    public static function validStatus($attribute, $value, $parameters, $validator)
    {
        return in_array($value, array_column(ScheduleStatus::cases(), 'name'));
    }
}
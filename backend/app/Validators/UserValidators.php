<?php

namespace App\Validators;
use App\Models\User;
use App\Models\Enums\UserType;

class UserValidators
{
    public static function validUserType($attribute, $value, $parameters, $validator)
    {
        return in_array($value, array_column(UserType::cases(), 'name'));
    }

    public static function validPatient($attribute, $value, $parameters, $validator)
    {
        return User::where('id', $value)->where('type', 'Patient')->exists();
    }

    public static function validDoctor($attribute, $value, $parameters, $validator)
    {
        return User::where('id', $value)->where('type', 'Doctor')->exists();
    }
    public static function validReceptionist($attribute, $value, $parameters, $validator)
    {
        return User::where('id', $value)->where('type', 'Receptionist')->exists();
    }
}
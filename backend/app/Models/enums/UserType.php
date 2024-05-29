<?php

namespace App\Models\Enums;

enum UserType
{
    case Doctor;
    case Receptionist;
    case Patient;
}
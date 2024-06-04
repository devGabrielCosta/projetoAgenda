<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use App\Validators\UserValidators;
use App\Validators\ScheduleValidators;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('valid_user_type', [UserValidators::class, 'validUserType']);
        Validator::extend('valid_patient', [UserValidators::class, 'validPatient']);
        Validator::extend('valid_doctor', [UserValidators::class, 'validDoctor']);
        Validator::extend('valid_receptionist', [UserValidators::class, 'validReceptionist']);
        Validator::extend('valid_status', [ScheduleValidators::class, 'validStatus']);
    }
}

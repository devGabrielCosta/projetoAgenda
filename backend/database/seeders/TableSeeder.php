<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use App\Models\User;
use App\Models\UBS;
use App\Models\Schedule;

class TableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();

        $ubs = UBS::create([
            'name' => $faker->city().' - UBS '.$faker->numberBetween(1, 1000),
        ]);

        $patient = User::create([
            'name' => $faker->name,
            'type' => 'Patient',
        ]);

        $doctor = User::create([
            'name' => $faker->name,
            'type' => 'Doctor',
        ]);
        $doctor->UBS()->attach($ubs->id);

        $receptionist = User::create([
            'name' => $faker->name,
            'type' => 'Receptionist',
        ]);

        Schedule::create([
            'receptionist_id' => $receptionist->id,
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'ubs_id' => $ubs->id,
            'scheduled_time' => Carbon::now()->addMinutes(15)->format('Y-m-d H:i:s'),
        ]);
    }
}

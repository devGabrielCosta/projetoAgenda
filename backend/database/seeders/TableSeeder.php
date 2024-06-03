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

        $ubs = [];
        for($i = 0; $i < 3; $i++)
            array_push($ubs, UBS::create([
                'name' => $faker->city().' - UBS '.$faker->numberBetween(1, 1000),
            ]));

        $patients = [];
        for($i = 0; $i < 3; $i++)
            array_push($patients, User::create([
                'name' => $faker->name,
                'type' => 'Patient',
            ]));

        $doctors = [];
        for($i = 0; $i < 5; $i++)
            array_push($doctors, User::create([
                'name' => $faker->name,
                'type' => 'Doctor',
            ]));

        $doctors[0]->UBS()->attach($ubs[0]->id);
        $doctors[1]->UBS()->attach($ubs[0]->id);
        $doctors[2]->UBS()->attach($ubs[1]->id);
        $doctors[3]->UBS()->attach($ubs[1]->id);
        $doctors[4]->UBS()->attach($ubs[2]->id);

        $receptionist = User::create([
            'name' => $faker->name,
            'type' => 'Receptionist',
        ]);
            
        for($i = 0; $i < 9; $i++){
            $doctor = $doctors[random_int(0, 1)];
            $this->createSchedule($receptionist, $patients, $doctor, $i);
        }

        for($i = 0; $i < 9; $i++){
            $doctor = $doctors[random_int(2, 3)];
            $this->createSchedule($receptionist, $patients, $doctor, $i);
        }

        for($i = 0; $i < 2; $i++){
            $doctor = $doctors[4];
            $this->createSchedule($receptionist, $patients, $doctor, $i);
        }
    }

    private function createSchedule($receptionist, $patients, $doctor, $addMinutes)
    {
        Schedule::create([
            'receptionist_id' => $receptionist->id,
            'patient_id' => $patients[random_int(0, 2)]->id,
            'doctor_id' => $doctor->id,
            'ubs_id' =>  $doctor->ubs[0]->id,
            'scheduled_time' => Carbon::now()->addDays(1)->addMinutes($addMinutes)->format('Y-m-d H:i:s'),
        ]);
    }
}

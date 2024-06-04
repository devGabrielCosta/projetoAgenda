<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use App\Models\User;
use App\Models\UBS;
use App\Models\Schedule;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();

        $ubs = UBS::factory()->count(3)->create();

        $patients = User::factory()->count(3)->create([
            'type' => 'Patient',
        ]);

        $doctors = User::factory()->count(5)->create([
            'type' => 'Doctor',
        ]);

        $doctors[0]->UBS()->attach($ubs[0]->id);
        $doctors[1]->UBS()->attach($ubs[0]->id);
        $doctors[2]->UBS()->attach($ubs[1]->id);
        $doctors[3]->UBS()->attach($ubs[1]->id);
        $doctors[4]->UBS()->attach($ubs[2]->id);
   
        $receptionist = User::factory()->create([
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

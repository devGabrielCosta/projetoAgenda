<?php

namespace Database\Factories;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    public function definition()
    {
        return [
            'receptionist_id' => \App\Models\User::factory()->receptionist(),
            'patient_id' => \App\Models\User::factory()->patient(),
            'doctor_id' => \App\Models\User::factory()->doctor(),
            'ubs_id' => \App\Models\UBS::factory(),
            'scheduled_time' => $this->faker->dateTimeBetween('now', '+1 week')->format("Y-m-d H:i:00"),
            'status' => $this->faker->randomElement(['Created', 'NoShow', 'Attended']),
        ];
    }
}
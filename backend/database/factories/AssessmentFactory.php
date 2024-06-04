<?php

namespace Database\Factories;

use App\Models\Assessment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssessmentFactory extends Factory
{
    protected $model = Assessment::class;

    public function definition()
    {
        return [
            'schedule_id' => \App\Models\Schedule::factory(),
            'comment' => $this->faker->paragraph,
        ];
    }
}


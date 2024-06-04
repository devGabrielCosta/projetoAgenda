<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(['Doctor', 'Patient', 'Receptionist']),
        ];
    }

    public function patient()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'Patient',
            ];
        });
    }

    public function doctor()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'Doctor',
            ];
        });
    }
    
    public function receptionist()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'Receptionist',
            ];
        });
    }


}

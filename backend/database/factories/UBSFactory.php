<?php

namespace Database\Factories;

use App\Models\UBS;
use Illuminate\Database\Eloquent\Factories\Factory;

class UBSFactory extends Factory
{
    protected $model = UBS::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city().' - UBS '.$this->faker->numberBetween(1, 1000),
        ];
    }
}

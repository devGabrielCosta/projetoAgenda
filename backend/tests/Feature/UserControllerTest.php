<?php

namespace Tests\Feature;

use App\Models\Schedule;
use App\Models\UBS;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_returns_all_users()
    {
        User::factory()->count(3)->create();

        $response = $this->get('/user');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_it_returns_specific_user()
    {
        $user = User::factory()->create();

        $response = $this->get("/user/{$user->id}");

        $response->assertStatus(200)
                 ->assertJson($user->toArray());
    }

    public function test_it_returns_schedules_for_user()
    {
        $user = User::factory()->doctor()->create();
        $schedules = Schedule::factory()->count(3)->create([
            'doctor_id' => $user->id,
        ]);

        $response = $this->get("/user/{$user->id}/schedules");

        $response->assertStatus(200)
                ->assertJsonCount(3);
    }

    public function test_it_returns_ubs_for_user()
    {
        $user = User::factory()->create();
        $ubs = UBS::factory()->count(3)->create();

        foreach ($ubs as $ub) {
            $user->ubs()->attach($ub->id);
        }

        $response = $this->get("/user/{$user->id}/ubs");

        $response->assertStatus(200)
                ->assertJsonCount($ubs->count());
    }

    public function test_it_stores_new_user()
    {
        $data = [
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(['Patient', 'Receptionist']),
        ];

        $response = $this->post('/user', $data);

        $response->assertStatus(201)
                 ->assertJson($data);
    }

    public function test_it_stores_new_doctor_with_ubs()
    {
        $ubs = UBS::factory()->count(2)->create();

        $data = [
            'name' => $this->faker->name,
            'type' => 'Doctor',
            'UBS' => [$ubs[0]->id, $ubs[1]->id],
        ];

        $response = $this->post('/user', $data);
        
        unset($data['UBS']);

        $response->assertStatus(201)
                ->assertJson($data);

        $this->assertDatabaseHas('doctors_ubs', [
            'doctor_id' => $response->json('id'),
            'ubs_id' => $ubs[0]->id,
        ]);

        $this->assertDatabaseHas('doctors_ubs', [
            'doctor_id' => $response->json('id'),
            'ubs_id' => $ubs[1]->id,
        ]);
    }

}

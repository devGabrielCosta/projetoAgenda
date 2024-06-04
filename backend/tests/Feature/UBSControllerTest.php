<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UBS;
use Tests\TestCase;
use App\Models\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class UBSControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_returns_all_ubs()
    {
        $ubs = UBS::factory()->count(3)->create();

        $response = $this->get('/ubs');

        $response->assertStatus(200)
            ->assertJsonCount($ubs->count());
    }

    public function test_it_returns_specific_ubs()
    {
        $ubs = UBS::factory()->create();

        $response = $this->get("/ubs/{$ubs->id}");

        $response->assertStatus(200)
            ->assertJson($ubs->toArray());
    }

    public function test_it_returns_doctors_for_ubs()
    {
        $ubs = UBS::factory()->create();
        $doctors = User::factory()->count(3)->doctor()->create();
        $ubs->doctors()->attach($doctors->pluck('id'));

        $response = $this->get("/ubs/{$ubs->id}/doctors");

        $response->assertStatus(200)
            ->assertJsonCount($doctors->count());
    }

    public function test_it_returns_schedules_for_ubs()
    {
        $ubs = UBS::factory()->create();
        $schedules = Schedule::factory()->count(3)->create(['ubs_id' => $ubs->id]);

        $response = $this->get("/ubs/{$ubs->id}/schedules");

        $response->assertStatus(200)
            ->assertJsonCount($schedules->count());
    }

    public function test_it_stores_new_ubs()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->post('/ubs', $data);

        $response->assertStatus(201)
            ->assertJson($data);
    }
}

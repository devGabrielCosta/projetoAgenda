<?php

namespace Tests\Feature;

use App\Models\Assessment;
use App\Models\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssessmentControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_returns_assessment_by_id()
    {
        $assessment = Assessment::factory()->create();

        $response = $this->get("/assessment/{$assessment->id}");

        $response->assertStatus(200)
            ->assertJson($assessment->toArray());
    }

    public function test_it_stores_new_assessment()
    {
        $schedule = Schedule::factory()->create(['status' => 'Created']);

        $data = [
            'schedule_id' => $schedule->id,
            'comment' => $this->faker->sentence,
        ];

        $response = $this->post('/assessment', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('assessments', $data);
        $this->assertDatabaseHas('schedules', ['id' => $schedule->id, 'status' => 'Attended']);
    }

    public function test_it_returns_error_when_schedule_not_found()
    {
        $data = [
            'schedule_id' => 999,
            'comment' => $this->faker->sentence,
        ];

        $response = $this->post('/assessment', $data);

        $response->assertStatus(422)
            ->assertJson(["message" => "The selected schedule id is invalid."]);
    }

    public function test_it_returns_error_when_schedule_already_attended()
    {
        $schedule = Schedule::factory()->create(['status' => 'Attended']);

        $data = [
            'schedule_id' => $schedule->id,
            'comment' => $this->faker->sentence,
        ];

        $response = $this->post('/assessment', $data);

        $response->assertStatus(400)
            ->assertSeeText("Assessment already updated");
    }
}
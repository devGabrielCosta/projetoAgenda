<?php

namespace Tests\Feature;

use App\Models\Schedule;
use App\Models\UBS;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ScheduleControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_it_returns_all_schedules()
    {
        Schedule::factory()->count(3)->create();

        $response = $this->get('/schedule');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_it_returns_specific_schedule()
    {
        $schedule = Schedule::factory()->create();

        $response = $this->get("/schedule/{$schedule->id}");

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->where('id', $schedule->id)
                    ->where('receptionist_id', $schedule->receptionist_id)
                    ->where('patient_id', $schedule->patient_id)
                    ->where('doctor_id', $schedule->doctor_id)
                    ->where('ubs_id', $schedule->ubs_id)
                    ->where('scheduled_time', $schedule->scheduled_time)
                    ->where('status', $schedule->status)
            );
    }

    public function test_it_stores_new_schedule()
    {
        $user = User::factory()->create(["type" => "Receptionist"]);
        $ubs = UBS::factory()->create();
        
        $data = [
            'receptionist_id' => $user->id,
            'patient_id' => User::factory()->create(["type" => "Patient"])->id,
            'doctor_id' => User::factory()->create(["type" => "Doctor"])->id,
            'ubs_id' => $ubs->id,
            'scheduled_time' => Carbon::now()->addDays(3)->format("Y-m-d H:i:00")
        ];

        $response = $this->post('/schedule', $data);

        $response->assertStatus(201)
            ->assertJson($data);
    }

    public function test_it_returns_error_when_scheduled_time_conflicts()
    {
        $existingSchedule = Schedule::factory()->create();

        $response = $this->post('/schedule', $existingSchedule->toArray());

        $response->assertStatus(400)
            ->assertSeeText("Invalid scheduled time");
    }


    public function test_it_updates_existing_schedule()
    {
        $schedule = Schedule::factory()->create(['status' => 'Created']);
        $data = ['status' => 'NoShow'];

        $response = $this->patch("/schedule/{$schedule->id}", $data);

        $response->assertStatus(200)
            ->assertJson($data);

        $this->assertEquals('NoShow', $schedule->refresh()->status);
    }

    public function test_it_returns_error_when_schedule_not_found_for_patch()
    {
        $data = ['status' => 'NoShow'];

        $response = $this->patch("/schedule/999", $data);

        $response->assertStatus(400)
            ->assertSeeText("Schedule not found");
    }

    public function test_it_returns_error_when_status_already_set_for_patch()
    {
        $schedule = Schedule::factory()->create(['status' => 'Attended']);
        $data = ['status' => 'NoShow'];

        $response = $this->patch("/schedule/{$schedule->id}", $data);

        $response->assertStatus(400)
            ->assertSeeText("Status already set");
    }

    public function test_it_deletes_schedule()
    {
        $schedule = Schedule::factory()->create();

        $response = $this->delete("/schedule/{$schedule->id}");

        $response->assertStatus(200)
            ->assertSeeText("true");

        $this->assertDatabaseMissing('schedules', ['id' => $schedule->id]);
    }

}

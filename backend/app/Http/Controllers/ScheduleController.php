<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
Use App\Models\Schedule;
Use App\Http\Requests\CreateScheduleRequest;
Use App\Http\Requests\PatchScheduleRequest;
use Illuminate\Database\QueryException;

class ScheduleController extends Controller
{
    public function index()
    {
        return response()->json(Schedule::all(), 200);
    }
 
    public function show(int $id)
    {
        return response()->json(Schedule::find($id), 200);
    }

    public function store(CreateScheduleRequest $request)
    {   
        $validated = $request->validated();
        $validated["scheduled_time"] = Carbon::parse($validated["scheduled_time"])->format("Y-m-d H:i:00");

        $dateTimeUsed = Schedule::where([
            ['scheduled_time', '=', $validated["scheduled_time"]],
            ['doctor_id', '=', $validated["doctor_id"]]
        ])->get();

        if (!$dateTimeUsed->isEmpty())
            return response()->json('Invalid scheduled time', 400);

        return response()->json(Schedule::create($validated), 201);
    }
   
    public function patch(int $id, PatchScheduleRequest $request)
    {   
        $validated = $request->validated();
        $schedule = Schedule::find($id);
          
        if(!$schedule)
            return response()->json("Schedule not found", 400);

        if($schedule->status != "Created")
            return response()->json("Status already set", 400);

        $schedule->update($validated);
        return response()->json($schedule, 200);
    }
   
    public function delete(int $id)
    {   
        try {
            return response()->json(Schedule::find($id)?->delete(), 200);
        } catch (QueryException $e) {
            if ($e->errorInfo[0] == '23000') {
                return response()->json(['message' => "Cannot delete this entry due to foreign key integrity constraints"], 400);
            } 
        }      
    }
}

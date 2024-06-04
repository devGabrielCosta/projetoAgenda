<?php

namespace App\Http\Controllers;

Use App\Models\Assessment;
Use App\Models\Schedule;
Use App\Http\Requests\CreateAssessmentRequest;

class AssessmentController extends Controller
{
 
    public function show(int $id)
    {
        return response()->json(Assessment::find($id), 200);
    }

    public function store(CreateAssessmentRequest $request)
    {   
        $validated = $request->validated();

        $schedule = Schedule::find($validated['schedule_id']);
        if($schedule->status != "Created")
            return response()->json("Assessment already updated", 400);

        $schedule->status = 'Attended';

        $schedule->save();

        return response()->json(Assessment::create($validated), 201);
    }
}

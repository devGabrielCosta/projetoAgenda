<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Assessment;
Use App\Models\Schedule;

class AssessmentController extends Controller
{
 
    public function show($id)
    {
        return response()->json(Assessment::find($id), 200);
    }

    public function store(Request $request)
    {   
        $schedule = Schedule::find($request->schedule_id);

        if($schedule->status != "Created")
            return response()->json("Consulta já realizada", 400);

        $schedule->status = 'Attended';
        $schedule->save();

        return response()->json(Assessment::create($request->all()), 201);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Assessment;
Use App\Models\Schedule;

class AssessmentController extends Controller
{
 
    public function show($id)
    {
        return Assessment::find($id);
    }

    public function store(Request $request)
    {   
        $schedule = Schedule::find($request->schedule_id);
        $schedule->status = 'Attended';
        $schedule->save();

        return Assessment::create($request->all());
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
Use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        return response()->json(Schedule::all(), 200);
    }
 
    public function show($id)
    {
        return response()->json(Schedule::find($id), 200);
    }

    public function store(Request $request)
    {   
        $fields = $request->all();
        $fields["scheduled_time"] = Carbon::parse($fields["scheduled_time"])->format("Y-m-d H:i:s");

        $dateTimeUsed = Schedule::where([
            ['scheduled_time', '=', $fields["scheduled_time"]],
            ['doctor_id', '=', $fields["doctor_id"]]
        ])->get();

        if (!$dateTimeUsed->isEmpty())
            return response()->json('Horário da consulta invalido', 400);

        return response()->json(Schedule::create($fields), 201);
    }
   
    public function patch($id, Request $request)
    {
        $schedule = Schedule::find($id);

        if($request->has('status'))
            $schedule->status = $request->status;   

        $schedule->save();
        return response()->json($schedule, 200);
    }
   
    public function delete($id)
    {
        return response()->json(Schedule::find($id)?->delete(), 200);
    }
}

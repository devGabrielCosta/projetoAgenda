<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        return Schedule::all();
    }
 
    public function show($id)
    {
        return Schedule::find($id);
    }

    public function store(Request $request)
    {   
        $fields = $request->all();

        $dateTimeUsed = Schedule::where('scheduled_time', '=', $fields["scheduled_time"])->get();

        if (!$dateTimeUsed->isEmpty()) {
            return response()->json('Horário da consulta invalido', 400);
        }

        return Schedule::create($fields);
    }
   
    public function patch($id, Request $request)
    {
        $schedule = Schedule::find($id);

        if($request->has('status')) {
            $schedule->status = $request->status;   
        }

        $schedule->save();
        return $schedule;
    }
   
    public function delete($id)
    {
        Schedule::find($id)?->delete();
    }
}

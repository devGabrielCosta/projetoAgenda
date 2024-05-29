<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
   
    public function delete($id)
    {
        Schedule::find($id)?->delete();
    }
}

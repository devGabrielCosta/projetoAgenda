<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUBSRequest;
use Illuminate\Http\Request;
Use App\Models\UBS;
Use App\Models\User;

class UBSController extends Controller
{
    public function index()
    {
        return response()->json(UBS::all(), 200);
    }
 
    public function show(int $id)
    {
        return response()->json(UBS::find($id), 200);
    }
 
    public function showDoctors(int $id)
    {
        $ubs = UBS::find($id);
        
        if($ubs)
            return response()->json($ubs->doctors, 200);

        return response()->json("UBS não encontrada", 400);
    }
 
    public function showSchedules(int $id)
    {
        $ubs = UBS::with([
            "schedules.assessment", 
            "schedules.doctor", 
            "schedules.patient", 
            "schedules.ubs"
        ])->find($id);
        
        if($ubs)
            return response()->json($ubs->schedules, 200);

        return response()->json("UBS não encontrada", 400);
    }

    public function store(CreateUBSRequest $request)
    {   
        $validated = $request->validated();
        return response()->json(UBS::create($validated), 201);
    }
}

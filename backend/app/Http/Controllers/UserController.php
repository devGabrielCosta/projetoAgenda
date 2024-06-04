<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;
use App\Http\Requests\CreateUserRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {   
        if($request->has("type"))
            $user = User::where('type', $request->type)->get();  
        else
            $user = User::all(); 

        return response()->json($user, 200);
    }
 
    public function show(int $id)
    {
        return response()->json(User::find($id), 200);
    }
 
    public function showSchedules(int $id, Request $request)
    {       
        $user = User::find($id);
        
        if($user)
        {   
            $schedules = $user->schedules;
            $schedules->load('doctor');
            $schedules->load('patient');
            $schedules->load('assessment');
            $schedules->load('ubs');

            if($request->has("ubs_id"))
                $schedules = $schedules->where("ubs_id", $request->ubs_id);

            return response()->json($schedules, 200);
        }           

        return response()->json("User not found", 400);
    }
 
    public function showUbs(int $id)
    {       
        $user = User::find($id);
        
        if($user)
            return response()->json($user->ubs, 200);

        return response()->json("User not found", 400);
    }

    public function store(CreateUserRequest $request)
    {   
        $validated = $request->validated();

        $user = User::create($validated);

        if($user->type === 'Doctor')
            $user->UBS()->attach($validated['UBS']);

        return response()->json($user, 201);
    }
}

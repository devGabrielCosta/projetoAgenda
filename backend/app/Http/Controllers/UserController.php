<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;
Use App\Models\Enums\UserType;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all(), 200);
    }
 
    public function show($id)
    {
        return response()->json(User::find($id), 200);
    }

    public function store(Request $request)
    {   
        $fields = $request->all();

        $user = User::create($fields);

        if($user->type === 'Doctor')
            $user->UBS()->attach($fields['UBS']);

        return response()->json($user, 201);
    }
}

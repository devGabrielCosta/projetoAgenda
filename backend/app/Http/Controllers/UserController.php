<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;
Use App\Models\Enums\UserType;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }
 
    public function show($id)
    {
        return User::find($id);
    }

    public function store(Request $request)
    {   
        $fields = $request->all();

        $user = User::create($fields);

        if($user->type === 'Doctor')
        {   
            $user->UBS()->attach($fields['UBS']);
        }

        return $user;
    }
}

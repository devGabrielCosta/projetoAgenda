<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\UBS;

class UBSController extends Controller
{
    public function index()
    {
        return UBS::all();
    }
 
    public function show($id)
    {
        return UBS::find($id);
    }
 
    public function showDoctors($id)
    {
        return UBS::find($id)->doctors;
    }

    public function store(Request $request)
    {
        return UBS::create($request->all());
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Project;

class KaryaController extends Controller
{
    public function index()
    {
        $karyas = Project::all();
        return view('admin.karya', compact('karyas'));
    }

    public function show($id)
    {
        return view('karya.detail');
    }
}
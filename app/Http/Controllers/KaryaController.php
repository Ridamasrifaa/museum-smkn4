<?php

namespace App\Http\Controllers;

class KaryaController extends Controller
{
    public function index()
    {
        return view('karya');
    }

    public function show($id)
    {
        return view('karya.detail');
    }
}
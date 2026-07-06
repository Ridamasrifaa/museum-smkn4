<?php

namespace App\Http\Controllers;

class ArtikelController extends Controller
{
    public function index()
    {
        return view('artikel');
    }

    public function show($id)
    {
        return view('artikel.show', ['id' => $id]);
    }
}
<?php

namespace App\Http\Controllers;

class SportController extends Controller
{
    public function index()
    {
        return view('pages.' . strtolower('Sport'));
    }
}

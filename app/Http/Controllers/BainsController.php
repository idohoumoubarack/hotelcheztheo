<?php

namespace App\Http\Controllers;

class BainsController extends Controller
{
    public function index()
    {
        return view('pages.' . strtolower('Bains'));
    }
}

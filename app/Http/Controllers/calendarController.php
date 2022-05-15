<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class calendarController extends Controller
{
    public function index()
    {
        return view('pages.new.calendar');
    }
}

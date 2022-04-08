<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class lakonwebController extends Controller
{
    public function index()
    {
        return view('pages.lakonweb.index');
    }
}

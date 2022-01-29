<?php

namespace App\Http\Controllers\maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class maintenanceController extends Controller
{
    public function index()
    {
        $show = Carbon::now();

        $data = [
            'show' => $show,
        ];

        return view('pages.maintenance.index')->with('list', $data);
    }
}

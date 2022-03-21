<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class kunjunganController extends Controller
{
    public function index()
    {
        return view('pages.landing.kunjungan');
    }

    public function kunjungan()
    {
        $now = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        $yest = Carbon::yesterday()->isoFormat('dddd, D MMMM Y');

        $data = [
            'now' => $now,
            'yest' => $yest
        ];

        return view('pages.new.kunjungan')->with('list', $data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\antrian;
use Redirect;
use Carbon\Carbon;

class queueController extends Controller
{
    public function index()
    {
        return view('antrian-poli');
    }

    public function addQueue(Request $request)
    {
        $get = antrian::orderBy('tgl', 'DESC')->first();
        $tgl = Carbon::parse($get)->isoFormat('D MMMM Y');
        $today = Carbon::now()->isoFormat('D MMMM Y');
        // print_r($get);
        // die();

        if ($tgl == $today) {
            if ($request == 'paru') {
                $query = "UPDATE antrian SET queue_paru = $gettgl+1 WHERE tgl = $today";
                $data = DB::select($query);
            } else {
                
            }
        } 
        // print_r($today);
        print_r($data);
        die();
        // return view('antrian-polinow')->with('list',$data);
    }
}

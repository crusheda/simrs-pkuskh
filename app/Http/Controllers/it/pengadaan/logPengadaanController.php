<?php

namespace App\Http\Controllers\it\pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\unit;
use App\Models\barang;
use App\Models\rekapbarang;
use App\Models\tdkperawat;
use Carbon\Carbon;
use Auth;
use \PDF;

class logPengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thn = substr(Carbon::now(),0,4);
        $show = rekapbarang::get();
        // $tampil = barang::pluck('id','barang');
        $tampilunit = unit::pluck('id','name');

        $data = [
            'show' => $show,
            'unit' => $tampilunit,
            'thn'  => $thn
        ];

        // print_r($tampilunit);
        // die();

        return view('pages.pengadaan.log-pengadaan')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showLog(Request $request)
    {
        $get_thn = substr(Carbon::now(),0,4);
        $bln = $request->query('bulan');
        $thn = $request->query('tahun');

        $time = '';

        if ($thn && $bln) {
            $show = DB::table('rekapbarang')->whereMonth('created_at', '=', $bln)->whereYear('created_at', '=', $thn)->get();
            $total = count($show);
        }
        elseif ($bln) {
            $show = DB::table('rekapbarang')->whereMonth('created_at', '=', $bln)->get();
            $total = count($show);
            $time= 'Bulan : '.$bln;
        }
        elseif ($thn) {
            $show = DB::table('rekapbarang')->whereYear('created_at', '=', $thn)->get();
            $total = count($show);
            $time= 'Tahun : '.$thn;
        }

        // print_r($show);
        // die();

        // print_r($show);
        // die();

        $data = [
            'show' => $show,
            'time' => $time,
            'get_thn' => $get_thn
        ];

        return view('pages.pengadaan.carilog-pengadaan')->with('list', $data);
    }
}

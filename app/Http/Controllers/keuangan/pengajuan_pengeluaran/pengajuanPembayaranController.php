<?php

namespace App\Http\Controllers\keuangan\pengajuan_pengeluaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\pengajuan_pembayaran;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;
use Response;
use Exception;

class pengajuanPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $hari = Carbon::now()->isoFormat('DD');
        $bulan = Carbon::now()->isoFormat('MM');
        $tahun = Carbon::now()->isoFormat('YYYY');
        
        $show = pengajuan_pembayaran::get();
        // $show = DB::table('keu_pendapatan_kasir')
        //         ->orderBy('tgl','DESC')
        //         ->whereDay('created_at', $hari)
        //         ->whereMonth('created_at', $bulan)
        //         ->whereYear('created_at', $tahun)
        //         ->where('deleted_at', null)
        //         ->get();

        $data = [
            'show' => $show,
            'now' => $now,
        ];
        
        return view('pages.keu.pengajuan-pembayaran')->with('list', $data);
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
        //
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
}

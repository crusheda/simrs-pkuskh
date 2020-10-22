<?php

namespace App\Http\Controllers\it\pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\pengadaan;
use App\Models\barang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \PDF;

class pengadaanAllController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = pengadaan::get();

        $data = [
            'show' => $show
        ];
        // print_r($data);
        // die();

        return view('pages.pengadaan.riwayat')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pengadaan.tambah-pengadaan');
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
        $data = pengadaan::find($id);
        // print_r($data);
        // die();
        return view('pages.pengadaan.detail-pengadaan')->with('list', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = pengadaan::find($id);

        return view('pages.pengadaan.ubah-pengadaan')->with('list', $data);
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
        $data = pengadaan::find($id);
        $data->pemohon = $request->pemohon;
        $data->tgl = $request->tgl;
        $data->save();

        return redirect('pengadaan/all/'.$id)->with('message','Ubah Data Pengadaan Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = pengadaan::find($id);
        $data->delete();

        // redirect
        return \Redirect::to('pengadaan/all')->with('message','Hapus Data Pengadaan Berhasil');
    }

    public function generatePDF($id)
    {
        # code...
        $now = Carbon::now();
        // $yest = substr(Carbon::yesterday(),0,10);
        $filename = "Pengadaan ".$now;

        $data = pengadaan::where('id',$id)->first();
        // $query->unit = $unit;
        // $query->pemohon = $pemohon;
        // $query->jnspengadaan = $jnspengadaan;
        // $query->tgl = $tgl;
        
        // $data = [
        //     'unit' => $query->unit,
        //     'pemohon'  => $query->pemohon,
        //     'jnspengadaan'  => $query->jnspengadaan,
        //     'tgl'  => $query->tgl
        // ];
        // print_r($data);
        // die();

        $pdf = PDF::loadView('pages.pengadaan.cetak', $data)->setPaper('F4','potrait');
        // return $pdf->download();
        return $pdf->stream($filename);
    }
}

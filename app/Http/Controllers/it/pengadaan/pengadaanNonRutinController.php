<?php

namespace App\Http\Controllers\it\pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\pengadaan;
use App\Models\barang;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use \PDF;

class pengadaanNonRutinController extends Controller
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

        return view('pages.pengadaan.riwayat-nonrutin')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tampil = barang::pluck('id','barang');
        // $tampilbarang = barang::pluck('barang');
        
        // $data = [
        //     'tampilid' => $tampilid,
        //     'tampilbarang' => $tampilbarang
        // ];
        // print_r($data);
        // die();

        // return view('pages.pengadaan.tambah-nonrutin')->with('list', $tampil);
        return view('pages.pengadaan.tambah-nonrutin', [
            'list' => $tampil,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jnspengadaan = 'nonrutin';

        $getnama = Auth::user()->name;
        
        $data = new pengadaan;
        $data->unit = $request->unit;
        $data->pemohon = $request->pemohon;

        $data->barang1 = $request->barang1;
        $data->barang2 = $request->barang2;
        $data->barang3 = $request->barang3;
        $data->barang4 = $request->barang4;
        $data->barang5 = $request->barang5;
        $data->barang6 = $request->barang6;
        $data->barang7 = $request->barang7;
        $data->barang8 = $request->barang8;
        $data->barang9 = $request->barang9;
        $data->barang10 = $request->barang10;
        $data->barang11 = $request->barang11;
        $data->barang12 = $request->barang12;
        $data->barang13 = $request->barang13;
        $data->barang14 = $request->barang14;
        $data->barang15 = $request->barang15;
        $data->barang16 = $request->barang16;
        $data->barang17 = $request->barang17;
        $data->barang18 = $request->barang18;
        $data->barang19 = $request->barang19;
        $data->barang20 = $request->barang20;

        $data->jumlah1 = $request->jumlah1;
        $data->jumlah2 = $request->jumlah2;
        $data->jumlah3 = $request->jumlah3;
        $data->jumlah4 = $request->jumlah4;
        $data->jumlah5 = $request->jumlah5;
        $data->jumlah6 = $request->jumlah6;
        $data->jumlah7 = $request->jumlah7;
        $data->jumlah8 = $request->jumlah8;
        $data->jumlah9 = $request->jumlah9;
        $data->jumlah10 = $request->jumlah10;
        $data->jumlah11 = $request->jumlah11;
        $data->jumlah12 = $request->jumlah12;
        $data->jumlah13 = $request->jumlah13;
        $data->jumlah14 = $request->jumlah14;
        $data->jumlah15 = $request->jumlah15;
        $data->jumlah16 = $request->jumlah16;
        $data->jumlah17 = $request->jumlah17;
        $data->jumlah18 = $request->jumlah18;
        $data->jumlah19 = $request->jumlah19;
        $data->jumlah20 = $request->jumlah20;
        
        $data->satuan1 = $request->satuan1;
        $data->satuan2 = $request->satuan2;
        $data->satuan3 = $request->satuan3;
        $data->satuan4 = $request->satuan4;
        $data->satuan5 = $request->satuan5;
        $data->satuan6 = $request->satuan6;
        $data->satuan7 = $request->satuan7;
        $data->satuan8 = $request->satuan8;
        $data->satuan9 = $request->satuan9;
        $data->satuan10 = $request->satuan10;
        $data->satuan11 = $request->satuan11;
        $data->satuan12 = $request->satuan12;
        $data->satuan13 = $request->satuan13;
        $data->satuan14 = $request->satuan14;
        $data->satuan15 = $request->satuan15;
        $data->satuan16 = $request->satuan16;
        $data->satuan17 = $request->satuan17;
        $data->satuan18 = $request->satuan18;
        $data->satuan19 = $request->satuan19;
        $data->satuan20 = $request->satuan20;
        
        $data->harga1 = $request->harga1;
        $data->harga2 = $request->harga2;
        $data->harga3 = $request->harga3;
        $data->harga4 = $request->harga4;
        $data->harga5 = $request->harga5;
        $data->harga6 = $request->harga6;
        $data->harga7 = $request->harga7;
        $data->harga8 = $request->harga8;
        $data->harga9 = $request->harga9;
        $data->harga10 = $request->harga10;
        $data->harga11 = $request->harga11;
        $data->harga12 = $request->harga12;
        $data->harga13 = $request->harga13;
        $data->harga14 = $request->harga14;
        $data->harga15 = $request->harga15;
        $data->harga16 = $request->harga16;
        $data->harga17 = $request->harga17;
        $data->harga18 = $request->harga18;
        $data->harga19 = $request->harga19;
        $data->harga20 = $request->harga20;
        
        $total1 = $request->jumlah1 * $request->harga1;
        $total2 = $request->jumlah2 * $request->harga2;
        $total3 = $request->jumlah3 * $request->harga3;
        $total4 = $request->jumlah4 * $request->harga4;
        $total5 = $request->jumlah5 * $request->harga5;
        $total6 = $request->jumlah6 * $request->harga6;
        $total7 = $request->jumlah7 * $request->harga7;
        $total8 = $request->jumlah8 * $request->harga8;
        $total9 = $request->jumlah9 * $request->harga9;
        $total10 = $request->jumlah10 * $request->harga10;
        $total11 = $request->jumlah11 * $request->harga11;
        $total12 = $request->jumlah12 * $request->harga12;
        $total13 = $request->jumlah13 * $request->harga13;
        $total14 = $request->jumlah14 * $request->harga14;
        $total15 = $request->jumlah15 * $request->harga15;
        $total16 = $request->jumlah16 * $request->harga16;
        $total17 = $request->jumlah17 * $request->harga17;
        $total18 = $request->jumlah18 * $request->harga18;
        $total19 = $request->jumlah19 * $request->harga19;
        $total20 = $request->jumlah20 * $request->harga20;

        $data->total1 = $total1;
        $data->total2 = $total2;
        $data->total3 = $total3;
        $data->total4 = $total4;
        $data->total5 = $total5;
        $data->total6 = $total6;
        $data->total7 = $total7;
        $data->total8 = $total8;
        $data->total9 = $total9;
        $data->total10 = $total10;
        $data->total11 = $total11;
        $data->total12 = $total12;
        $data->total13 = $total13;
        $data->total14 = $total14;
        $data->total15 = $total15;
        $data->total16 = $total16;
        $data->total17 = $total17;
        $data->total18 = $total18;
        $data->total19 = $total19;
        $data->total20 = $total20;

        $data->totalall = $request->total1 + $request->total2 + $request->total3 + $request->total4 + $request->total5 + $request->total6 + $request->total7 + $request->total8 + $request->total9 + $request->total10 + $request->total11 + $request->total12 + $request->total13 + $request->total14 + $request->total15 + $request->total16 + $request->total17 + $request->total18 + $request->total19 + $request->total20;
        
        $data->keterangan1 = $request->keterangan1;
        $data->keterangan2 = $request->keterangan2;
        $data->keterangan3 = $request->keterangan3;
        $data->keterangan4 = $request->keterangan4;
        $data->keterangan5 = $request->keterangan5;
        $data->keterangan6 = $request->keterangan6;
        $data->keterangan7 = $request->keterangan7;
        $data->keterangan8 = $request->keterangan8;
        $data->keterangan9 = $request->keterangan9;
        $data->keterangan10 = $request->keterangan10;
        $data->keterangan11 = $request->keterangan11;
        $data->keterangan12 = $request->keterangan12;
        $data->keterangan13 = $request->keterangan13;
        $data->keterangan14 = $request->keterangan14;
        $data->keterangan15 = $request->keterangan15;
        $data->keterangan16 = $request->keterangan16;
        $data->keterangan17 = $request->keterangan17;
        $data->keterangan18 = $request->keterangan18;
        $data->keterangan19 = $request->keterangan19;
        $data->keterangan20 = $request->keterangan20;
        
        $data->jnspengadaan = $jnspengadaan;

        $data->save();
        
        return redirect('pengadaan/nonrutin')->with('message','Tambah Data Pengadaaan Non Rutin Berhasil');
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
        $data = pengadaan::find($id);
        $data->delete();

        // redirect
        return \Redirect::to('pengadaan/nonrutin')->with('message','Hapus Pengadaan Non Rutin Berhasil');
    }
}

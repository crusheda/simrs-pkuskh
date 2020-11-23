<?php

namespace App\Http\Controllers\it\pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\pengadaan;
use App\Models\barang;
use App\Models\rekapbarang;
use App\Models\unit;
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
        $show = pengadaan::where('jnspengadaan','nonrutin')->get();

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
        $tampilunit = unit::pluck('id','name');

        return view('pages.pengadaan.tambah-nonrutin', [
            'list' => $tampil,
            'unit' => $tampilunit
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
        $jnspengadaan = 'NONRUTIN';
        $now = Carbon::now(); 
        
        $getnama = Auth::user()->name;
        
        // SAVE TO TABLE PENGADAAN

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
            $data->tgl = $now;

            $data->save();
        
        // SAVE TO TABLE REKAPBARANG

            if ($request->barang1 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang1;
                $rekap->jumlah = $request->jumlah1;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock1 = barang::where('barang', $request->barang1)->first();
                $stock1->count = $stock1->count + 1;
                $stock1->total = $stock1->total + $request->jumlah1;
                $stock1->save();
            } 
            if ($request->barang2 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang2;
                $rekap->jumlah = $request->jumlah2;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock2 = barang::where('barang', $request->barang2)->first();
                $stock2->count = $stock2->count + 1;
                $stock2->total = $stock2->total + $request->jumlah2;
                $stock2->save();
            } 
            if ($request->barang3 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang3;
                $rekap->jumlah = $request->jumlah3;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock3 = barang::where('barang', $request->barang3)->first();
                $stock3->count = $stock3->count + 1;
                $stock3->total = $stock3->total + $request->jumlah3;
                $stock3->save();
            } 
            if ($request->barang4 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang4;
                $rekap->jumlah = $request->jumlah4;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock4 = barang::where('barang', $request->barang4)->first();
                $stock4->count = $stock4->count + 1;
                $stock4->total = $stock4->total + $request->jumlah4;
                $stock4->save();
            } 
            if ($request->barang5 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang5;
                $rekap->jumlah = $request->jumlah5;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock5 = barang::where('barang', $request->barang5)->first();
                $stock5->count = $stock5->count + 1;
                $stock5->total = $stock5->total + $request->jumlah5;
                $stock5->save();
            } 
            if ($request->barang6 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang6;
                $rekap->jumlah = $request->jumlah6;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock6 = barang::where('barang', $request->barang6)->first();
                $stock6->count = $stock6->count + 1;
                $stock6->total = $stock6->total + $request->jumlah6;
                $stock6->save();
            } 
            if ($request->barang7 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang7;
                $rekap->jumlah = $request->jumlah7;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock7 = barang::where('barang', $request->barang7)->first();
                $stock7->count = $stock7->count + 1;
                $stock7->total = $stock7->total + $request->jumlah7;
                $stock7->save();
            } 
            if ($request->barang8 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang8;
                $rekap->jumlah = $request->jumlah8;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock8 = barang::where('barang', $request->barang8)->first();
                $stock8->count = $stock8->count + 1;
                $stock8->total = $stock8->total + $request->jumlah8;
                $stock8->save();
            } 
            if ($request->barang9 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang9;
                $rekap->jumlah = $request->jumlah9;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock9 = barang::where('barang', $request->barang9)->first();
                $stock9->count = $stock9->count + 1;
                $stock9->total = $stock9->total + $request->jumlah9;
                $stock9->save();
            } 
            if ($request->barang10 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang10;
                $rekap->jumlah = $request->jumlah10;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock10 = barang::where('barang', $request->barang10)->first();
                $stock10->count = $stock10->count + 1;
                $stock10->total = $stock10->total + $request->jumlah10;
                $stock10->save();
            } 
            if ($request->barang11 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang11;
                $rekap->jumlah = $request->jumlah11;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock11 = barang::where('barang', $request->barang11)->first();
                $stock11->count = $stock11->count + 1;
                $stock11->total = $stock11->total + $request->jumlah11;
                $stock11->save();
            } 
            if ($request->barang12 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang12;
                $rekap->jumlah = $request->jumlah12;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock12 = barang::where('barang', $request->barang12)->first();
                $stock12->count = $stock12->count + 1;
                $stock12->total = $stock12->total + $request->jumlah12;
                $stock12->save();
            } 
            if ($request->barang13 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang13;
                $rekap->jumlah = $request->jumlah13;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock13 = barang::where('barang', $request->barang13)->first();
                $stock13->count = $stock13->count + 1;
                $stock13->total = $stock13->total + $request->jumlah13;
                $stock13->save();
            } 
            if ($request->barang14 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang14;
                $rekap->jumlah = $request->jumlah14;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock14 = barang::where('barang', $request->barang14)->first();
                $stock14->count = $stock14->count + 1;
                $stock14->total = $stock14->total + $request->jumlah14;
                $stock14->save();
            } 
            if ($request->barang15 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang15;
                $rekap->jumlah = $request->jumlah15;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock15 = barang::where('barang', $request->barang15)->first();
                $stock15->count = $stock15->count + 1;
                $stock15->total = $stock15->total + $request->jumlah15;
                $stock15->save();
            } 
            if ($request->barang16 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang16;
                $rekap->jumlah = $request->jumlah16;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock16 = barang::where('barang', $request->barang16)->first();
                $stock16->count = $stock16->count + 1;
                $stock16->total = $stock16->total + $request->jumlah16;
                $stock16->save();
            } 
            if ($request->barang17 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang17;
                $rekap->jumlah = $request->jumlah17;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock17 = barang::where('barang', $request->barang17)->first();
                $stock17->count = $stock17->count + 1;
                $stock17->total = $stock17->total + $request->jumlah17;
                $stock17->save();
            } 
            if ($request->barang18 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang18;
                $rekap->jumlah = $request->jumlah18;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock18 = barang::where('barang', $request->barang18)->first();
                $stock18->count = $stock18->count + 1;
                $stock18->total = $stock18->total + $request->jumlah18;
                $stock18->save();
            } 
            if ($request->barang19 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang19;
                $rekap->jumlah = $request->jumlah19;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock19 = barang::where('barang', $request->barang19)->first();
                $stock19->count = $stock19->count + 1;
                $stock19->total = $stock19->total + $request->jumlah19;
                $stock19->save();
            } 
            if ($request->barang20 != null) {
                $rekap = new rekapbarang;
                $rekap->unit = $request->unit;
                $rekap->barang = $request->barang20;
                $rekap->jumlah = $request->jumlah20;
                $rekap->jnspengadaan = $jnspengadaan;
                $rekap->save();

                $stock20 = barang::where('barang', $request->barang20)->first();
                $stock20->count = $stock20->count + 1;
                $stock20->total = $stock20->total + $request->jumlah20;
                $stock20->save();
            } 

        return redirect('pengadaan/all')->with('message','Tambah Data Pengadaaan Non Rutin Berhasil');
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
        return \Redirect::to('pengadaan/all')->with('message','Hapus Pengadaan Non Rutin Berhasil');
    }
}

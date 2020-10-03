<?php

namespace App\Http\Controllers\it\pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\pengadaan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use \PDF;

class rutinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = pengadaan::get();

        $getby = "SELECT unit,pemohon,created_at FROM pengadaan 
                  WHERE jnspengadaan = 'rutin'
                  GROUP BY unit,pemohon,created_at";

        $query_getby = DB::select($getby);

        // print_r($query_getby);
        // die();
        $data = [
            'show' => $show,
            'getby' => $query_getby
        ];

        return view('pages.it.pengadaan.rutin')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.it.pengadaan.tambah-rutin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

            ]);

        $pemohon = $request->pemohon;
        $unit = $request->unit;
        $barang = $request->barang;
        $jumlah = $request->jumlah;
        $satuan = $request->satuan;
        $harga = $request->harga;
        $keterangan = $request->keterangan;
        $jnspengadaan = $request->jnspengadaan;
        $now = Carbon::now()->addHours(7);
        
        for($count = 0; $count < count($barang); $count++)
        {
            $data = array(
                'unit' => $unit[$count],
                'pemohon' => $pemohon[$count],
                'barang' => $barang[$count],
                'jumlah' => $jumlah[$count],
                'satuan' => $satuan[$count],
                'harga' => $harga[$count],
                'total' => $jumlah[$count] * $harga[$count],
                'keterangan' => $keterangan[$count],
                'jnspengadaan' => $jnspengadaan[$count],
                'created_at' => $now
            );
            $insert_data[] = $data; 
        }

        pengadaan::insert($insert_data);
        
        return response()->json([
            'success'  => 'Data Added successfully.'
           ]);

        return redirect('pengadaan/rutin')->with('message','Tambah Data Pengadaaan Rutin Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = pengadaan::find($created_at);
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
        $data = pengadaan::find($id);
        $data->pemohon = $request->pemohon;
        $data->barang = $request->barang;
        $data->jumlah = $request->jumlah;
        $data->satuan = $request->satuan;
        $data->harga = $request->harga;
        $data->keterangan = $request->keterangan;
        $data->save();
        

        return redirect('pengadaan/rutin')->with('message','Ubah Pengadaan Rutin Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($created_at)
    {
        $data = pengadaan::find($created_at);
        $data->delete();

        // redirect
        return \Redirect::to('pengadaan/rutin')->with('message','Hapus Pengadaan Rutin Berhasil');
    }

    public function generatePDF(Request $request, $created_at)
    {
        $data = pengadaan::find($created_at);

        // $query = "SELECT * FROM pengadaan WHERE created_at = $created_at";

        // $query_show = DB::select($query);
        // $filename = 'Pengadaan Rutin - '.Carbon::now()->addHours(7);

        // // print_r($query_getby);
        // // die();
        // $data = [
        //     'show' => $query_show
        // ];

        print_r($query_show);
        die();

        // $pdf = PDF::loadView('pages.it.pengadaan.cetak-rutin', $data);
        // return $pdf->download();
        return $pdf->stream($filename);
    }
}

<?php

namespace App\Http\Controllers\publik\pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\pengadaan\ref_barang;
use App\Models\pengadaan\barang;
use Carbon\Carbon;
use Auth;

class barangPengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = barang::join('ref_barang', 'ref_barang.id', '=', 'barang.ref_barang')->get(['barang.*','ref_barang.nama as ref']);
        $ref_barang = ref_barang::get();

        $data = [
            'show' => $show,
            'ref' => $ref_barang,
        ];
        // print_r($data);
        // die();

        return view('pages.new.pengadaan.barang')->with('list', $data);
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
        $tgl = Carbon::now();

        $uploadedFile = $request->file('file');    

        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        if ($uploadedFile == '') {
            $path = null;
            $title = null;
        }else {
            $path = $uploadedFile->store('public/files/pengadaan/barang/');
            $title = $uploadedFile->getClientOriginalName();
        }

        $data = new barang;
        $data->nama = $request->nama;
        $data->id_user = Auth::user()->id;
        $data->ref_barang = $request->ref_barang;
        $data->satuan = $request->satuan;
        $data->harga = str_replace(".","",(str_replace("Rp. ", "", $request->harga)));
        $data->title = $title;
        $data->filename = $path;

        $data->save();

        return redirect()->back()->with('message','Tambah Barang Berhasil.');
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
        $tgl = Carbon::now();

        $data = barang::find($id);
        $data->nama = $request->nama;
        $data->ref_barang = $request->ref_barang;
        $data->satuan = $request->satuan;
        $data->harga = $request->harga;

        $data->save();
        return redirect()->back()->with('message','Perubahan Barang Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = barang::find($id);
        $data->delete();

        // redirect
        return redirect()->back()->with('message','Hapus Barang Berhasil.');
    }

    public function apiGet()
    {
        $data = barang::join('ref_barang', 'ref_barang.id', '=', 'barang.ref_barang')->get(['barang.*','ref_barang.nama as ref']);
        // $data = barang::get();

        return response()->json($data, 200);
    }

    public function apiHapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        barang::where('id', $id)->delete();

        return response()->json($tgl, 200);
    }
}

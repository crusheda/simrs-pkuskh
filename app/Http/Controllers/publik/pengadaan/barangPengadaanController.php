<?php

namespace App\Http\Controllers\publik\pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\pengadaan\ref_barang;
use App\Models\pengadaan\barang;
use Carbon\Carbon;

class barangPengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = barang::get();
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
        $data = new barang;
        $data->tgl = $tgl;

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
        $data->tgl = $tgl;

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
}

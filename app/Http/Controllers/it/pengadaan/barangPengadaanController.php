<?php

namespace App\Http\Controllers\it\pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\barang;
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

        $data = [
            'show' => $show
        ];

        return view('pages.pengadaan.barang')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pengadaan.barang');
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
            'barang' => 'nullable',
            'satuan' => 'nullable',
            'harga' => 'nullable',
            ]);
            
        $data = new barang;
        $data->barang = $request->barang;
        $data->satuan = $request->satuan;
        $data->harga = $request->harga;

        $data->save();

        return redirect('/barang')->with('message','Tambah Barang Pengadaan Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = barang::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = barang::find($id);
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
        $data = barang::find($id);
        $data->delete();

        // redirect
        return \Redirect::to('barang')->with('message','Hapus Barang Pengadaan Berhasil');
    }

    public function apifile($gembos)
    {
        $data = barang::where('barang', $gembos)->first();

        return response()->json($data, 200);
    }
}

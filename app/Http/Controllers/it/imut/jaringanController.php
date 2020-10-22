<?php

namespace App\Http\Controllers\it\imut;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\imutjaringan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class jaringanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = imutjaringan::get();

        $data = [
            'show' => $show
        ];

        return view('pages.imut.it.jaringan')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.imut.it.jaringan');
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
            'nama' => 'nullable',
            'jamselesai' => 'nullable',
            ]);
            
        $getnama = Auth::user()->name;
        $getjamawal = Carbon::now();
        
        $data = new imutjaringan;
        $data->namapi = $request->namapi;
        $data->nama = $getnama;
        $data->jamawal = $getjamawal;
        $data->jamselesai = $request->jamselesai;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect('/imut/jaringan')->with('message','Tambah Imut Jaringan Berhasil');
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
        $data = imutjaringan::find($id);
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
        $data = imutjaringan::find($id);
        $data->namapi = $request->namapi;
        // $data->nama = $request->nama;
        $data->jamawal = $request->jamawal;
        $data->jamselesai = $request->jamselesai;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect('/imut/jaringan')->with('message','Ubah Imut Jaringan Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = imutjaringan::find($id);
        $data->delete();

        // redirect
        return \Redirect::to('/imut/jaringan')->with('message','Hapus Imut Jaringan Berhasil');
    }

    public function jaringanClear(Request $request, $id)
    {
        $getjamselesai = Carbon::now();
        $data = imutjaringan::find($id);
        $data->jamselesai = $getjamselesai;
        $data->save();
        
        return \Redirect::to('/imut/jaringan')->with('message','Revisi Jaringan Telah Selesai.');
    }
}

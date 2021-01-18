<?php

namespace App\Http\Controllers\it\imut;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\imutprinter;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class printerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = imutprinter::get();

        $data = [
            'show' => $show
        ];

        return view('pages.imut.it.printer')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.imut.it.printer');
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
        
        $data = new imutprinter;
        $data->namapi = $request->namapi;
        $data->nama = $getnama;
        $data->jamawal = $getjamawal;
        $data->jamselesai = $request->jamselesai;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect('it/imut/printer')->with('message','Tambah Imut Printer Berhasil');
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
        $data = imutprinter::find($id);
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
        $data = imutprinter::find($id);
        $data->namapi = $request->namapi;
        // $data->nama = $request->nama;
        $data->jamawal = $request->jamawal;
        $data->jamselesai = $request->jamselesai;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect('it/imut/printer')->with('message','Ubah Imut Printer Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $data = imutprinter::find($id);
        $data->delete();

        // redirect
        return \Redirect::to('it/imut/printer')->with('message','Hapus Imut Printer Berhasil');
    }

    public function printerClear(Request $request, $id)
    {
        $getjamselesai = Carbon::now();
        $data = imutprinter::find($id);
        $data->jamselesai = $getjamselesai;
        $data->save();
        
        return \Redirect::to('it/imut/printer')->with('message','Revisi Printer Telah Selesai.');
    }
}

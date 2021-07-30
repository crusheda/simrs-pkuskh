<?php

namespace App\Http\Controllers\it\imut;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\imutpilar;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class pilarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = imutpilar::orderBy('jamawal','DESC')->limit('50')->get();

        $data = [
            'show' => $show
        ];

        // print_r($show);
        // die();

        return view('pages.imut.it.pilar')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.imut.it.pilar');
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
        // ->addHours(7)
        
        $data = new imutpilar;
        $data->namapi = $request->namapi;
        $data->nama = $getnama;
        $data->jamawal = $getjamawal;
        $data->jamselesai = $request->jamselesai;
        $data->keterangan = $request->keterangan;
        $data->save();

        return redirect('it/imut/pilar')->with('message','Tambah Imut Pilar Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = imutpilar::find($id);
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
        $data = imutpilar::find($id);
        $data->namapi = $request->namapi;
        // $data->nama = $request->nama;
        $data->jamawal = $request->jamawal;
        $data->jamselesai = $request->jamselesai;
        $data->keterangan = $request->keterangan;
        $data->save();
        

        return redirect('it/imut/pilar')->with('message','Ubah Imut Pilar Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = imutpilar::find($id);
        $data->delete();

        // redirect
        return \Redirect::to('it/imut/pilar')->with('message','Hapus Imut Pilar Berhasil');
    }

    public function pilarClear(Request $request, $id)
    {
        $getjamselesai = Carbon::now();
        $data = imutpilar::find($id);
        $data->jamselesai = $getjamselesai;
        $data->save();
        
        return \Redirect::to('it/imut/pilar')->with('message','Revisi Pilar Telah Selesai.');
    }

    public function showAll()
    {
        $show = imutpilar::get();

        $data = [
            'show' => $show
        ];

        return view('pages.imut.it.pilarAll')->with('list', $data);
    }
}

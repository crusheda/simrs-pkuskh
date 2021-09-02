<?php

namespace App\Http\Controllers\ibs\supervisi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\ibs\ibs_refsupervisi;
use Carbon\Carbon;

class refAlatBHPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = ibs_refsupervisi::get();

        $data = [
            'show' => $show,
        ];
        // print_r($data);
        // die();

        return view('pages.ibs.supervisi.ref')->with('list', $data);
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
        $this->validate($request,[
            'supervisi' => 'required',
            'ruang' => 'required',
            ]);
            
        $tgl = Carbon::now();
        $data = new ibs_refsupervisi;
        $data->supervisi = $request->supervisi;
        $data->ruang = $request->ruang;
        $data->tgl = $tgl;

        $data->save();

        return redirect()->back()->with('message','Tambah Pengecekan Alat dan Kelengkapan BHP Berhasil.');
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
        $this->validate($request,[
            'supervisi' => 'required',
            'ruang' => 'required',
            ]);
        
        $tgl = Carbon::now();

        $data = ibs_refsupervisi::find($id);
        $data->supervisi = $request->supervisi;
        $data->ruang = $request->ruang;
        $data->tgl = $tgl;

        $data->save();
        return redirect()->back()->with('message','Perubahan Pengecekan Alat dan Kelengkapan BHP Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ibs_refsupervisi::find($id);
        $data->delete();

        // redirect
        return redirect()->back()->with('message','Hapus Pengecekan Alat dan Kelengkapan BHP Berhasil.');
    }
}

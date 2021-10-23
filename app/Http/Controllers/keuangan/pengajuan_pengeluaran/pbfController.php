<?php

namespace App\Http\Controllers\keuangan\pengajuan_pengeluaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\pbf;
use Carbon\Carbon;

class pbfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = pbf::get();
        $jenis = pbf::select('jenis')->groupBy('jenis')->get();

        $data = [
            'show' => $show,
            'jenis' => $jenis,
        ];

        return view('pages.keu.pbf')->with('list', $data);
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
            'pbf' => 'nullable',
            'jenis' => 'nullable',
            ]);
            
        $data = new pbf;
        $data->pbf = $request->pbf;
        $data->jenis = $request->jenis;

        $data->save();

        return redirect()->back()->with('message','Tambah PBF Berhasil');
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
        $data = pbf::find($id);
        $data->pbf = $request->pbf;
        $data->jenis = $request->jenis;

        $data->save();

        return redirect()->back()->with('message','Ubah PBF Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = pbf::find($id);
        $data->delete();

        // redirect
        return redirect()->back()->with('message','Hapus PBF Berhasil');
    }

    public function apiPbf($jenis)
    {
        $data = pbf::where('jenis',$jenis)->get();
        // print_r($data[0]);
        // die();
        return response()->json($data, 200);
    }
}

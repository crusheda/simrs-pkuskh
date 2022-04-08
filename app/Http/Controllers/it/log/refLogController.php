<?php

namespace App\Http\Controllers\it\log;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\ref_logit;
use Carbon\Carbon;

class refLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = ref_logit::get();

        $data = [
            'show' => $show,
        ];

        return view('pages.new.it.supervisi.ref_supervisi')->with('list', $data);
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
            'kegiatan' => 'required',
            'kategori' => 'required',
            ]);
            
        $data = new ref_logit;
        $data->kegiatan = $request->kegiatan;
        $data->kategori = $request->kategori;

        $data->save();

        return redirect()->back()->with('message','Tambah Indikator Supervisi Berhasil.');
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
            'kegiatan' => 'required',
            'kategori' => 'required',
            ]);

        $data = ref_logit::find($id);
        $data->kegiatan = $request->kegiatan;
        $data->kategori = $request->kategori;

        $data->save();
        return redirect()->back()->with('message','Perubahan Indikator Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ref_logit::find($id);
        $data->delete();

        // redirect
        return redirect()->back()->with('message','Hapus Indikator Supervisi Berhasil.');
    }

    public function getKegiatan($id)
    {
        $data = ref_logit::where('id', $id)->get();

        return response()->json($data, 200);
    }
}

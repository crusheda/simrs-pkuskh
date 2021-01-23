<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\logtgsperawat;
use App\Models\unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class logTgsPerawatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = logtgsperawat::get();

        $data = [
            'show' => $show,
        ];
        // print_r($data);
        // die();

        return view('pages.logperawat.pernyataantgsperawat')->with('list', $data);
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
            'unit' => 'nullable',
            'pernyataan' => 'nullable',
            ]);

        $data = new logtgsperawat;
        $data->unit = $request->unit;
        $data->pernyataan = $request->pernyataan;

        $data->save();

        return redirect('/logtgsperawat')->with('message','Tambah Pernyataan Penunjang Tugas Berhasil.');
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
            'unit' => 'nullable',
            'pernyataan' => 'nullable',
            ]);

        $data = logtgsperawat::find($id);
        $data->unit = $request->unit;
        $data->pernyataan = $request->pernyataan;

        $data->save();

        return redirect()->back()->with('message','Ubah Pernyataan Penunjang Tugas Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = logtgsperawat::find($id);
        $data->delete();

        // redirect
        return \Redirect::to('logtgsperawat')->with('message','Hapus Pernyataan Penunjang Tugas Berhasil.');
    }
}

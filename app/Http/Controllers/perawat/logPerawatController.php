<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\logperawat;
use App\Models\unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class logPerawatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = logperawat::get();

        $data = [
            'show' => $show,
        ];
        // print_r($data);
        // die();

        return view('pages.logperawat.pertanyaanlog')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.logperawat.pertanyaanlog');
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
            'pertanyaan' => 'nullable',
            ]);
            
        $data = new logperawat;
        $data->unit = $request->unit;
        $data->pertanyaan = $request->pertanyaan;
        $data->box = $request->box;

        $data->save();

        return redirect('/logperawat')->with('message','Tambah Pertanyaan Log Perawat Berhasil.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = logperawat::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = logperawat::find($id);
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
            'unit' => 'required',
            'pertanyaan' => 'nullable',
            'box' => 'nullable',
            ]);
        $data = logperawat::find($id);
        $data->unit = $request->unit;
        $data->pertanyaan = $request->pertanyaan;
        $data->box = $request->box;

        $data->save();
        return redirect('/logperawat')->with('message','Perubahan Pertanyaan Log Perawat Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = logperawat::find($id);
        $data->delete();

        // redirect
        return \Redirect::to('logperawat')->with('message','Hapus Pertanyaan Log Perawat Berhasil.');
    }
}

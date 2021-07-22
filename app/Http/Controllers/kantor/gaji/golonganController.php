<?php

namespace App\Http\Controllers\kantor\gaji;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\gaji\golongan;
use Carbon\Carbon;
use Exception;
use Redirect;
use Auth;

class golonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = golongan::get();

        $data = [
            'show' => $show
        ];
        
        // print_r($getmont);
        // die();

        // print_r($data['show']);
        // die();
        return view('pages.kantor.kepegawaian.gaji.golongan')->with('list', $data);
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
        $data = new golongan;
        $data->nama  = $request->nama;
        $data->ket  = $request->ket;
        $data->nominal  = $request->nominal;
        
        $data->save();
        return redirect::back()->with('message','Golongan '.$request->nama.' Berhasil Ditambahkan');
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
        $data = golongan::find($id);

        $data->nama  = $request->nama;
        $data->ket  = $request->ket;
        $data->nominal  = $request->nominal;
        
        $data->save();
        return redirect::back()->with('message','Ubah Golongan Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = golongan::find($id);
        $data->delete();

        return redirect::back()->with('message','Hapus Golongan Berhasil');
    }
}

<?php

namespace App\Http\Controllers\ppi;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ppi\plebitis;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;
use Response;
use Exception;

class PlebitisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $user = Auth::user();
        $role = $user->roles->first()->name; //kabag-keperawatan
        
        $show = plebitis::get();

        $data = [
            'show' => $show,
            'role' => $role,
            'now' => $now,
        ];
        
        return view('pages.ppi.plebitis')->with('list', $data);
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
        $user = Auth::user();
        $user_id = $user->id;

        // print_r($request->rm);
        // die();

        $data = new antigen;
        $data->dr_pengirim  = $request->dr_pengirim;
        $data->pemeriksa  = $request->pemeriksa;
        if ($request->nama == '') {
            return redirect::back()->withErrors('Nomor RM yang anda masukkan Tidak Valid, mohon ulangi sekali lagi.');
        }

        $data->rm           = $request->rm;
        $data->nama         = $request->nama;
        $data->jns_kelamin  = $request->jns_kelamin;
        $data->umur         = $request->umur;
        $data->alamat       = $request->alamat.', '.strtoupper($request->kec).', '.strtoupper($request->kab);
        $data->tgl          = $request->tgl;
        $data->hasil        = $request->hasil;
        $data->pj           = $pj;
        $data->user_id      = $user_id;

        $data->desa         = $request->des;
        $data->kecamatan    = $request->kec;
        $data->kabupaten    = $request->kab;
        
        $data->save();
        return redirect::back()->with('message','Hasil Antigen Berhasil Ditambahkan a/n '.$request->nama);
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
        //
    }
}

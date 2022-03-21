<?php

namespace App\Http\Controllers\ppi;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ppi\ido;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;
use Response;
use Exception;

class IdoController extends Controller
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
        
        $show = ido::get();
        $user = DB::table('users')
                ->where('users.status',null)
                ->get();

        $data = [
            'show' => $show,
            'user' => $user,
            'role' => $role,
            'now' => $now,
        ];
        
        return view('pages.new.laporan.ppi.ido')->with('list', $data);
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

        if ($request->nama == '') {
            return redirect::back()->withErrors('Nomor RM yang anda masukkan Tidak Valid, mohon ulangi sekali lagi.');
        }

        $data = new ido;
        $data->rm = $request->rm;
        $data->nama = $request->nama;
        $data->umur = $request->umur;
        $data->tgl_operasi = $request->tgl_operasi;
        $data->tgl_ditemukan = $request->tgl_ditemukan;
        $data->ket  = $request->ket;
        $data->id_user  = $user_id;
        $data->save();

        return redirect::back()->with('message','Data berhasil ditambahkan a/n '.$request->nama);
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
        $data = ido::find($id);
        $data->tgl_operasi = $request->tgl_operasi;
        $data->tgl_ditemukan = $request->tgl_ditemukan;
        $data->ket  = $request->ket;
        $data->save();
        
        return redirect::back()->with('message','Data berhasil diubah a/n '.$data->nama);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ido::find($id);
        $nama = $data->nama;
        $data->delete();

        return redirect::back()->with('message','Data a/n '.$nama.' berhasil dihapus');
    }
}

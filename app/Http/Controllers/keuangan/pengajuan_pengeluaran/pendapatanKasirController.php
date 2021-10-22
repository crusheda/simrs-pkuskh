<?php

namespace App\Http\Controllers\keuangan\pengajuan_pengeluaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\pendapatan_kasir;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;
use Response;
use Exception;

class pendapatanKasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $hari = Carbon::now()->isoFormat('DD');
        $bulan = Carbon::now()->isoFormat('MM');
        $tahun = Carbon::now()->isoFormat('YYYY');

        $user = Auth::user();
        $role = $user->roles->first()->name; //kabag-keperawatan
        
        $show = pendapatan_kasir::get();
        // $show = DB::table('keu_pendapatan_kasir')
        //         ->orderBy('tgl','DESC')
        //         ->whereDay('created_at', $hari)
        //         ->whereMonth('created_at', $bulan)
        //         ->whereYear('created_at', $tahun)
        //         ->where('deleted_at', null)
        //         ->get();
        $user = DB::table('users')
                ->where('users.status',null)
                ->get();

        $data = [
            'show' => $show,
            'user' => $user,
            'role' => $role,
            'now' => $now,
        ];
        
        return view('pages.keu.pendapatan-kasir')->with('list', $data);
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
        if ($request->bank == 'Pilih' && $request->shift == 'Pilih') {
            return redirect::back()->withErrors('Gagal menambahkan data, anda belum mengisi Bank & Shift');
        } elseif ($request->bank == 'Pilih') {
            return redirect::back()->withErrors('Gagal menambahkan data, anda belum mengisi Bank');
        } elseif ($request->shift == 'Pilih') {
            return redirect::back()->withErrors('Gagal menambahkan data, anda belum mengisi Shift');
        }

        $user = Auth::user();
        $userId = $user->id;

        $now = Carbon::now();

        $nominal = str_replace(".","",(str_replace("Rp. ", "", $request->nominal)));

        $data = new pendapatan_kasir;
        $data->rm = $request->rm;
        $data->nama = $request->nama;
        $data->poli = $request->poli;
        $data->cara_bayar = $request->cara_bayar;
        $data->bank = $request->bank;
        $data->shift = $request->shift;
        $data->nominal = $nominal;
        $data->tgl = $now;
        $data->ket = $request->ket;
        $data->id_user = $userId;

        $data->save();
        return Redirect::back()->with('message','Tambah Data Pendapatan / Penerimaan Berhasil');
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
        if ($request->bank == 'Pilih') {
            return redirect::back()->withErrors('Mohon maaf, anda belum mengisi Bank');
        } elseif ($request->shift == 'Pilih') {
            return redirect::back()->withErrors('Mohon maaf, anda belum mengisi Shift');
        }

        $nominal = str_replace(".","",(str_replace("Rp. ", "", $request->nominal)));

        $data = pendapatan_kasir::find($id);
        $data->bank = $request->bank;
        $data->shift = $request->shift;
        $data->nominal = $nominal;
        $data->ket = $request->ket;
        $data->save();
        return Redirect::back()->with('message','Ubah Data Pendapatan / Penerimaan Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = pendapatan_kasir::find($id);
        $data->delete();

        // redirect
        return Redirect::back()->with('message','Hapus Data Pendapatan / Penerimaan Berhasil');
    }
}

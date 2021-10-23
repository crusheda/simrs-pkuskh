<?php

namespace App\Http\Controllers\keuangan\pengajuan_pengeluaran;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\pengajuan_pembayaran;
use App\Models\pbf;
use App\User;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;
use Response;
use Exception;

class pengajuanPembayaranController extends Controller
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
        
        $show = pengajuan_pembayaran::get();
        $pbf = pbf::get();
        $jenis = pbf::select('jenis')->groupBy('jenis')->get();

        // $show = DB::table('keu_pendapatan_kasir')
        //         ->orderBy('tgl','DESC')
        //         ->whereDay('created_at', $hari)
        //         ->whereMonth('created_at', $bulan)
        //         ->whereYear('created_at', $tahun)
        //         ->where('deleted_at', null)
        //         ->get();

        $data = [
            'show' => $show,
            'jenis' => $jenis,
            'pbf' => $pbf,
            'now' => $now,
        ];
        
        return view('pages.keu.pengajuan-pembayaran')->with('list', $data);
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
        if ($request->jenis == 'Pilih' && $request->pbf == 'Pilih') {
            return redirect::back()->withErrors('Gagal menambahkan data, anda belum mengisi Jenis & PBF');
        } elseif ($request->jenis == 'Pilih') {
            return redirect::back()->withErrors('Gagal menambahkan data, anda belum mengisi Jenis');
        } elseif ($request->pbf == 'Pilih') {
            return redirect::back()->withErrors('Gagal menambahkan data, anda belum mengisi PBF');
        }

        $user = Auth::user();
        $userId = $user->id;

        $now = Carbon::now();

        $nominal = str_replace(".","",(str_replace("Rp. ", "", $request->nominal)));

        $data = new pengajuan_pembayaran;
        $data->jenis = $request->jenis;
        $data->pbf = $request->pbf;
        $data->no_faktur = $request->no_faktur;
        $data->tgl_pembelian = $request->tgl_pembelian;
        $data->tgl_jatuh_tempo = $request->tgl_jatuh_tempo;
        $data->transaksi = $request->transaksi;
        if ($request->bank != null) {
            $data->bank = $request->bank;
        }
        if ($request->no_rek != null) {
            $data->no_rek = $request->no_rek;
        }
        $data->nominal = $nominal;
        $data->tgl = $now;
        $data->id_user = $userId;

        $data->save();
        return Redirect::back()->with('message','Tambah Data Pengajuan Pembayaran Berhasil');
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
        if ($request->jenis == 'Pilih' && $request->pbf == 'Pilih') {
            return redirect::back()->withErrors('Gagal menambahkan data, anda belum mengisi Jenis & PBF');
        } elseif ($request->jenis == 'Pilih') {
            return redirect::back()->withErrors('Gagal menambahkan data, anda belum mengisi Jenis');
        } elseif ($request->pbf == 'Pilih') {
            return redirect::back()->withErrors('Gagal menambahkan data, anda belum mengisi PBF');
        }

        $user = Auth::user();
        $userId = $user->id;
        
        $nominal = str_replace(".","",(str_replace("Rp. ", "", $request->nominal)));

        $data = pengajuan_pembayaran::find($id);
        $data->jenis = $request->jenis;
        $data->pbf = $request->pbf;
        $data->no_faktur = $request->no_faktur;
        $data->tgl_pembelian = $request->tgl_pembelian;
        $data->tgl_jatuh_tempo = $request->tgl_jatuh_tempo;
        $data->transaksi = $request->transaksi;
        if ($request->bank != null) {
            $data->bank = $request->bank;
        } else {
            $data->bank = null;
        }
        if ($request->no_rek != null) {
            $data->no_rek = $request->no_rek;
        } else {
            $data->no_rek = null;
        }
        $data->nominal = $nominal;
        $data->id_user = $userId;
        $data->save();

        return Redirect::back()->with('message','Ubah Data Pengajuan Pembayaran Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = pengajuan_pembayaran::find($id);
        $data->delete();

        // redirect
        return Redirect::back()->with('message','Hapus Data Pengajuan Pembayaran Berhasil');
    }

    public function showVerif()
    {
        $now = Carbon::now();
        $hari = Carbon::now()->isoFormat('DD');
        $bulan = Carbon::now()->isoFormat('MM');
        $tahun = Carbon::now()->isoFormat('YYYY');

        $user = Auth::user();
        $name = $user->name;
        if ( Auth::user()->hasRole("kasubag-perbendaharaan") ) {
            $show = DB::table('keu_pengajuan_pembayaran')
                    ->orderBy('tgl','DESC')
                    ->where('verif_kabag', '!=', null)
                    ->where('deleted_at', null)
                    ->get();
        } elseif ( Auth::user()->hasRole("kabag-keuangan") ) {
            $show = pengajuan_pembayaran::get();
        }

        $data = [
            'show' => $show,
            'now' => $now,
        ];
        
        return view('pages.keu.verif-pengajuan')->with('list', $data);
    }

    public function verifikasikabag(Request $request, $id)
    {
        $now = Carbon::now();

        $data = pengajuan_pembayaran::find($id);
        $data->verif_kabag = $now;
        $data->status_kabag = $request->status_kabag;
        if ($request->status_kabag == 'LAINLAIN') {
            $data->ket_lainlain_kabag = $request->ket_lainlain_kabag;
        } else {
            $data->ket_lainlain_kabag = null;
        }
        $data->save();

        return Redirect::back()->with('message','Verifikasi Data PBF '.$data->pbf.' Berhasil');
    }

    public function destroyVerifKabag($id)
    {
        $data = pengajuan_pembayaran::find($id);
        $data->verif_kabag = null;
        $data->status_kabag = null;
        $data->ket_lainlain_kabag = null;
        $data->save();

        // redirect
        return Redirect::back()->with('message','Hapus verifikasi Data PBF '.$data->pbf.' Berhasil');
    }

    public function verifikasikasubag(Request $request, $id)
    {
        $diskon_return = str_replace(".","",(str_replace("Rp. ", "", $request->diskon_return)));
        $now = Carbon::now();

        $data = pengajuan_pembayaran::find($id);
        $data->verif_kasubag = $now;
        $data->status_kasubag = $request->status_kasubag;
        if ($request->status_kasubag == 'LAINLAIN') {
            $data->ket_lainlain_kasubag = $request->ket_lainlain_kasubag;
        } else {
            $data->ket_lainlain_kasubag = null;
        }
        $data->diskon_return = $diskon_return;
        $data->total = $data->nominal - $diskon_return;
        $data->save();

        return Redirect::back()->with('message','Verifikasi Data PBF '.$data->pbf.' Berhasil');
    }

    public function destroyVerifKasubag($id)
    {
        $data = pengajuan_pembayaran::find($id);
        $data->verif_kasubag = null;
        $data->status_kasubag = null;
        $data->ket_lainlain_kasubag = null;
        $data->diskon_return = null;
        $data->total = null;
        $data->save();

        // redirect
        return Redirect::back()->with('message','Hapus verifikasi Data PBF '.$data->pbf.' Berhasil');
    }
}

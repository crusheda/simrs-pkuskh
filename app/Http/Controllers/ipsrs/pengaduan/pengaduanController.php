<?php

namespace App\Http\Controllers\ipsrs\pengaduan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\pengaduan_ipsrs;
use App\Models\pengaduan_ipsrs_catatan;
use App\Models\unit;
use Carbon\Carbon;
use Auth;
use Storage;
use Exception;
use Redirect;


class pengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unit = unit::pluck('id','name','nama');
        $user = Auth::user();
        $name = $user->name;
        $role = $user->roles->first()->name; //kabag-keperawatan
        
        if (Auth::user()->hasRole('ipsrs')) {
            $show = pengaduan_ipsrs::where('tgl_selesai', null)->get();
            $showrecent = pengaduan_ipsrs::whereNotNull('tgl_selesai')->get();
        }else {
            $show = pengaduan_ipsrs::where('unit', $role)->get();
        }

        $data = [
            'show' => $show,
            'showrecent' => $showrecent,
            'unit' => $unit
        ];
        // print_r($data);
        // die();

        return view('pages.ipsrs.pengaduan.laporan')->with('list', $data);
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
        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');    

        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        if ($uploadedFile == '') {
            $path = '';
            $title = '';
        }else {
            $path = $uploadedFile->store('public/files/ipsrs/pengaduan');
            $title = $uploadedFile->getClientOriginalName();
        }
        // print_r($path);
        // die();

        $user = Auth::user();
        $user_id = $user->id; 
        $name = $user->name; //jamhuri$user = Auth::user();
        $role = $user->roles->first()->name; //kabag-keperawatan
        $now = Carbon::now();

        $data = new pengaduan_ipsrs;
        $data->nama = $name;
        $data->unit = $role;
        $data->lokasi = $request->lokasi;
        $data->tgl_pengaduan = $now;
        $data->ket_pengaduan = $request->pengaduan;

            $data->title_pengaduan = $title;
            $data->filename_pengaduan = $path;

        $data->user_id = $user_id;

        $data->save();

        return Redirect::back()->with('message','Tambah Laporan Pengaduan Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = pengaduan_ipsrs::find($id);
        return Storage::download($data->filename_pengaduan, $data->title_pengaduan);
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
        $now = Carbon::now()->isoFormat('YYYY-MM-D');;

        $gettgl = pengaduan_ipsrs::where('id',$request->id)->first();
        $tgl = Carbon::parse($gettgl->tgl_pengaduan)->isoFormat('YYYY-MM-D');

        // print_r($gettgl->tgl_pengaduan);
        // die();
        if ($tgl == $now) {
            $data = pengaduan_ipsrs::find($id);
            $data->lokasi = $request->lokasi;
            $data->ket_pengaduan = $request->pengaduan;
    
            $data->save();
    
            return Redirect::back()->with('message','Ubah Laporan Pengaduan Berhasil');
        } else {
            return Redirect::back()->withErrors('Tanggal Ubah Laporan Tidak Valid. Pastikan anda mengubah laporan di hari yang sama.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $now = Carbon::now()->isoFormat('YYYY-MM-D');;

        $gettgl = pengaduan_ipsrs::where('id',$id)->first();
        $tgl = Carbon::parse($gettgl->tgl_pengaduan)->isoFormat('YYYY-MM-D');

        if ($tgl == $now) {
            $data = pengaduan_ipsrs::find($id);
            $data->delete();
    
            return Redirect::back()->with('message','Hapus Laporan Pengaduan Berhasil');
        } else {
            return Redirect::back()->withErrors('Tanggal Hapus Laporan Tidak Valid. Pastikan anda menghapus laporan di hari yang sama. Silakan hubungi IT');
        }
    }

    public function terima(Request $request)
    {
        $now = Carbon::now();
        
        $data = pengaduan_ipsrs::find($request->id);
        $data->tgl_diterima = $now;
        $data->ket_diterima = $request->ket;
        $data->save();

        return Redirect::back()->with('message','Laporan Pengaduan Berhasil Diverifikasi');
    }

    public function tolak(Request $request)
    {
        // print_r($request->id);
        // die();
        $now = Carbon::now();

        $data = pengaduan_ipsrs::find($request->id);
        $data->tgl_selesai = $now;
        $data->ket_penolakan = $request->ket;
        $data->save();

        return Redirect::back()->with('message','Laporan Pengaduan Berhasil Ditolak');
    }
}

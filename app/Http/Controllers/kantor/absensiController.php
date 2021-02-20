<?php

namespace App\Http\Controllers\kantor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\absensi;
use App\Models\absensi_hadir;
use App\Models\unit;
use App\Models\karyawan;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;

class absensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $name = $user->name;
        $role = $user->roles->first()->name; //kabag-keperawatan
        
        $show = absensi::all();
        $absensi = absensi_hadir::all();
        
        $data = [
            'show' => $show,
            'absensi' => $absensi,
        ];
        return view('pages.kantor.absensi.absensi')->with('list', $data);
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
        $data = new absensi;
        $data->kegiatan = $request->kegiatan;
        $data->lokasi = $request->lokasi;
        $data->tgl = $request->tgl;

        $data->save();
        return Redirect::back()->with('message','Tambah Absensi Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getabsensi = absensi::find($id);
        $getabsensihadir = absensi_hadir::where('absen_id', $id)->get();
        $getkaryawan = karyawan::select('id','name','unit')->get();
        // $getkaryawan = karyawan::pluck('id','name','unit');

        $data = [
            'absensi' => $getabsensi,
            'absensihadir' => $getabsensihadir,
            'karyawan' => $getkaryawan
        ];
        // print_r($data);
        // die();
        return view('pages.kantor.absensi.absensi-detail')->with('list', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = absensi::find($id);
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
        $data = absensi::find($id);
        $data->kegiatan = $request->kegiatan;
        $data->lokasi = $request->lokasi;
        $data->tgl = $request->tgl;

        $data->save();

        return Redirect::back()->with('message','Perubahan Absensi Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data1 = absensi::find($id);
        $data1->delete();

        $data2 = absensi_hadir::where('absen_id', $id)->delete();
        
        return Redirect::back()->with('message','Absensi berhasil dihapus');
    }

    public function tambahKehadiran(Request $request, $id)
    {
        $getabsensi = absensi::find($id);
        $getkaryawan = karyawan::where('id', $request->id)->first();
        // print_r($getkaryawan);
        // die();

        $data = new absensi_hadir;
        $data->absen_id = $getabsensi->id;
        $data->name = $getkaryawan->name;
        $data->unit = $getkaryawan->unit;

        $data->save();
        return Redirect::back()->with('message','Penambahan '.$getkaryawan->name.' Berhasil.');
    }

    public function ubahKehadiran(Request $request, $id)
    {
        $getkaryawan = karyawan::where('id', $request->id)->first();
        // print_r($getkaryawan);
        // die();

        $data = absensi_hadir::find($id);
        $data->name = $getkaryawan->name;
        $data->unit = $getkaryawan->unit;

        $data->save();
        return Redirect::back()->with('message','Perubahan Karyawan Berhasil.');
    }

    public function hapusKehadiran($id)
    {
        $data = absensi_hadir::find($id)->delete();

        return Redirect::back()->with('message','Karyawan Berhasil.');
    }
}

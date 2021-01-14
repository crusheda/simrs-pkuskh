<?php

namespace App\Http\Controllers\k3;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\accident_report;
use App\Models\unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Storage;
use Exception;

class accidentReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = accident_report::where('verifikasi', null)->get();
        $unit = unit::pluck('id','name');

        $data = [
            'show' => $show,
            'unit' => $unit
        ];
        // print_r($data);
        // die();

        return view('pages.k3.accident_report.index')->with('list', $data);
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
        $path = $uploadedFile->store('public/files/k3/accidentreport');
        // print_r($path);
        // die();

        $user = Auth::user();
        $name = $user->name; //jamhuri

        $thn = Carbon::now()->format('Y');
        // $thn = Carbon::now();
        $getlahir = $request->lahir;
        $parse = Carbon::parse($getlahir)->format('Y');
        // $parse = Carbon::parse($getlahir);
        $usia = $thn - $parse;

        $data = new accident_report;
        $data->tgl = $request->tgl;
        $data->lokasi = $request->lokasi;
        $data->jenis = $request->jenis;
        $data->lain1 = $request->lain1;
        $data->kronologi = $request->kronologi;
        
        $data->kerugian = $request->kerugian;
        $data->korban = $request->korban;
        $data->lahir = $request->lahir;
        $data->usia = $usia;
        $data->jk = $request->jk;
        $data->unit = $request->unit;
        $data->cedera = $request->cedera;
        $data->penanganan = $request->penanganan;
        $data->k_aset = $request->k_aset;
        $data->k_lingkungan = $request->k_lingkungan;
        
        $data->tta = $request->tta;
        $data->kta = $request->kta;
        $data->f_personal = $request->f_personal;
        $data->f_pekerjaan = $request->f_pekerjaan;
        $data->p_kerja = $request->p_kerja;
        $data->mesin = $request->mesin;
        $data->material = $request->material;
        $data->alat_berat = $request->alat_berat;
        $data->kendaraan = $request->kendaraan;
        $data->benda_bergerak = $request->benda_bergerak;
        $data->bejana_tekan = $request->bejana_tekan;
        $data->alat_listrik = $request->alat_listrik;
        $data->radiasi = $request->radiasi;
        $data->binatang = $request->binatang;
        $data->lain2 = $request->lain2;
        
        $data->r_tindakan = $request->r_tindakan;
        $data->t_waktu = $request->t_waktu;
        $data->wewenang = $request->wewenang;

        $data->title = $request->title ?? $uploadedFile->getClientOriginalName();
        $data->filename = $path;
        $data->user = $name;

        
        $data->save();

        return redirect('/k3/accidentreport')->with('message','Tambah Laporan Kecelakaan Kerja Berhasil.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = accident_report::find($id);
        return Storage::download($data->filename, $data->title);
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
        $data = accident_report::find($id);
        $data->tgl = $request->tgl;
        $data->lokasi = $request->lokasi;
        $data->jenis = $request->jenis;
        $data->lain1 = $request->lain1;
        $data->kronologi = $request->kronologi;
        
        $data->kerugian = $request->kerugian;
        $data->korban = $request->korban;
        $data->lahir = $request->lahir;
        $data->usia = $usia;
        $data->jk = $request->jk;
        $data->unit = $request->unit;
        $data->cedera = $request->cedera;
        $data->k_aset = $request->k_aset;
        $data->k_lingkungan = $request->k_lingkungan;
        
        $data->tta = $request->tta;
        $data->kta = $request->kta;
        $data->f_personal = $request->f_personal;
        $data->f_pekerjaan = $request->f_pekerjaan;
        $data->p_kerja = $request->p_kerja;
        $data->mesin = $request->mesin;
        $data->material = $request->material;
        $data->alat_berat = $request->alat_berat;
        $data->kendaraan = $request->kendaraan;
        $data->benda_bergerak = $request->benda_bergerak;
        $data->bejana_tekan = $request->bejana_tekan;
        $data->alat_listrik = $request->alat_listrik;
        $data->radiasi = $request->radiasi;
        $data->binatang = $request->binatang;
        $data->lain2 = $request->lain2;
        
        $data->r_tindakan = $request->r_tindakan;
        $data->t_waktu = $request->t_waktu;
        $data->wewenang = $request->wewenang;

        // print_r($data);
        // die();
        $data->save();

        return redirect('/k3/accidentreport')->with('message','Perubahan Laporan Kecelakaan Kerja Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = accident_report::find($id);
        $data->delete();

        // redirect
        return \Redirect::to('/rapat')->with('message','Hapus Notulen Rapat Berhasil');
    }

    public function download(Request $id)
    {
        $data = accident_report::find($id);
        $data->filename = $filename;
        $path = storage_path($filename);

        return response()->file($pathToFile, $headers);
    }

    public function cetak($id)
    {
        # code...
    }

    public function verifikasi($id)
    {
        # code...
    }
}

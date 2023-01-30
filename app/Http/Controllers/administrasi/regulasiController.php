<?php

namespace App\Http\Controllers\administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\regulasi\spo;
use App\Models\regulasi\pedoman;
use App\Models\regulasi\panduan;
use App\Models\regulasi\program;
use App\Models\regulasi\kebijakan;
use App\Models\trans_regulasi;
use App\Models\unit;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;
use Response;
use Exception;

class regulasiController extends Controller
{
    public function index()
    {
        $unit = unit::orderBy('nama','asc')->get();

        $data = [
            'unit' => $unit,
        ];
        
        return view('pages.administrasi.regulasi.index')->with('list', $data);
    }

    public function download($id)
    {
        $data = trans_regulasi::where('id', $id)->first();
        $filename = $data->filename;
        $title = $data->title;
        return Storage::download($filename, $title);
    }

    // API
    public function showTambah()
    {
        $unit = unit::orderBy('nama','asc')->get();

        return response()->json($unit, 200);
    }

    public function showUbah($id)
    {
        $show = trans_regulasi::find($id);
        $unit = unit::orderBy('nama','asc')->get();

        $data = [
            'show' => $show,
            'unit' => $unit,
        ];

        return response()->json($data, 200);
    }

    public function tambah(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $request->validate([
            'file' => ['max:20000|mimes:pdf'],
        ]);

        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');     

        $title = $uploadedFile->getClientOriginalName();
        $validasiFile = trans_regulasi::where('title',$title)->first();
        if (empty($validasiFile)) {
            // simpan berkas yang diunggah ke sub-direktori 'public/files'
            // direktori 'files' otomatis akan dibuat jika belum ada
            if ($request->jns_regulasi == 1) {
                $path = $uploadedFile->store('public/files/regulasi/kebijakan');
            } elseif ($request->jns_regulasi == 2) {
                $path = $uploadedFile->store('public/files/regulasi/panduan');
            } elseif ($request->jns_regulasi == 3) {
                $path = $uploadedFile->store('public/files/regulasi/pedoman');
            } elseif ($request->jns_regulasi == 4) {
                $path = $uploadedFile->store('public/files/regulasi/program');
            } elseif ($request->jns_regulasi == 5) {
                $path = $uploadedFile->store('public/files/regulasi/spo');
            } elseif ($request->jns_regulasi == 6) {
                $path = $uploadedFile->store('public/files/regulasi/ppk');
            }
    
            $data = new trans_regulasi;
            $data->id_user = Auth::user()->id;
            $data->jns_regulasi = $request->jns_regulasi;
            $data->sah = $request->tgl;
            $data->judul = $request->judul;
            $data->pembuat = $request->pembuat;
            $data->unit = $request->unit;
    
                $data->title = $title;
                $data->filename = $path;
    
            // print_r($data);
            // die();
            $data->save();
    
            return response()->json($tgl, 200);
        } else {
            $error = 'File sudah ada/pernah diupload sebelumnya!';
            return response()->json($error, 400);
        }
    }
    
    public function ubah(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('YYYY-MM-DD HH:mm:ss');

        $request->validate([
            'file' => ['max:20000|mimes:pdf|nullable'],
        ]);

        $uploadedFile = $request->file('file');

        if ($uploadedFile == null) {
            $data = trans_regulasi::find($request->id_edit);
            $data->id_user = Auth::user()->id;
            $data->jns_regulasi = $request->jns_regulasi;
            $data->sah = $request->tgl;
            $data->judul = $request->judul;
            $data->pembuat = $request->pembuat;
            $data->unit = $request->unit;
    
            $data->save();
            return response()->json($tgl, 200);
        } else {
            $title = $uploadedFile->getClientOriginalName();
            $validasiFile = trans_regulasi::where('title',$title)->first();
            if (empty($validasiFile)) {

                // Cari Berkas Lama
                $fileLama = $validasiFile->filename;
                // Hapus Berkas Lama
                Storage::delete($fileLama);

                // simpan berkas yang diunggah ke sub-direktori 'public/files'
                // direktori 'files' otomatis akan dibuat jika belum ada
                if ($request->jns_regulasi == 1) {
                    $path = $uploadedFile->store('public/files/regulasi/kebijakan');
                } elseif ($request->jns_regulasi == 2) {
                    $path = $uploadedFile->store('public/files/regulasi/panduan');
                } elseif ($request->jns_regulasi == 3) {
                    $path = $uploadedFile->store('public/files/regulasi/pedoman');
                } elseif ($request->jns_regulasi == 4) {
                    $path = $uploadedFile->store('public/files/regulasi/program');
                } elseif ($request->jns_regulasi == 5) {
                    $path = $uploadedFile->store('public/files/regulasi/spo');
                } elseif ($request->jns_regulasi == 6) {
                    $path = $uploadedFile->store('public/files/regulasi/ppk');
                }
    
                $data = trans_regulasi::find($request->id_edit);
                $data->id_user = Auth::user()->id;
                $data->jns_regulasi = $request->jns_regulasi;
                $data->sah = $request->tgl;
                $data->judul = $request->judul;
                $data->pembuat = $request->pembuat;
                $data->unit = $request->unit;
        
                    $data->title = $title;
                    $data->filename = $path;
        
                $data->save();
                return response()->json($tgl, 200);
            } else {
                $error = 'File sudah ada/pernah diupload sebelumnya!';
                return response()->json($error, 400);
            }
        }


        return response()->json($now, 200);
    }

    public function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $data = trans_regulasi::find($id);
        $file = $data->filename;
        
        // Proses Hapus
        Storage::delete($file);
        $data->delete();
                
        return response()->json($tgl, 200);
    }

    public function cariRegulasi(Request $request)
    {
        $unit = unit::orderBy('nama','asc')->get();
        
        if ($request->regulasi != null) {
            if ($request->waktu != null) {
                $month = Carbon::parse($request->waktu)->isoFormat('MM');
                $year = Carbon::parse($request->waktu)->isoFormat('YYYY');
                if ($request->pembuat != null) {
                    $query_string = "SELECT * FROM trans_regulasi WHERE MONTH(sah) = $month AND YEAR(sah) = $year AND jns_regulasi = $request->regulasi AND pembuat = $request->pembuat AND deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                } else {
                    $query_string = "SELECT * FROM trans_regulasi WHERE MONTH(sah) = $month AND YEAR(sah) = $year AND jns_regulasi = $request->regulasi AND deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                }
            } else {
                if ($request->pembuat != null) {
                    $query_string = "SELECT * FROM trans_regulasi WHERE jns_regulasi = $request->regulasi AND pembuat = $request->pembuat AND deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                } else {
                    $query_string = "SELECT * FROM trans_regulasi WHERE jns_regulasi = $request->regulasi AND deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                }
            }
        } else {
            if ($request->waktu != null) {
                $month = Carbon::parse($request->waktu)->isoFormat('MM');
                $year = Carbon::parse($request->waktu)->isoFormat('YYYY');
                if ($request->pembuat != null) {
                    $query_string = "SELECT * FROM trans_regulasi WHERE MONTH(sah) = $month AND YEAR(sah) = $year AND pembuat = $request->pembuat AND deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                } else {
                    $query_string = "SELECT * FROM trans_regulasi WHERE MONTH(sah) = $month AND YEAR(sah) = $year AND deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                }
            } else {
                if ($request->pembuat != null) {
                    $query_string = "SELECT * FROM trans_regulasi WHERE pembuat = $request->pembuat AND deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                } else {
                    $query_string = "SELECT * FROM trans_regulasi WHERE deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                }
            }
        }
        
        $data = [
            'show' => $show,
            'unit' => $unit,
            'count' => count($show),
        ];

        return response()->json($data, 200);
    }
    public function apiTotalRegulasi()
    {
        $totKebijakan   = trans_regulasi::where('jns_regulasi',1)->count();
        $totPanduan     = trans_regulasi::where('jns_regulasi',2)->count();
        $totPedoman     = trans_regulasi::where('jns_regulasi',3)->count();
        $totProgram     = trans_regulasi::where('jns_regulasi',4)->count();
        $totSpo         = trans_regulasi::where('jns_regulasi',5)->count();

        $total = $totKebijakan + $totPedoman + $totPanduan + $totProgram + $totSpo;
        // print_r($total);
        // die();

        $data = [
            'total' => $total,
            'totkebijakan' => $totKebijakan,
            'totpedoman' => $totPedoman,
            'totpanduan' => $totPanduan,
            'totprogram' => $totProgram,
            'totspo' => $totSpo,
        ];

        return response()->json($data, 200);
    }
}

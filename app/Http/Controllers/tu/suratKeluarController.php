<?php

namespace App\Http\Controllers\tu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\tu\kdsuratkeluar;
use App\Models\tu\suratkeluar;
use App\Models\user;
use Carbon\Carbon;
use Validator,Redirect,Response,File;
use Exception;
use Storage;
use Auth;

class suratKeluarController extends Controller
{
    public function index()
    {
        $users = user::whereNotNull('nik')->where('status',null)->orderBy('nama','ASC')->get();
        $kode = kdsuratkeluar::orderBy('nama','ASC')->get();
        $year = Carbon::now()->isoFormat('YYYY');
        
        $getUrutan = suratkeluar::orderBy('urutan','DESC')->first();
        if (empty($getUrutan->urutan)) {
            // $urutan = 1;
            $urutan = sprintf("%03d", 1);
        } else {
            // $urutan = $getUrutan->urutan + 1;
            $urutan = sprintf("%03d", $getUrutan->urutan + 1);
        }

        $data = [
            'users' => $users,
            'kode' => $kode,
            'urutan' => $urutan,
            'year' => $year,
        ];

        return view('pages.tu.suratkeluar')->with('list', $data);
    }

    public function apiKode($id)
    {
        $data = kdsuratkeluar::find($id);
        
        return response()->json($data->kode, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => ['max:20000','mimes:pdf'],
            'tgl_diterima' => 'required',
            'asal' => 'required',
            'nomor' => 'required',
            'user' => 'required'
        ]);

        if ($request->waktu == null) {
            $tglFrom    = null;
            $tglTo      = null;
        } else {
            if (strlen($request->waktu) == 10) {
                $tglFrom    = $request->waktu;
                $tglTo      = null;
            } else {
                $dates = explode(' to ', $request->waktu);
                
                $tglFrom = Carbon::parse($dates[0]);
                $tglTo = Carbon::parse($dates[1]);
            }
        }
        
        $getFile = $request->file('file');
        if ($getFile == null) {
            $path = null;
            $title = null;
        } else {
            // simpan berkas yang diunggah ke sub-direktori $path
            // direktori 'files' otomatis akan dibuat jika belum ada
            $path = $getFile->store('public/files/tu/suratmasuk');
            $title = $getFile->getClientOriginalName();
        }

        $getUrutan = suratmasuk::orderBy('urutan','DESC')->first();
        if (empty($getUrutan->urutan)) {
            $urutan = 1;
        } else {
            $urutan = $getUrutan->urutan + 1;
        }

        $data               = new suratmasuk;
        $data->urutan       = $urutan;
        $data->tgl_surat    = $request->tgl_surat;
        $data->tgl_diterima = $request->tgl_diterima;
        $data->asal         = $request->asal;
        $data->nomor        = $request->nomor;
        $data->deskripsi    = $request->deskripsi;
        $data->tempat       = $request->tempat;
        $data->tglFrom      = $tglFrom;
        $data->tglTo        = $tglTo;
        $data->title        = $title;
        $data->filename     = $path;
        $data->user         = $request->user;

        $data->save();
        return redirect::back()->with('message','Tambah Berkas Surat Keluar Berhasil!');
    }

    // API
    public function apiGet()
    {
        $show = suratmasuk::limit('30')->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    public function download($id)
    {
        $data = suratmasuk::find($id);
        return Storage::download($data->filename, $data->title);
    }

    public function showChange($id)
    {
        $show = suratmasuk::find($id);

        if ($show->tglTo == null) {
            $tglFrom = Carbon::parse($show->tglFrom)->isoFormat('YYYY-MM-DD');
            $waktu = $tglFrom; 
        } else {
            $tglFrom = Carbon::parse($show->tglFrom)->isoFormat('YYYY-MM-DD');
            $tglTo = Carbon::parse($show->tglTo)->isoFormat('YYYY-MM-DD');
            $waktu = $tglFrom.' to '.$tglTo; 
        }

        $data = [
            'show' => $show,
            'waktu' => $waktu,
        ];

        return response()->json($data, 200);
    }

    // public function update(Request $request, $id)
    // {
    //     // $getFile = $request->file('file'); 
    //     // print_r($getFile->getClientOriginalName());
    //     // die();
    //     $now = Carbon::now()->isoFormat('YYYY-MM-DD HH:mm:ss');

    //     $data = suratmasuk::find($id);
    //     $data->tgl_surat    = $request->tgl_surat;
    //     $data->tgl_diterima = $request->tgl_diterima;
    //     $data->asal         = $request->asal;
    //     $data->nomor        = $request->nomor;
    //     $data->deskripsi    = $request->deskripsi;
    //     $data->tempat       = $request->tempat;
    //     $data->user         = $request->user;
        
    //     if ($request->waktu == null) {
    //         $tglFrom    = null;
    //         $tglTo      = null;
    //     } else {
    //         if (strlen($request->waktu) == 10) {
    //             $tglFrom    = $request->waktu;
    //             $tglTo      = null;
    //         } else {
    //             $dates = explode(' to ', $request->waktu);
                
    //             $tglFrom = Carbon::parse($dates[0]);
    //             $tglTo = Carbon::parse($dates[1]);
    //         }
    //     }

    //     $data->tglFrom      = $tglFrom;
    //     $data->tglTo        = $tglTo;
        
    //     if ($data->filename == null) {
    //         if ($request->file('file')) {
    //             $path = $getFile->store('public/files/tu/suratmasuk');
    //             $title = $getFile->getClientOriginalName();
    //         } else {
    //             $path = null;
    //             $title = null;
    //         }
    //     }

    //     $data->save();

    //     return response()->json($now, 200);
    // }

    public function ubah(Request $request)
    {
        $data = array();
  
        $validator = Validator::make($request->all(), [
           'file' => 'required'
        ]);

        if ($validator->fails()) {
  
           $data['success'] = 0;
           $data['error'] = $validator->errors()->first('file');// Error response
  
        }else{
            $now = Carbon::now()->isoFormat('YYYY-MM-DD HH:mm:ss');
    
            $data = suratmasuk::find($request->id_edit);
            $data->tgl_surat    = $request->tgl_surat;
            $data->tgl_diterima = $request->tgl_diterima;
            $data->asal         = $request->asal;
            $data->nomor        = $request->nomor;
            $data->deskripsi    = $request->deskripsi;
            $data->tempat       = $request->tempat;
            $data->user         = $request->user;
            
            if ($request->waktu == null) {
                $tglFrom    = null;
                $tglTo      = null;
            } else {
                if (strlen($request->waktu) == 10) {
                    $tglFrom    = $request->waktu;
                    $tglTo      = null;
                } else {
                    $dates = explode(' to ', $request->waktu);
                    
                    $tglFrom = Carbon::parse($dates[0]);
                    $tglTo = Carbon::parse($dates[1]);
                }
            }
    
            $data->tglFrom      = $tglFrom;
            $data->tglTo        = $tglTo;
            
            if ($data->filename == null) {
                if ($request->file('file') && $request->file('file')->isValid()) {
                    $path = $request->file('file')->store('public/files/tu/suratmasuk');
                    $title = $request->file('file')->getClientOriginalName();
                } else {
                    $path = null;
                    $title = null;
                }
            }
    
            $data->filename = $path;
            $data->title    = $title; 
    
            $data->save();
        }

        return response()->json($now, 200);
    }
    
    public function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $hapusData = suratmasuk::find($id);
        
        // Proses Hapus
        $file = $hapusData->filename;
        // Storage::delete($file);
        $hapusData->delete();
        
        return response()->json($tgl, 200);
    }
}

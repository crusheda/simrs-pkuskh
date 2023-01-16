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
            'kode' => 'required',
            'tgl' => 'required',
            'tujuan' => 'required',
            'user' => 'required'
        ]);
        
        $getFile = $request->file('file');
        if ($getFile == null) {
            $path = null;
            $title = null;
        } else {
            // simpan berkas yang diunggah ke sub-direktori $path
            // direktori 'files' otomatis akan dibuat jika belum ada
            $path = $getFile->store('public/files/tu/suratkeluar');
            $title = $getFile->getClientOriginalName();
        }

        $tahunNow = Carbon::now()->isoFormat('YYYY');
        $getJenis = kdsuratkeluar::where('id',$request->kode)->first();
        $getUrutan = suratkeluar::orderBy('urutan','DESC')->first();
        if (empty($getUrutan->urutan)) {
            $urutan = 1;
        } else {
            $urutan = $getUrutan->urutan + 1;
        }

        $data               = new suratkeluar;
        $data->urutan       = $urutan;
        $data->kode         = $request->kode;
        $data->tgl          = $request->tgl;
        $data->tujuan       = json_encode($request->tujuan);
        $data->nomor        = sprintf("%03d", $urutan)."/".$getJenis->kode."/DIR/III.6.AU/PKUSKH/".$tahunNow;
        $data->jenis        = $getJenis->nama;
        $data->isi          = $request->isi;
        $data->title        = $title;
        $data->filename     = $path;
        $data->user         = $request->user;

        $data->save();
        return redirect::back()->with('message','Tambah Berkas Surat Keluar Berhasil!');
    }

    // API
    public function apiGet()
    {
        $show = suratkeluar::join('tu_kd_surat_keluar','tu_kd_surat_keluar.id','=','tu_surat_keluar.kode')->select('tu_kd_surat_keluar.kode as kode_jenis','tu_surat_keluar.*')->get();
        $getUser = user::select('id','nama')->get();
        $user = json_encode($getUser);

        $data = [
            'show' => $show,
            'user' => $user,
        ];

        return response()->json($data, 200);
    }

    public function download($id)
    {
        $data = suratkeluar::find($id);
        return Storage::download($data->filename, $data->title);
    }

    public function showChange($id)
    {
        $users = user::whereNotNull('nik')->where('status',null)->orderBy('nama','ASC')->get();
        $show = suratkeluar::find($id);
        $getKode = kdsuratkeluar::where('id',$show->kode)->first();
        $refKode = kdsuratkeluar::get();

        $kode = $getKode->kode;
        if (strlen($show->nomor) == 32) {
            $year = substr($show->nomor,28);
        } else {
            $year = substr($show->nomor,29);
        }
        $urutan = sprintf("%03d", $show->urutan);

        $data = [
            'users' => $users,
            'show' => $show,
            'refkode' => $refKode,
            'kode' => $kode,
            'year' => $year,
            'urutan' => $urutan,
        ];

        return response()->json($data, 200);
    }

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
    
            $getJenis = kdsuratkeluar::where('id', $request->kode)->first();

            $data           = suratkeluar::find($request->id_edit);
            $data->kode     = $request->kode;
            $data->tgl      = $request->tgl;
            $data->jenis    = $getJenis->nama;
            $data->isi      = $request->isi;
            $data->user     = $request->user;
            
            if ($data->filename == null) {
                if ($request->file('file') && $request->file('file')->isValid()) {
                    $path = $request->file('file')->store('public/files/tu/suratkeluar');
                    $title = $request->file('file')->getClientOriginalName();
                } else {
                    $path = null;
                    $title = null;
                }
                $data->filename = $path;
                $data->title    = $title; 
            }    
    
            $data->save();
        }

        return response()->json($now, 200);
    }
    
    public function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // Inisialisasi
        $hapusData = suratkeluar::find($id);
        
        // Proses Hapus
        $file = $hapusData->filename;
        $hapusData->delete();
        
        return response()->json($tgl, 200);
    }
}

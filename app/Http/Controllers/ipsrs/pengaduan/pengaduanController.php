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
        $user = Auth::user();
        $user_id = $user->id; 
        $name = $user->name;
        
        if (Auth::user()->hasRole(['ipsrs','it'])) {
            $show = pengaduan_ipsrs::where('tgl_selesai', null)->orderBy('tgl_pengaduan','DESC')->get();
            $total = pengaduan_ipsrs::count();
            $totalMasukPengaduan = pengaduan_ipsrs::whereNotNull('tgl_pengaduan')->where('tgl_diterima', null)->where('tgl_dikerjakan', null)->where('tgl_selesai', null)->where('ket_penolakan', null)->count();
            $totalDiverifikasi = pengaduan_ipsrs::whereNotNull('tgl_diterima')->where('tgl_dikerjakan', null)->where('tgl_selesai', null)->where('ket_penolakan', null)->count();
            $totalDikerjakan = pengaduan_ipsrs::whereNotNull('tgl_dikerjakan')->where('tgl_selesai', null)->where('ket_penolakan', null)->count();
            $totalSelesai = pengaduan_ipsrs::whereNotNull('tgl_selesai')->where('ket_penolakan', null)->count();
            $totalDitolak = pengaduan_ipsrs::whereNotNull('ket_penolakan')->count();

            $data = [
                'show' => $show,
                'total' => $total,
                'totalmasukpengaduan' => $totalMasukPengaduan,
                'totaldiverifikasi' => $totalDiverifikasi,
                'totaldikerjakan' => $totalDikerjakan,
                'totalselesai' => $totalSelesai,
                'totalditolak' => $totalDitolak,
            ];
            
            return view('pages.laporan.pengaduan.ipsrs.indexAdmin')->with('list', $data);
        }else {
            $show = pengaduan_ipsrs::where('user_id', $user_id)->get();
            $recent = pengaduan_ipsrs::where('user_id', $user_id)->where('tgl_selesai', null)->orderBy('tgl_pengaduan','DESC')->get();
            $total = pengaduan_ipsrs::where('user_id', $user_id)->count();
            $totalSelesai = pengaduan_ipsrs::where('user_id', $user_id)->where('tgl_selesai', '!=', null)->where('ket_penolakan', null)->count();
            $totalDitolak = pengaduan_ipsrs::where('user_id', $user_id)->where('ket_penolakan', '!=', null)->count();
            $tambahketerangan = pengaduan_ipsrs_catatan::get();
    
            $data = [
                'show' => $show,
                'tambahketerangan' => $tambahketerangan,
                'recent' => $recent,
                'total' => $total,
                'totalselesai' => $totalSelesai,
                'totalditolak' => $totalDitolak,
            ];
            
            return view('pages.laporan.pengaduan.ipsrs.indexUser')->with('list', $data);
        }
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
        $request->validate([
            'file' => ['image','mimes:jpg,png,jpeg,gif','max:50000'],
        ]);
        
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
        // print_r($uploadedFile);
        // die();

        $user = Auth::user();
        $user_id = $user->id; 
        $name = $user->name; //jamhuri$user = Auth::user();
        $role = $user->roles; //kabag-keperawatan
        foreach ($role as $key => $value) {
            $unitArr[] = $value->name;
        }
        $now = Carbon::now();

        $data = new pengaduan_ipsrs;
        $data->nama = $name;
        $data->unit = json_encode($unitArr);
        $data->lokasi = $request->lokasi;
        $data->tgl_pengaduan = $now;
        $data->ket_pengaduan = $request->pengaduan;

            $data->title_pengaduan = $title;
            $data->filename_pengaduan = $path;

        $data->user_id = $user_id;

        $data->save();

        return redirect()->route('ipsrs.index')->with('message','Tambah Laporan Pengaduan Berhasil oleh '.$name);
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
            if (empty($gettgl->tgl_diterima)) {
                $data = pengaduan_ipsrs::find($id);
                $data->lokasi = $request->lokasi;
                $data->ket_pengaduan = $request->pengaduan;
        
                $data->save();
        
                return Redirect::back()->with('message','Ubah Laporan Pengaduan Berhasil');
            } else {
                return Redirect::back()->withErrors('Gagal mengubah Laporan, Laporan sudah diverifikasi oleh Unit IPSRS. Silakan Konfirmasi kembali ke Unit IPSRS');
            }
        } else {
            if (!empty($gettgl->tgl_selesai)) {
                return Redirect::back()->withErrors('Gagal mengubah Laporan, Laporan sudah diselesaikan');
            } else {
                return Redirect::back()->withErrors('Tanggal Ubah Laporan Tidak Valid. Pastikan anda mengubah laporan di hari yang sama');
            }
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
            if (empty($gettgl->tgl_diterima)) {
                $data = pengaduan_ipsrs::find($id);
                $data->delete();
        
                return Redirect::back()->with('message','Hapus Laporan Pengaduan Berhasil');
            } else {
                return Redirect::back()->withErrors('Gagal menghapus Laporan, Laporan sudah diverifikasi oleh Unit IPSRS. Silakan Konfirmasi kembali ke Unit IPSRS');
            }
        } else {
            if (!empty($gettgl->tgl_selesai)) {
                return Redirect::back()->withErrors('Gagal menghapus Laporan, Laporan sudah diselesaikan');
            } else {
                return Redirect::back()->withErrors('Tanggal Hapus Laporan Tidak Valid. Pastikan anda menghapus laporan di hari yang sama');
            }
        }
    }

    public function detail($id)
    {
        $show = pengaduan_ipsrs::where('id',$id)->first();

        // $dikerjakan = DB::table('pengaduan_ipsrs_catatan')
        //         ->where('pengaduan_id',$id)
        //         ->get();

        $catatan = pengaduan_ipsrs_catatan::where('pengaduan_id',$id)->orderBy('created_at','ASC')->get();
        
        $data = [
            'show' => $show,
            'catatan' => $catatan
        ];
        // print_r($cari);
        // die();

        return view('pages.laporan.pengaduan.ipsrs.detailAdmin')->with('list', $data);
        // return view('pages.new.laporan.ipsrs.detail-pengaduan')->with('list', $data);
    }

    public function verif(Request $request)
    {
        $now = Carbon::now();
        $user = Auth::user();
        $name = $user->name;
        $user_id = $user->id;
        
        $data = pengaduan_ipsrs::find($request->id);
        $data->verifikator_id = $user_id;
        $data->tgl_diterima = $now;
        $data->ket_diterima = $request->ket;
        $data->save();

        return response()->json($name);
    }

    public function unverif(Request $request)
    {
        $now = Carbon::now();
        $user = Auth::user();
        $name = $user->name;
        $user_id = $user->id;
        
        $data = pengaduan_ipsrs::find($request->id);
        $data->verifikator_id = $user_id;
        $data->tgl_selesai = $now;
        $data->ket_penolakan = $request->ket;
        $data->save();
        
        $arr = [
            'name' => $name,
            'tolak' => $request->ket,
        ];

        return response()->json($arr);
    }

    public function process(Request $request)
    {
        $now = Carbon::now();
        $user = Auth::user();
        $name = $user->name;
        $user_id = $user->id;
        
        $data = pengaduan_ipsrs::find($request->id);
        $data->tgl_dikerjakan = $now;
        $data->ket_dikerjakan = $request->ket_pengerjaan;
        if ($request->estimasi != null) {
            $data->estimasi = $request->estimasi;
        }
        $data->save();

        return response()->json($name);
    }

    public function finish(Request $request)
    {
        $now = Carbon::now();
        $user = Auth::user();
        $name = $user->name;
        $user_id = $user->id;
        
        $data = pengaduan_ipsrs::find($request->id);
        $data->tgl_selesai = $now;
        $data->ket_selesai = $request->ket_selesai;
        $data->save();

        $catatan = pengaduan_ipsrs_catatan::where('pengaduan_id',$request->id)->get();
        $dataNew = pengaduan_ipsrs::where('id',$request->id)->get();
        
        $arr = [
            'name' => $name,
            'show' => $dataNew,
            'catatan' => $catatan
        ];

        return response()->json($arr);
    }

    public function result($id)
    {
        $show = pengaduan_ipsrs::where('id',$id)->get();
        $catatan = pengaduan_ipsrs_catatan::where('pengaduan_id',$id)->get();
        
        $data = [
            'show' => $show,
            'catatan' => $catatan
        ];

        return response()->json($data);
    }

    public function downloadCatatan($id)
    {
        $data = pengaduan_ipsrs_catatan::where('id',$id)->first();
        return Storage::download($data->filename, $data->title);
    }

    public function catatan(Request $request)
    {
        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $request->validate([
            'catatan' => ['image','mimes:jpg,png,jpeg,gif'],
        ]);

        $uploadedFile = $request->file('file');     

        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        if ($uploadedFile == '') {
            $path = '';
            $title = '';
        }else {
            $path = $uploadedFile->store('public/files/ipsrs/pengaduan/catatan');
            $title = $request->title ?? $uploadedFile->getClientOriginalName();
        }
        
        $data = new pengaduan_ipsrs_catatan;
        $data->pengaduan_id = $request->id_pengaduan;
        $data->keterangan = $request->ket_catatan;
        $data->title = $title;
        $data->filename = $path;
        $data->save();
    
        return Redirect::back()->with('message','Tambah Catatan Pengerjaan Laporan Berhasil');
    }

    public function ubahCatatan(Request $request)
    {
        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');     

        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        $data = pengaduan_ipsrs_catatan::find($request->id_catatan);

        if ($uploadedFile != '') {
            $path = $uploadedFile->store('public/files/ipsrs/pengaduan/catatan');
            $title = $request->title ?? $uploadedFile->getClientOriginalName();
            $data->title = $title;
            $data->filename = $path;
        }
        
        $data->keterangan = $request->ket_catatan;
        $data->save();
    
        return Redirect::back()->with('message','Ubah Catatan Pengerjaan Laporan Berhasil');
    }

    // public function terima(Request $request)
    // {
    //     $now = Carbon::now();
    //     $user = Auth::user();
    //     $user_id = $user->id;
        
    //     $data = pengaduan_ipsrs::find($request->id);
    //     $data->verifikator_id = $user_id;
    //     $data->tgl_diterima = $now;
    //     $data->ket_diterima = $request->ket;
    //     $data->save();

    //     return Redirect::back()->with('message','Laporan Pengaduan Berhasil Diverifikasi');
    // }

    // public function ubahTerima(Request $request)
    // {
    //     $now = Carbon::now();
        
    //     $data = pengaduan_ipsrs::find($request->id);
    //     $data->ket_diterima = $request->ket;
    //     $data->save();

    //     return Redirect::back()->with('message','Laporan Verifikasi Pengaduan Berhasil Diubah');
    // }
    
    // public function tolak(Request $request)
    // {
    //     // print_r($request->id);
    //     // die();
    //     $now = Carbon::now();

    //     $data = pengaduan_ipsrs::find($request->id);
    //     $data->tgl_selesai = $now;
    //     $data->ket_penolakan = $request->ket;
    //     $data->save();
        
    //     return Redirect::back()->with('message','Laporan Pengaduan Berhasil Ditolak');
    // }

    // public function kerjakan(Request $request)
    // {
    //     $now = Carbon::now();
        
    //     $data = pengaduan_ipsrs::find($request->id);
    //     $data->tgl_dikerjakan = $now;
    //     $data->ket_dikerjakan = $request->ket;
    //     $data->save();
    
    //     return Redirect::back()->with('message','Ubah Status Laporan Pengaduan Menjadi Dikerjakan Berhasil');
    // }

    // public function ubahKerjakan(Request $request)
    // {
    //     $now = Carbon::now();
        
    //     $data = pengaduan_ipsrs::find($request->id);
    //     $data->ket_dikerjakan = $request->ket;
    //     $data->save();

    //     return Redirect::back()->with('message','Keterangan Pengerjaan Laporan Pengaduan Berhasil Diubah');
    // }

    // public function tambahketerangan(Request $request)
    // {
    //     // tampung berkas yang sudah diunggah ke variabel baru
    //     // 'file' merupakan nama input yang ada pada form
    //     $request->validate([
    //         'catatan' => ['image','mimes:jpg,png,jpeg,gif'],
    //     ]);

    //     $uploadedFile = $request->file('catatan');     

    //     // simpan berkas yang diunggah ke sub-direktori 'public/files'
    //     // direktori 'files' otomatis akan dibuat jika belum ada
    //     if ($uploadedFile == '') {
    //         $path = '';
    //         $title = '';
    //     }else {
    //         $path = $uploadedFile->store('public/files/ipsrs/pengaduan/catatan');
    //         $title = $request->title ?? $uploadedFile->getClientOriginalName();
    //     }
        
    //     $data = new pengaduan_ipsrs_catatan;
    //     $data->pengaduan_id = $request->id;
    //     $data->keterangan = $request->ket;
    //     $data->title = $title;
    //     $data->filename = $path;
    //     // print_r($uploadedFile);
    //     // die();
    //     $data->save();
    
    //     return Redirect::back()->with('message','Tambah Keterangan Pengerjaan Laporan Berhasil');
    // }

    // public function ubahketerangan(Request $request)
    // {
    //     // tampung berkas yang sudah diunggah ke variabel baru
    //     // 'file' merupakan nama input yang ada pada form
    //     $uploadedFile = $request->file('catatan');     

    //     // simpan berkas yang diunggah ke sub-direktori 'public/files'
    //     // direktori 'files' otomatis akan dibuat jika belum ada
    //     $data = pengaduan_ipsrs_catatan::find($request->id);

    //     if ($uploadedFile != '') {
    //         $path = $uploadedFile->store('public/files/ipsrs/pengaduan/catatan');
    //         $title = $request->title ?? $uploadedFile->getClientOriginalName();
    //         $data->title = $title;
    //         $data->filename = $path;
    //     }
        
    //     $data->keterangan = $request->ket;
    //     // print_r($data);
    //     // die();
    //     $data->save();
    
    //     return Redirect::back()->with('message','Ubah Keterangan Pengerjaan Laporan Berhasil');
    // }

    // public function selesai(Request $request)
    // {
    //     $now = Carbon::now();

    //     // print_r($request->id);
    //     // die();
    //     $data = pengaduan_ipsrs::find($request->id);
    //     $data->tgl_selesai = $now;
    //     $data->ket_selesai = 'Laporan Pengaduan Selesai';
    //     $data->save();
    
    //     return Redirect::back()->with('message','Laporan Berhasil Diselesaikan');
    // }

    // public function history()
    // {
    //     $user = Auth::user();
    //     $name = $user->name;
    //     $role = $user->roles->first()->name; //kabag-keperawatan

    //     if (Auth::user()->hasRole('ipsrs')) {
    //         $showrecent = pengaduan_ipsrs::whereNotNull('tgl_selesai')->get();
    //     }else {
    //         $showrecent = '';
    //     }
        
    //     $data = [
    //         'showrecent' => $showrecent
    //     ];

    //     return view('pages.new.laporan.ipsrs.history-pengaduan')->with('list', $data);
    // }

    public function autocompleteLokasi(Request $request)
    {
        $getData = pengaduan_ipsrs::select("lokasi")
                ->where("lokasi","LIKE","%{$request->lokasi}%")
                ->groupBy ('lokasi')
                ->get();
   
        foreach ($getData as $item)
        {
            $data[] = $item->lokasi;
        }

        return response()->json($data);
    }

    public function riwayat()
    {
        return view('pages.laporan.pengaduan.ipsrs.riwayat');
    }

    public function filter(Request $request)
    {
        $from = date(Carbon::parse(substr($request->filter,0,10))->isoFormat('YYYY-MM-DD'));
        $to = date(Carbon::parse(substr($request->filter,13,10))->isoFormat('YYYY-MM-DD'));

        $user = Auth::user();
        $user_id = $user->id; 
        $name = $user->name;
        
        if (Auth::user()->hasRole(['ipsrs','it'])) {
            $data = DB::table('pengaduan_ipsrs')
                        // ->join('dokter', 'dokter.id', '=', 'antigen.dr_pengirim')
                        // ->select('antigen.*','dokter.nama as dr_nama')
                        ->orderBy('tgl_pengaduan','ASC')
                        ->where('deleted_at', null)
                        ->whereBetween('tgl_pengaduan', [$from, $to])
                        // ->whereMonth('antigen.tgl', $bulan)
                        // ->whereYear('antigen.tgl', $tahun)
                        ->get();
        } else {
            $data = DB::table('pengaduan_ipsrs')
                        // ->join('dokter', 'dokter.id', '=', 'antigen.dr_pengirim')
                        // ->select('antigen.*','dokter.nama as dr_nama')
                        ->orderBy('tgl_pengaduan','ASC')
                        ->where('user_id', $user_id)
                        ->where('deleted_at', null)
                        ->whereBetween('tgl_pengaduan', [$from, $to])
                        // ->whereMonth('antigen.tgl', $bulan)
                        // ->whereYear('antigen.tgl', $tahun)
                        ->get();
        }
        
        return response()->json($data, 200);
    }
}

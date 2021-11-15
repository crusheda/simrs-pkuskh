<?php

namespace App\Http\Controllers\kantor;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\laporan_bulanan;
use App\Models\unit;
use App\Models\setRoleUser;
use App\User;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;
use Response;
use Exception;

class laporanBulananNewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $id = $user->id;
        $name = $user->name;
        $role = $user->roles; //kabag-keperawatan

        $tgl = Carbon::now()->isoFormat('YYYY/MM/DD');
        $tglAfter3Day = Carbon::now()->addDays(3)->isoFormat('YYYY/MM/DD');
        $tglAfter2Day = Carbon::now()->addDays(2)->isoFormat('YYYY/MM/DD');
        $tglAfter1Day = Carbon::now()->addDays(1)->isoFormat('YYYY/MM/DD');
        $thn = Carbon::now()->isoFormat('Y');

        $showall = laporan_bulanan::all();
        $show = laporan_bulanan::all();

        // print_r($show);
        // die();

        $data = [
            'show' => $show,
            'showall' => $showall,
            'user' => $user,
            'tgl'  => $tgl,
            'tglAfter3Day'  => $tglAfter3Day,
            'tglAfter2Day'  => $tglAfter2Day,
            'tglAfter1Day'  => $tglAfter1Day,
            'thn'  => $thn,
            'role' => $role
        ];
        
        return view('pages.kantor.laporan.bulanan.bulananKabag')->with('list', $data);
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
        $userId = $user->id;
        $unit = $user->roles; //kabag-keperawatan

        foreach ($unit as $key => $value) {
            $role[] = $value->name;
        }

        $request->validate([
            'file' => ['max:100000','mimes:pdf,docx,doc,xls,xlsx,ppt,pptx,rtf'],
            ]);

        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');     

        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        $path = $uploadedFile->store('public/files/laporan-bulanan/'.$request->unit.'/'.$request->thn.'/'.$request->bln);

        // GET UNIT
        $unit = DB::table('set_role_users')
            ->join('roles', 'set_role_users.id_roles', '=', 'roles.id')
            ->where('set_role_users.id_user', $userId)
            ->select('roles.name')
            ->first();

        $data = new laporan_bulanan;
        $data->judul = $request->judul;
        $data->bln = $request->bln;
        $data->thn = $request->thn;
        $data->id_user = $userId;
        $data->unit = json_encode($role);

            $data->title = $request->title ?? $uploadedFile->getClientOriginalName();
            $data->filename = $path;

        $data->ket = $request->ket;

        $data->save();
        return Redirect::back()->with('message','Tambah Laporan Bulanan Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = laporan_bulanan::find($id);
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
        $data = laporan_bulanan::find($id);
        $data->judul = $request->judul;
        $data->bln = $request->bln;
        $data->thn = $request->thn;
        // $data->unit = $request->unit;
        $data->ket = $request->ket;

        $data->save();
        return Redirect::back()->with('message','Perubahan Laporan Bulanan Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = laporan_bulanan::find($id);
        $file = $data->filename;

        Storage::delete($file);
        $data->delete();

        // redirect
        return Redirect::back()->with('message','Hapus Laporan Bulanan Berhasil');
    }

    // API LIST
    function table()
    {
        $user = Auth::user();
        $id = $user->id;

        $show = laporan_bulanan::where('id_user',$id)->orderBy('updated_at','desc')->get();
        // print_r($show);
        // die();
        
        $tgl = Carbon::now()->isoFormat('YYYY/MM/DD');
        $tglAfter3Day = Carbon::now()->addDays(3)->isoFormat('YYYY/MM/DD');
        $tglAfter2Day = Carbon::now()->addDays(2)->isoFormat('YYYY/MM/DD');
        $tglAfter1Day = Carbon::now()->addDays(1)->isoFormat('YYYY/MM/DD');

        $data = [
            'show' => $show,
            'tgl' => $tgl,
            'tglAfter1Day' => $tglAfter1Day,
            'tglAfter2Day' => $tglAfter2Day,
            'tglAfter3Day' => $tglAfter3Day,
        ];

        return response()->json($data, 200);
    }

    public function tableadmin()
    {
        $user = Auth::user();
        $id = $user->id;

        $show = laporan_bulanan::orderBy('updated_at','desc')->get();
        
        $tgl = Carbon::now()->isoFormat('YYYY/MM/DD');

        $data = [
            'show' => $show,
            'tgl' => $tgl,
        ];

        return response()->json($data, 200);
    }

    public function tableVerifikasi()
    {
        $user = Auth::user();

        // VERIF DIRUT
        $dirut = [
            'spv',
            'mpp',
            'pmkp',
            'pkrs',
            'ppi',
            'spi',
            'asuransi',
            'komite-keperawatan',
            'komite-medik',
            'direktur-keuangan-perencanaan',
            'direktur-umum-kepegawaian',
            'direktur-pelayanan-keperawatan-penunjang',
        ];

        // VERIF DIREKTUR
        $verif_direktur_keuangan_perencanaan = [
            'kabag-perencanaan',
            'kabag-keuangan',
        ];
        $verif_direktur_umum_kepegawaian = [
            'kabag-rumah-tangga',
            'kabag-kepegawaian',
            'kabag-umum',
        ];
        $verif_direktur_pelayanan_keperawatan_penunjang = [
            'kabag-penunjang',
            'kabag-keperawatan',
            'kabag-pelayanan-medik',
        ];

        // VERIF KABAG
        $verif_kabag_perencanaan = [
            'kasubag-perencanaan-it',
            'kasubag-diklat',
            'kasubag-marketing',
        ];
        $verif_kabag_keuangan = [
            'kasubag-perbendaharaan',
            'kasubag-verifikasi-akuntansi-pajak',
        ];
        $verif_kabag_rumah_tangga = [
            'kasubag-aset-gudang',
            'kasubag-ipsrs',
            'kasubag-kesling-k3',
        ];
        $verif_kabag_kepegawaian = [
            'kasubag-kepegawaian',
            'kasubag-aik',
        ];
        $verif_kabag_umum = [
            'kasubag-tata-usaha',
            'kasubag-humas',
            'kasubag-penunjang-operasional',
        ];
        $verif_kabag_penunjang = [
            'kasubag-penunjang-medik',
            'kasubag-penunjang-nonmedik',
        ];
        $verif_kabag_keperawatan = [
            'kasubag-keperawatan-rajal-gadar',
            'kasubag-keperawatan-ranap',
        ];
        $verif_kabag_pelayanan_medik = [
            'kasubag-rajal-gadar',
            'kasubag-ranap',
        ];

        // VERIF KASUBAG
        $verif_kasubag_perencanaan_it = [''];
        $verif_kasubag_diklat = [''];
        $verif_kasubag_marketing = [''];
        $verif_kasubag_perbendaharaan = [''];
        $verif_kasubag_verifikasi_akuntansi_pajak = ['karu-kasir'];
        $verif_kasubag_aset_gudang = [''];
        $verif_kasubag_ipsrs = [''];
        $verif_kasubag_kesling_k3 = [''];
        $verif_kasubag_kepegawaian = [''];
        $verif_kasubag_aik = [''];
        $verif_kasubag_tata_usaha = [''];
        $verif_kasubag_humas = [''];
        $verif_kasubag_penunjang_operasional = ['karu-driver','karu-cs','karu-security'];
        $verif_kasubag_penunjang_medik = ['karu-lab','karu-rm-informasi','karu-radiologi','karu-rehab','karu-farmasi'];
        $verif_kasubag_penunjang_nonmedik = ['karu-gizi','karu-laundry','karu-cssd','karu-binroh'];
        $verif_kasubag_keperawatan_rajal_gadar = ['karu-igd','karu-poli'];
        $verif_kasubag_keperawatan_ranap = ['karu-icu','karu-ibs','karu-bangsal3','karu-bangsal4','karu-kebidanan'];
        $verif_kasubag_rajal_gadar = ['karu-igd','karu-poli'];
        $verif_kasubag_ranap = ['karu-icu','karu-ibs','karu-bangsal3','karu-bangsal4','karu-kebidanan'];

        // ------------------------------------------------------------------------------------------------------------------------
        // Direktur
        if ($user->hasRole('direktur-utama')) { $r = $dirut; }
        elseif ($user->hasRole('direktur-keuangan-perencanaan')) { $r = $verif_direktur_keuangan_perencanaan; }
        elseif ($user->hasRole('direktur-umum-kepegawaian')) { $r = $verif_direktur_umum_kepegawaian; }
        elseif ($user->hasRole('direktur-pelayanan-keperawatan-penunjang')) { $r = $verif_direktur_pelayanan_keperawatan_penunjang; }

        // Kabag
        elseif ($user->hasRole('kabag-perencanaan')) { $r = $verif_kabag_perencanaan; }
        elseif ($user->hasRole('kabag-keuangan')) { $r = $verif_kabag_keuangan; }
        elseif ($user->hasRole('kabag-rumah-tangga')) { $r = $verif_kabag_rumah_tangga; }
        elseif ($user->hasRole('kabag-kepegawaian')) { $r = $verif_kabag_kepegawaian; }
        elseif ($user->hasRole('kabag-umum')) { $r = $verif_kabag_umum; }
        elseif ($user->hasRole('kabag-penunjang')) { $r = $verif_kabag_penunjang; }
        elseif ($user->hasRole('kabag-keperawatan')) { $r = $verif_kabag_keperawatan; }
        elseif ($user->hasRole('kabag-pelayanan-medik')) { $r = $verif_kabag_pelayanan_medik; }

        // Kasubag
        elseif ($user->hasRole('kasubag-perencanaan-it')) { $r = $verif_kasubag_perencanaan_it; }
        elseif ($user->hasRole('kasubag-diklat')) { $r = $verif_kasubag_diklat; }
        elseif ($user->hasRole('kasubag-marketing')) { $r = $verif_kasubag_marketing; }
        elseif ($user->hasRole('kasubag-perbendaharaan')) { $r = $verif_kasubag_perbendaharaan; }
        elseif ($user->hasRole('kasubag-verifikasi-akuntansi-pajak')) { $r = $verif_kasubag_verifikasi_akuntansi_pajak; }
        elseif ($user->hasRole('kasubag-aset-gudang')) { $r = $verif_kasubag_aset_gudang; }
        elseif ($user->hasRole('kasubag-ipsrs')) { $r = $verif_kasubag_ipsrs; }
        elseif ($user->hasRole('kasubag-kesling-k3')) { $r = $verif_kasubag_kesling_k3; }
        elseif ($user->hasRole('kasubag-kepegawaian')) { $r = $verif_kasubag_kepegawaian; }
        elseif ($user->hasRole('kasubag-aik')) { $r = $verif_kasubag_aik; }
        elseif ($user->hasRole('kasubag-tata-usaha')) { $r = $verif_kasubag_tata_usaha; }
        elseif ($user->hasRole('kasubag-humas')) { $r = $verif_kasubag_humas; }
        elseif ($user->hasRole('kasubag-penunjang-operasional')) { $r = $verif_kasubag_penunjang_operasional; }
        elseif ($user->hasRole('kasubag-penunjang-medik')) { $r = $verif_kasubag_penunjang_medik; }
        elseif ($user->hasRole('kasubag-penunjang-nonmedik')) { $r = $verif_kasubag_penunjang_nonmedik; }
        elseif ($user->hasRole('kasubag-keperawatan-rajal-gadar')) { $r = $verif_kasubag_keperawatan_rajal_gadar; }
        elseif ($user->hasRole('kasubag-keperawatan-ranap')) { $r = $verif_kasubag_keperawatan_ranap; }
        elseif ($user->hasRole('kasubag-rajal-gadar')) { $r = $verif_kasubag_rajal_gadar; }
        elseif ($user->hasRole('kasubag-ranap')) { $r = $verif_kasubag_ranap; }

        if ($user->hasRole('pelayanan') || $user->hasRole('perencanaan') || $user->hasRole('direktur-utama')) {
            $show = laporan_bulanan::all();
        } else {
            if (!empty($r)) {
                $show = laporan_bulanan::leftJoin('set_role_users', 'laporan_bulanan.id_user', '=', 'set_role_users.id_user')
                    ->leftJoin('roles', 'set_role_users.id_roles', '=', 'roles.id')
                    ->select('roles.name','laporan_bulanan.*')
                    ->where('laporan_bulanan.deleted_at', null)
                    ->where('laporan_bulanan.tgl_verif', null)
                    ->whereIn('roles.name', $r)
                    ->orderBy('laporan_bulanan.updated_at', 'desc')
                    ->get();
            }
        }
        // print_r($show);
        // die();
        return response()->json($show, 200);
    }

    public function verifikasi(Request $request)
    {
        $user = Auth::user();
        $nama_user = $user->nama;
        $id_user = $user->id;
        $now = Carbon::now();

            $data = laporan_bulanan::find($request->id);
            if ($request->verifikasi == true) {
                $data->tgl_verif = $now;
                $data->id_verif = $id_user;
            }
            $data->save();

        $data = [
            'nama' => $nama_user,
        ];

        return response()->json($data, 200);
    }

    public function verified($id)
    {
        $getData = DB::table('laporan_bulanan')
                ->join('users', 'laporan_bulanan.id_verif', '=', 'users.id')
                ->where('laporan_bulanan.id',$id)
                ->select('laporan_bulanan.tgl_verif','users.nama')
                ->first();

        $tgl_verif = Carbon::parse($getData->tgl_verif)->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = [
            'tgl_verif' => $tgl_verif,
            'nama' => $getData->nama,
        ];

        return response()->json($data, 200);
    }

    public function ket(Request $request)
    {
        $now = Carbon::now();
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

            $data = laporan_bulanan::find($request->id);
            $data->tgl_ket_verif = $now;
            $data->ket_verif = $request->ket;
            $data->save();

        return response()->json($tgl, 200);
    }
    
    public function ketGet($id)
    {
        $data = laporan_bulanan::where('id',$id)->select('ket_verif')->first();

        return response()->json($data, 200);
    }
    
    public function ketHapus($id)
    {
        laporan_bulanan::where('id',$id)->delete();

        $text = 'Silakan mengisi ulang keterangan';
        $icon = 'success';

        $data = [
            'text' => $text,
            'icon' => $icon,
        ];
        return response()->json($data, 200);
    }
}

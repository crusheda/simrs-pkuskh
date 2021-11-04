<?php

namespace App\Http\Controllers\kantor;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\laporan_bulanan;
use App\Models\unit;
use App\Models\setRoleUser;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;
use Response;
use Exception;

class laporanBulananController extends Controller
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
        $id = $user->id;
        $name = $user->name;
        $role = $user->roles->first()->name; //kabag-keperawatan

        $tgl = Carbon::now()->isoFormat('YYYY/MM/DD');
        $tglAfter3Day = Carbon::now()->addDays(3)->isoFormat('YYYY/MM/DD');
        $tglAfter2Day = Carbon::now()->addDays(2)->isoFormat('YYYY/MM/DD');
        $tglAfter1Day = Carbon::now()->addDays(1)->isoFormat('YYYY/MM/DD');
        $thn = Carbon::now()->isoFormat('Y');
        
        $showall = laporan_bulanan::all();
        $users = DB::table('users')
                ->where('users.status',null)
                ->get();

        // TRUE / FALSE Tombol Tambah Laporan
        $getRole = setRoleUser::get();
        $tambah = false;
        foreach ($getRole as $key => $value) {
            if ($value->id_user == $id) {
                $tambah = true;
            }
        }

        // DIREKTUR
        $direktur_keuangan_perencanaan = [
            'kabag-perencanaan',
                // 'kasubag-perencanaan-it',
                // 'kasubag-diklat',
                // 'kasubag-marketing',
            'kabag-keuangan',
                // 'kasubag-perbendaharaan',
                // 'kasubag-verifikasi-akuntansi-pajak',
        ];
        $direktur_umum_kepegawaian = [
            'kabag-rumah-tangga',
                // 'kasubag-aset-gudang',
                // 'kasubag-ipsrs',
                // 'kasubag-kesling-k3',
            'kabag-kepegawaian',
                // 'kasubag-kepegawaian',
                // 'kasubag-aik',
            'kabag-umum',
                // 'kasubag-tata-usaha',
                // 'kasubag-humas',
                // 'kasubag-penunjang-operasional',
        ];
        $direktur_pelayanan_keperawatan_penunjang = [
            'kabag-penunjang',
                // 'kasubag-penunjang-medik',
                // 'kasubag-penunjang-nonmedik',
            'kabag-keperawatan',
                // 'kasubag-keperawatan-rajal-gadar',
                // 'kasubag-keperawatan-ranap',
            'kabag-pelayanan-medik',
                // 'kasubag-rajal-gadar',
                // 'kasubag-ranap',
        ];

        // KABAG
        $kabag_perencanaan = ['kabag-perencanaan',];
        $kabag_keuangan = ['kabag-keuangan',];
        $kabag_rumah_tangga = ['kabag-rumah-tangga',];
        $kabag_kepegawaian = ['kabag-kepegawaian',];
        $kabag_umum = ['kabag-umum',];
        $kabag_penunjang = ['kabag-penunjang',];
        $kabag_keperawatan = ['kabag-keperawatan',];
        $kabag_pelayanan_medik = ['kabag-pelayanan-medik',];

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

        // KASUBAG
        $kasubag_perencanaan_it = ['kasubag-perencanaan-it',''];
        $kasubag_diklat = ['kasubag-diklat'];
        $kasubag_marketing = ['kasubag-marketing'];
        $kasubag_perbendaharaan = ['kasubag-perbendaharaan'];
        $kasubag_verifikasi_akuntansi_pajak = ['kasubag-verifikasi-akuntansi-pajak'];
        $kasubag_aset_gudang = ['kasubag-aset-gudang'];
        $kasubag_ipsrs = ['kasubag-ipsrs'];
        $kasubag_kesling_k3 = ['kasubag-kesling-k3'];
        $kasubag_kepegawaian = ['kasubag-kepegawaian'];
        $kasubag_aik = ['kasubag-aik'];
        $kasubag_tata_usaha = ['kasubag-tata-usaha'];
        $kasubag_humas = ['kasubag-humas'];
        $kasubag_penunjang_operasional = ['kasubag-penunjang-operasional'];
        $kasubag_penunjang_medik = ['kasubag-penunjang-medik'];
        $kasubag_penunjang_nonmedik = ['kasubag-penunjang-nonmedik'];
        $kasubag_keperawatan_rajal_gadar = ['kasubag-keperawatan-rajal-gadar'];
        $kasubag_keperawatan_ranap = ['kasubag-keperawatan-ranap'];
        $kasubag_rajal_gadar = ['kasubag-rajal-gadar'];
        $kasubag_ranap = ['kasubag-ranap'];

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

        // TIM & KOMITE
        $spv = ['spv'];
        $mpp = ['mpp'];
        $pmkp = ['pmkp'];
        $pkrs = ['pkrs'];
        $ppi = ['ppi'];
        $spi = ['spi'];
        $asuransi = ['asuransi'];
        $komite_keperawatan = ['komite-keperawatan'];
        $komite_medik = ['komite-medik'];

        // KARU
        $karu_lab = ['karu-lab'];
        $karu_rm_informasi = ['karu-rm-informasi'];
        $karu_radiologi = ['karu-radiologi'];
        $karu_rehab = ['karu-rehab'];
        $karu_farmasi = ['karu-farmasi'];
        $karu_gizi = ['karu-gizi'];
        $karu_laundry = ['karu-laundry'];
        $karu_cssd = ['karu-cssd'];
        $karu_binroh = ['karu-binroh'];
        $karu_driver = ['karu-driver'];
        $karu_cs = ['karu-cs'];
        $karu_security = ['karu-security'];
        $karu_ibs = ['karu-ibs'];
        $karu_icu = ['karu-icu'];
        $karu_igd = ['karu-igd'];
        $karu_poli = ['karu-poli'];
        $karu_bangsal3 = ['karu-bangsal3'];
        $karu_bangsal4 = ['karu-bangsal4'];
        $karu_kebidanan = ['karu-kebidanan'];
        $karu_kasir = ['karu-kasir'];

        // ------------------------------------------------------------------------------------------------------------------------

        // Direktur
        if ($user->hasRole('direktur-keuangan-perencanaan')) { $r = $direktur_keuangan_perencanaan; }
        elseif ($user->hasRole('direktur-umum-kepegawaian')) { $r = $direktur_umum_kepegawaian; }
        elseif ($user->hasRole('direktur-pelayanan-keperawatan-penunjang')) { $r = $direktur_pelayanan_keperawatan_penunjang; }

        // Kabag
        elseif ($user->hasRole('kabag-perencanaan')) { $e = $kabag_perencanaan; $r = $verif_kabag_perencanaan; }
        elseif ($user->hasRole('kabag-keuangan')) { $e = $kabag_keuangan; $r = $verif_kabag_keuangan; }
        elseif ($user->hasRole('kabag-rumah-tangga')) { $e = $kabag_rumah_tangga; $r = $verif_kabag_rumah_tangga; }
        elseif ($user->hasRole('kabag-kepegawaian')) { $e = $kabag_kepegawaian; $r = $verif_kabag_kepegawaian; }
        elseif ($user->hasRole('kabag-umum')) { $e = $kabag_umum; $r = $verif_kabag_umum; }
        elseif ($user->hasRole('kabag-penunjang')) { $e = $kabag_penunjang; $r = $verif_kabag_penunjang; }
        elseif ($user->hasRole('kabag-keperawatan')) { $e = $kabag_keperawatan; $r = $verif_kabag_keperawatan; }
        elseif ($user->hasRole('kabag-pelayanan-medik')) { $e = $kabag_pelayanan_medik; $r = $verif_kabag_pelayanan_medik; }

        // Kasubag
        elseif ($user->hasRole('kasubag-perencanaan-it')) { $e = $kasubag_perencanaan_it; $r = $verif_kasubag_perencanaan_it; }
        elseif ($user->hasRole('kasubag-diklat')) { $e = $kasubag_diklat; $r = $verif_kasubag_diklat; }
        elseif ($user->hasRole('kasubag-marketing')) { $e = $kasubag_marketing; $r = $verif_kasubag_marketing; }
        elseif ($user->hasRole('kasubag-perbendaharaan')) { $e = $kasubag_perbendaharaan; $r = $verif_kasubag_perbendaharaan; }
        elseif ($user->hasRole('kasubag-verifikasi-akuntansi-pajak')) { $e = $kasubag_verifikasi_akuntansi_pajak; $r = $verif_kasubag_verifikasi_akuntansi_pajak; }
        elseif ($user->hasRole('kasubag-aset-gudang')) { $e = $kasubag_aset_gudang; $r = $verif_kasubag_aset_gudang; }
        elseif ($user->hasRole('kasubag-ipsrs')) { $e = $kasubag_ipsrs; $r = $verif_kasubag_ipsrs; }
        elseif ($user->hasRole('kasubag-kesling-k3')) { $e = $kasubag_kesling_k3; $r = $verif_kasubag_kesling_k3; }
        elseif ($user->hasRole('kasubag-kepegawaian')) { $e = $kasubag_kepegawaian; $r = $verif_kasubag_kepegawaian; }
        elseif ($user->hasRole('kasubag-aik')) { $e = $kasubag_aik; $r = $verif_kasubag_aik; }
        elseif ($user->hasRole('kasubag-tata-usaha')) { $e = $kasubag_tata_usaha; $r = $verif_kasubag_tata_usaha; }
        elseif ($user->hasRole('kasubag-humas')) { $e = $kasubag_humas; $r = $verif_kasubag_humas; }
        elseif ($user->hasRole('kasubag-penunjang-operasional')) { $e = $kasubag_penunjang_operasional; $r = $verif_kasubag_penunjang_operasional; }
        elseif ($user->hasRole('kasubag-penunjang-medik')) { $e = $kasubag_penunjang_medik; $r = $verif_kasubag_penunjang_medik; }
        elseif ($user->hasRole('kasubag-penunjang-nonmedik')) { $e = $kasubag_penunjang_nonmedik; $r = $verif_kasubag_penunjang_nonmedik; }
        elseif ($user->hasRole('kasubag-keperawatan-rajal-gadar')) { $e = $kasubag_keperawatan_rajal_gadar; $r = $verif_kasubag_keperawatan_rajal_gadar; }
        elseif ($user->hasRole('kasubag-keperawatan-ranap')) { $e = $kasubag_keperawatan_ranap; $r = $verif_kasubag_keperawatan_ranap; }
        elseif ($user->hasRole('kasubag-rajal-gadar')) { $e = $kasubag_rajal_gadar; $r = $verif_kasubag_rajal_gadar; }
        elseif ($user->hasRole('kasubag-ranap')) { $e = $kasubag_ranap; $r = $verif_kasubag_ranap; }

        // TIM & KOMITE
        elseif ($user->hasRole('spv')) { $e = $spv; }
        elseif ($user->hasRole('mpp')) { $e = $mpp; }
        elseif ($user->hasRole('pmkp')) { $e = $pmkp; }
        elseif ($user->hasRole('pkrs')) { $e = $pkrs; }
        elseif ($user->hasRole('ppi')) { $e = $ppi; }
        elseif ($user->hasRole('spi')) { $e = $spi; }
        elseif ($user->hasRole('asuransi')) { $e = $asuransi; }
        elseif ($user->hasRole('komite-keperawatan')) { $e = $komite_keperawatan; }
        elseif ($user->hasRole('komite-medik')) { $e = $komite_medik; }

        // KARU
        elseif ($user->hasRole('karu-lab')) { $e = $karu_lab; }
        elseif ($user->hasRole('karu-rm-informasi')) { $e = $karu_rm_informasi; }
        elseif ($user->hasRole('karu-radiologi')) { $e = $karu_radiologi; }
        elseif ($user->hasRole('karu-rehab')) { $e = $karu_rehab; }
        elseif ($user->hasRole('karu-farmasi')) { $e = $karu_farmasi; }
        elseif ($user->hasRole('karu-gizi')) { $e = $karu_gizi; }
        elseif ($user->hasRole('karu-laundry')) { $e = $karu_laundry; }
        elseif ($user->hasRole('karu-cssd')) { $e = $karu_cssd; }
        elseif ($user->hasRole('karu-binroh')) { $e = $karu_binroh; }
        elseif ($user->hasRole('karu-driver')) { $e = $karu_driver; }
        elseif ($user->hasRole('karu-cs')) { $e = $karu_cs; }
        elseif ($user->hasRole('karu-security')) { $e = $karu_security; }
        elseif ($user->hasRole('karu-ibs')) { $e = $karu_ibs; }
        elseif ($user->hasRole('karu-icu')) { $e = $karu_icu; }
        elseif ($user->hasRole('karu-igd')) { $e = $karu_igd; }
        elseif ($user->hasRole('karu-poli')) { $e = $karu_poli; }
        elseif ($user->hasRole('karu-bangsal3')) { $e = $karu_bangsal3; }
        elseif ($user->hasRole('karu-bangsal4')) { $e = $karu_bangsal4; }
        elseif ($user->hasRole('karu-kebidanan')) { $e = $karu_kebidanan; }
        elseif ($user->hasRole('karu-kasir')) { $e = $karu_kasir; }

        // Push $show & $push
        $show = [];
        $push = [];
        if ($user->hasRole('pelayanan') || $user->hasRole('perencanaan') || $user->hasRole('direktur-utama')) {
            $show = laporan_bulanan::all();
        } else {
            if (!empty($r)) {
                array_push($show, DB::table('laporan_bulanan')
                        ->join('set_role_users', 'laporan_bulanan.id_user', '=', 'set_role_users.id_user')
                        ->join('roles', 'set_role_users.id_roles', '=', 'roles.id')
                        ->select('roles.name','laporan_bulanan.*')
                        ->where('laporan_bulanan.deleted_at', null)
                        ->whereIn('roles.name', $r)
                        ->get()
                    );
            }
            if (!empty($e)) {
                array_push($push, DB::table('laporan_bulanan')
                        ->join('set_role_users', 'laporan_bulanan.id_user', '=', 'set_role_users.id_user')
                        ->join('roles', 'set_role_users.id_roles', '=', 'roles.id')
                        ->select('roles.name','laporan_bulanan.*')
                        ->where('laporan_bulanan.deleted_at', null)
                        ->whereIn('roles.name', $e)
                        ->get()
                    );
            }
        } 
        // print_r($show);
        // die();

        $data = [
            'show' => $show,
            'push' => $push,
            'showall' => $showall,
            'user' => $users,
            'tambah' => $tambah,
            'tgl'  => $tgl,
            'tglAfter3Day'  => $tglAfter3Day,
            'tglAfter2Day'  => $tglAfter2Day,
            'tglAfter1Day'  => $tglAfter1Day,
            'thn'  => $thn,
            'unit' => $unit,
            'role' => $role
        ];
        
        return view('pages.kantor.laporan.bulanan')->with('list', $data);
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
        // return Storage::url($data->filename, $data->title);
        // return response()->download(storage_path("app/".$data->filename));
        // return response()->file(storage_path("app/".$data->filename));
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

    public function filter(Request $request)
    {
        $getthn = substr(Carbon::now(),0,4);
        $thnsend = Carbon::now()->isoFormat('Y');
        
        if ($request->query('bulan') == 'Bulan') {
            $thn = $request->query('tahun');
            $bln = null;
        } elseif ($request->query('tahun') == 'Tahun') {
            $bln = $request->query('bulan');
            $thn = null;
        } else {
            $bln = $request->query('bulan');
            $thn = $request->query('tahun');
        }
        
        $time= 'Bulan : '.$bln.' Tahun : '.$thn;
        
        if($bln && $thn){
            $show = laporan_bulanan::where('bln', $bln)->where('thn',$thn)->get();
        }
        elseif($bln && $thn == null){
            $show = laporan_bulanan::where('bln', $bln)->get();
        }
        elseif($thn && $bln == null){
            $show = laporan_bulanan::where('thn',$thn)->get();
        }        

        // print_r($show);
        // die();

        $data = [
            'getthn' => $getthn,
            'show' => $show,
            'thn'  => $thnsend,
            'time' => $time
        ];

        return view('pages.kantor.laporan.filter-bulanan')->with('list', $data);
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
        // $data = ibs_supervisi::where('id_tim',$id);
        // $data->tgl_selesai = $now;
        // $data->save();
        $tgl_verif = Carbon::parse($getData->tgl_verif)->isoFormat('dddd, D MMMM Y, HH:mm a');
        $data = [
            'tgl_verif' => $tgl_verif,
            'nama' => $getData->nama,
        ];

        return response()->json($data, 200);
    }

    public function old()
    {
        $unit = unit::pluck('id','name','nama');
        $user = Auth::user();
        $role = $user->roles->first()->name; //kabag-keperawatan

        if ($user->hasRole('pelayanan') || $user->hasRole('perencanaan') || $user->hasRole('direktur-utama')) {
            $show = laporan_bulanan::all();
        } else {
            $show = laporan_bulanan::where('unit',$role)->get();
        }

        $data = [
            'show' => $show,
        ];

        return view('pages.kantor.laporan.old-bulanan')->with('list', $data);
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
}

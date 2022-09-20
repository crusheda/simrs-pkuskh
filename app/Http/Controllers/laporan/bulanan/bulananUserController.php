<?php

namespace App\Http\Controllers\laporan\bulanan;

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

class bulananUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thn = Carbon::now()->isoFormat('Y');

        // COUNT ALL LAPORAN
        $bulan = Carbon::now()->subMonth()->isoFormat('MM');
        $tahun = Carbon::now()->isoFormat('YYYY');
        $count = laporan_bulanan::where('bln',$bulan)->where('thn',$tahun)->count();

        $data = [
            'count' => $count,
            'thn'  => $thn,
        ];
        
        return view('pages.administrasi.laporan.bulanan.userIndex')->with('list', $data);
    }

    public function showVerif()
    {
        $jabatan = $this->cariJabatan();

        if ($jabatan != null) {    
            return view('pages.administrasi.laporan.bulanan.verif');
        } else {
            return redirect()->back()->withErrors("Maaf anda tidak mempunyai HAK untuk verifikasi Dokumen Bawahan");
        }
    }

    public function formUpload()
    {
        $jabatan = $this->cariJabatan();

        if ($jabatan != null) {
            $res = true;
            return response()->json($res, 200);
        } else {
            $res = false;
            return response()->json($res, 200);
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
        $user = Auth::user();
        $userId = $user->id;
        $unit = $user->roles; //kabag-keperawatan

        foreach ($unit as $key => $value) {
            $role[] = $value->name;
        }

        $request->validate([
            'file' => ['max:20000','mimes:pdf'],
            ]);

        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');     

        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        $path = $uploadedFile->store('public/files/laporan-bulanan/'.$request->thn.'/'.$request->bln);

        $find = laporan_bulanan::where('id_user',$userId)->get();

        foreach ($find as $key => $value) {
            if ($value->title == $uploadedFile->getClientOriginalName()) {
                return redirect()->back()->withErrors('File sudah pernah diupload. Ganti Nama File yang berbeda dari yang sebelumnya.');
            }
        }

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
        $headers = [
            'Content-Description' => 'Laporan Bulanan',
            'Content-Type' => 'application/pdf',
        ];

        $data = laporan_bulanan::find($id);
        $path1 = 'storage/'.substr($data->filename,7,10000);
        // $path2 = 'storage/'.$data->filename;
        // print_r($path1.'    '.$path2);
        // die();
        // ('storage/'.substr($list['foto']->filename,7,1000))
        return response()->file($path1, $headers);
        // return Storage::download($data->filename, $data->title);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function table()
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

    public function tableVerif()
    {
        $jabatan = $this->cariJabatan();

        if (Auth::user()->hasRole('kasubag-perencanaan-it')) {
            $show = laporan_bulanan::Join('set_role_users', 'laporan_bulanan.id_user', '=', 'set_role_users.id_user')
                ->Join('roles', 'set_role_users.id_roles', '=', 'roles.id')
                ->Join('users', 'laporan_bulanan.id_user', '=', 'users.id')
                ->select('roles.name','users.nama','laporan_bulanan.*')
                ->orderBy('laporan_bulanan.updated_at', 'desc')
                ->get();
        } else {
            $show = laporan_bulanan::Join('set_role_users', 'laporan_bulanan.id_user', '=', 'set_role_users.id_user')
                ->Join('roles', 'set_role_users.id_roles', '=', 'roles.id')
                ->Join('users', 'laporan_bulanan.id_user', '=', 'users.id')
                ->select('roles.name','users.nama','laporan_bulanan.*')
                ->whereIn('roles.name', $jabatan)
                ->orderBy('laporan_bulanan.updated_at', 'desc')
                ->get();
        }

        return response()->json($show, 200);
    }
    
    public function getubah($id)
    {
        $show = laporan_bulanan::where('id',$id)->first();
        $tgl = Carbon::parse($show->created_at)->diffForHumans();
        $bulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        $jml_bulan=count($bulan);
        $tahun = Carbon::now()->isoFormat('Y');
        
        $sizeFile = number_format(Storage::size($show->filename) / 1048576,2);

        $data = [
            'id' => $id,
            'tgl' => $tgl,
            'show' => $show,
            'bulan' => $bulan,
            'jml_bulan' => $jml_bulan,
            'tahun' => $tahun,
            'sizeFile' => $sizeFile,
        ];

        return response()->json($data, 200);
    }
    
    public function ubah(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = laporan_bulanan::find($request->id);
        $data->judul = $request->judul;
        $data->bln = $request->bln;
        $data->thn = $request->thn;
        $data->ket = $request->ket;
        $data->save();
        
        return response()->json($tgl, 200);
    }

    public function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = laporan_bulanan::find($id);
        $file = $data->filename;

        Storage::delete($file);
        $data->delete();
        
        return response()->json($tgl, 200);
    }
    
    public function cariJabatan()
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
            'kabag-perencanaan',
            'kabag-keuangan',
            'kasubag-perencanaan-it',
            'kasubag-diklat',
            'kasubag-marketing',
            'staf-marketing',
            'karu-it',
            'kasubag-perbendaharaan',
            'kasubag-verifikasi-akuntansi-pajak',
            'karu-kasir',
            'kabag-rumah-tangga',
            'kabag-kepegawaian',
            'kabag-umum',
            'kasubag-tata-usaha',
            'kasubag-humas',
            'kasubag-penunjang-operasional',
            'karu-driver',
            'karu-cs',
            'karu-security',
            'kasubag-kepegawaian',
            'kasubag-aik',
            'kasubag-aset-gudang',
            'kasubag-ipsrs',
            'kasubag-kesling-k3',
            'kabag-penunjang',
            'kabag-keperawatan',
            'kabag-pelayanan-medik',
            'kasubag-keperawatan-rajal-gadar',
            'kasubag-keperawatan-ranap',
            'kasubag-rajal-gadar',
            'kasubag-ranap',
            'karu-igd',
            'karu-poli',
            'karu-icu',
            'karu-ibs',
            'karu-bangsal3',
            'karu-bangsal4',
            'karu-kebidanan',
            'karu-lab',
            'karu-rm-informasi',
            'karu-radiologi',
            'karu-rehab',
            'karu-farmasi',
            'karu-gizi',
            'karu-laundry',
            'karu-cssd',
            'karu-binroh',
        ];

        // VERIF DIREKTUR
        $verif_direktur_keuangan_perencanaan = [
            'kabag-perencanaan',
            'kabag-keuangan',
            'kasubag-perencanaan-it',
            'kasubag-diklat',
            'kasubag-marketing',
            'staf-marketing',
            'karu-it',
            'kasubag-perbendaharaan',
            'kasubag-verifikasi-akuntansi-pajak',
            'karu-kasir',
        ];
        $verif_direktur_umum_kepegawaian = [
            'kabag-rumah-tangga',
            'kabag-kepegawaian',
            'kabag-umum',
            'kasubag-tata-usaha',
            'kasubag-humas',
            'kasubag-penunjang-operasional',
            'karu-driver',
            'karu-cs',
            'karu-security',
            'kasubag-kepegawaian',
            'kasubag-aik',
            'kasubag-aset-gudang',
            'kasubag-ipsrs',
            'kasubag-kesling-k3',
        ];
        $verif_direktur_pelayanan_keperawatan_penunjang = [
            'kabag-penunjang',
            'kabag-keperawatan',
            'kabag-pelayanan-medik',
            'kasubag-keperawatan-rajal-gadar',
            'kasubag-keperawatan-ranap',
            'kasubag-rajal-gadar',
            'kasubag-ranap',
            'karu-igd',
            'karu-poli',
            'karu-icu',
            'karu-ibs',
            'karu-bangsal3',
            'karu-bangsal4',
            'karu-kebidanan',
            'karu-lab',
            'karu-rm-informasi',
            'karu-radiologi',
            'karu-rehab',
            'karu-farmasi',
            'karu-gizi',
            'karu-laundry',
            'karu-cssd',
            'karu-binroh',
        ];

        // VERIF KABAG
        $verif_kabag_perencanaan = [
            'kasubag-perencanaan-it',
            'kasubag-diklat',
            'kasubag-marketing',
            'staf-marketing',
            'karu-it',
        ];
        $verif_kabag_keuangan = [
            'kasubag-perbendaharaan',
            'kasubag-verifikasi-akuntansi-pajak',
            'karu-kasir',
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
            'karu-driver',
            'karu-cs',
            'karu-security',
        ];
        $verif_kabag_penunjang = [
            'kasubag-penunjang-medik',
            'kasubag-penunjang-nonmedik',
            'karu-lab',
            'karu-rm-informasi',
            'karu-radiologi',
            'karu-rehab',
            'karu-farmasi',
            'karu-gizi',
            'karu-laundry',
            'karu-cssd',
            'karu-binroh',
        ];
        $verif_kabag_keperawatan = [
            'kasubag-keperawatan-rajal-gadar',
            'kasubag-keperawatan-ranap',
            'karu-igd',
            'karu-poli',
            'karu-icu',
            'karu-ibs',
            'karu-bangsal3',
            'karu-bangsal4',
            'karu-kebidanan',
        ];
        $verif_kabag_pelayanan_medik = [
            'kasubag-rajal-gadar',
            'kasubag-ranap',
            'karu-igd',
            'karu-poli',
            'karu-icu',
            'karu-ibs',
            'karu-bangsal3',
            'karu-bangsal4',
            'karu-kebidanan',
        ];

        // VERIF KASUBAG
        $verif_kasubag_perencanaan_it = ['karu-it'];
        $verif_kasubag_diklat = [''];
        $verif_kasubag_marketing = ['staf-marketing'];
        $verif_kasubag_perbendaharaan = [''];
        $verif_kasubag_verifikasi_akuntansi_pajak = ['karu-kasir'];
        $verif_kasubag_aset_gudang = [''];
        $verif_kasubag_ipsrs = [''];
        $verif_kasubag_kesling_k3 = [''];
        $verif_kasubag_kepegawaian = [''];
        $verif_kasubag_aik = [''];
        $verif_kasubag_tata_usaha = [''];
        $verif_kasubag_humas = [''];
        $verif_kasubag_penunjang_operasional = [
            'karu-driver',
            'karu-cs',
            'karu-security',
        ];
        $verif_kasubag_penunjang_medik = [
            'karu-lab',
            'karu-rm-informasi',
            'karu-radiologi',
            'karu-rehab',
            'karu-farmasi',
        ];
        $verif_kasubag_penunjang_nonmedik = [
            'karu-gizi',
            'karu-laundry',
            'karu-cssd',
            'karu-binroh',
        ];
        $verif_kasubag_keperawatan_rajal_gadar = [
            'karu-igd',
            'karu-poli',
        ];
        $verif_kasubag_keperawatan_ranap = [
            'karu-icu',
            'karu-ibs',
            'karu-bangsal3',
            'karu-bangsal4',
            'karu-kebidanan',
            'perinatologi',
        ];
        $verif_kasubag_rajal_gadar = [
            'karu-igd',
            'karu-poli',
        ];
        $verif_kasubag_ranap = [
            'karu-icu',
            'karu-ibs',
            'karu-bangsal3',
            'karu-bangsal4',
            'karu-kebidanan',
            'perinatologi',
        ];

        // ------------------------------------------------------------------------------------------------------------------------
        $r = null;
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

        return $r;
        
    }
}

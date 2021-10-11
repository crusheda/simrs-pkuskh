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
        // print_r($tambah);
        // die();

        // GET ALL NAME ROLE OF AUTH
        // $rl = [];
        // foreach ($user->roles as $key => $value) {
        //     array_push($rl,
        //         ['name' => $value->name]
        //     );
        // }

        // $getIdUser = laporan_bulanan::select('id_user')->where('id_user','!=',null)->get();
        // print_r($getIdUser[0]->id_user);
        // die();

        // DIREKTUR
        $direktur_keuangan_perencanaan = [
            'kabag-perencanaan',
                'kasubag-perencanaan-it',
                'kasubag-diklat',
                'kasubag-marketing',
            'kabag-keuangan',
                'kasubag-perbendaharaan',
                'kasubag-verifikasi-akuntansi-pajak',
        ];
        $direktur_umum_kepegawaian = [
            'kabag-rumah-tangga',
                'kasubag-aset-gudang',
                'kasubag-ipsrs',
                'kasubag-kesling-k3',
            'kabag-kepegawaian',
                'kasubag-kepegawaian',
                'kasubag-aik',
            'kabag-umum',
                'kasubag-tata-usaha',
                'kasubag-humas',
                'kasubag-penunjang-operasional',
        ];
        $direktur_pelayanan_keperawatan_penunjang = [
            'kabag-penunjang',
                'kasubag-penunjang-medik',
                'kasubag-penunjang-nonmedik',
            'kabag-keperawatan',
                'kasubag-keperawatan-rajal-gadar',
                'kasubag-keperawatan-ranap',
            'kabag-pelayanan-medik',
                'kasubag-rajal-gadar',
                'kasubag-ranap',
        ];

        // KABAG
        $kabag_perencanaan = [
            'kasubag-perencanaan-it',
            'kasubag-diklat',
            'kasubag-marketing',
        ];
        $kabag_keuangan = [
            'kasubag-perbendaharaan',
            'kasubag-verifikasi-akuntansi-pajak',
        ];
        $kabag_rumah_tangga = [
            'kasubag-aset-gudang',
            'kasubag-ipsrs',
            'kasubag-kesling-k3',
        ];
        $kabag_kepegawaian = [
            'kasubag-kepegawaian',
            'kasubag-aik',
        ];
        $kabag_umum = [
            'kasubag-tata-usaha',
            'kasubag-humas',
            'kasubag-penunjang-operasional',
        ];
        $kabag_penunjang = [
            'kasubag-penunjang-medik',
            'kasubag-penunjang-nonmedik',
        ];
        $kabag_keperawatan = [
            'kasubag-keperawatan-rajal-gadar',
            'kasubag-keperawatan-ranap',
        ];
        $kabag_pelayanan_medik = [
            'kasubag-rajal-gadar',
            'kasubag-ranap',
        ];

        // KASUBAG
        $kasubag_perencanaan_it = ['kasubag-perencanaan-it'];
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

        // Define Role WhereIn Query
        // $r = $role_+str_replace('-','_',$role);
        // print_r($r);
        // die();

        // Direktur
        if ($user->hasRole('direktur-keuangan-perencanaan')) { $r = $direktur_keuangan_perencanaan; }
        elseif ($user->hasRole('direktur-umum-kepegawaian')) { $r = $direktur_umum_kepegawaian; }
        elseif ($user->hasRole('direktur-pelayanan-keperawatan-penunjang')) { $r = $direktur_pelayanan_keperawatan_penunjang; }

        // Kabag
        elseif ($user->hasRole('kabag-perencanaan')) { $r = $kabag_perencanaan; }
        elseif ($user->hasRole('kabag-keuangan')) { $r = $kabag_keuangan; }
        elseif ($user->hasRole('kabag-rumah-tangga')) { $r = $kabag_rumah_tangga; }
        elseif ($user->hasRole('kabag-kepegawaian')) { $r = $kabag_kepegawaian; }
        elseif ($user->hasRole('kabag-umum')) { $r = $kabag_umum; }
        elseif ($user->hasRole('kabag-penunjang')) { $r = $kabag_penunjang; }
        elseif ($user->hasRole('kabag-keperawatan')) { $r = $kabag_keperawatan; }
        elseif ($user->hasRole('kabag-pelayanan-medik')) { $r = $kabag_pelayanan_medik; }

        // Kasubag
        elseif ($user->hasRole('kasubag-perencanaan-it')) { $r = $kasubag_perencanaan_it; }
        elseif ($user->hasRole('kasubag-diklat')) { $r = $kasubag_diklat; }
        elseif ($user->hasRole('kasubag-marketing')) { $r = $kasubag_marketing; }
        elseif ($user->hasRole('kasubag-perbendaharaan')) { $r = $kasubag_perbendaharaan; }
        elseif ($user->hasRole('kasubag-verifikasi-akuntansi-pajak')) { $r = $kasubag_verifikasi_akuntansi_pajak; }
        elseif ($user->hasRole('kasubag-aset-gudang')) { $r = $kasubag_aset_gudang; }
        elseif ($user->hasRole('kasubag-ipsrs')) { $r = $kasubag_ipsrs; }
        elseif ($user->hasRole('kasubag-kesling-k3')) { $r = $kasubag_kesling_k3; }
        elseif ($user->hasRole('kasubag-kepegawaian')) { $r = $kasubag_kepegawaian; }
        elseif ($user->hasRole('kasubag-aik')) { $r = $kasubag_aik; }
        elseif ($user->hasRole('kasubag-tata-usaha')) { $r = $kasubag_tata_usaha; }
        elseif ($user->hasRole('kasubag-humas')) { $r = $kasubag_humas; }
        elseif ($user->hasRole('kasubag-penunjang-operasional')) { $r = $kasubag_penunjang_operasional; }
        elseif ($user->hasRole('kasubag-penunjang-medik')) { $r = $kasubag_penunjang_medik; }
        elseif ($user->hasRole('kasubag-penunjang-nonmedik')) { $r = $kasubag_penunjang_nonmedik; }
        elseif ($user->hasRole('kasubag-keperawatan-rajal-gadar')) { $r = $kasubag_keperawatan_rajal_gadar; }
        elseif ($user->hasRole('kasubag-keperawatan-ranap')) { $r = $kasubag_keperawatan_ranap; }
        elseif ($user->hasRole('kasubag-rajal-gadar')) { $r = $kasubag_rajal_gadar; }
        elseif ($user->hasRole('kasubag-ranap')) { $r = $kasubag_ranap; }

        // TIM & KOMITE
        elseif ($user->hasRole('spv')) { $r = $spv; }
        elseif ($user->hasRole('mpp')) { $r = $mpp; }
        elseif ($user->hasRole('pmkp')) { $r = $pmkp; }
        elseif ($user->hasRole('pkrs')) { $r = $pkrs; }
        elseif ($user->hasRole('ppi')) { $r = $ppi; }
        elseif ($user->hasRole('spi')) { $r = $spi; }
        elseif ($user->hasRole('asuransi')) { $r = $asuransi; }
        elseif ($user->hasRole('komite-keperawatan')) { $r = $komite_keperawatan; }
        elseif ($user->hasRole('komite-medik')) { $r = $komite_medik; }

        // Push $show
        $show = [];
        if ($user->hasRole('pelayanan') || $user->hasRole('direktur-utama')) {
            $show = laporan_bulanan::all();
        } else {
            array_push($show, DB::table('laporan_bulanan')
                    ->join('set_role_users', 'laporan_bulanan.id_user', '=', 'set_role_users.id_user')
                    ->join('roles', 'set_role_users.id_roles', '=', 'roles.id')
                    ->select('roles.name','laporan_bulanan.*')
                    ->where('laporan_bulanan.deleted_at', null)
                    ->whereIn('roles.name', $r)
                    ->get()
                );
        } 
        
        //     foreach ($rl as $keys => $values) {
        //         array_push($show,laporan_bulanan::where('unit', $values['name'])->get());
        //     }
        //     // print_r($show[0][0]->ket);
        //     // die();
        //                         CONTOH ----->        $values['name'] == ''

        // $e = [];
        // // Admin SIMRSKU.COM
        // if (Auth::user()->hasRole('it')) {
        // }

        $data = [
            'show' => $show,
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

        $request->validate([
            'file' => ['max:100000','mimes:pdf,docx,doc,xls,xlsx,ppt,pptx,rtf'],
            ]);

        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');     

        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        $path = $uploadedFile->store('public/files/laporan-bulanan/'.$request->unit.'/'.$request->thn.'/'.$request->bln);

        $data = new laporan_bulanan;
        $data->judul = $request->judul;
        $data->bln = $request->bln;
        $data->thn = $request->thn;
        $data->id_user = $userId;
        $data->unit = $request->unit;

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
}

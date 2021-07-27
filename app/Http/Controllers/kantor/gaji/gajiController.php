<?php

namespace App\Http\Controllers\kantor\gaji;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\gaji\gaji;
use App\Models\gaji\fungsional;
use App\Models\gaji\struktural;
use App\Models\gaji\fungsional_has_user;
use App\Models\gaji\struktural_has_user;
use App\Models\gaji\potong_has_user;
use App\Models\gaji\terima;
use App\Models\gaji\ref_potong;
use App\Models\user;
use Carbon\Carbon;
use Exception;
use Redirect;
use Auth;

class gajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastGaji = gaji::where('status',false)->orderBy('id','desc')->first();
        if (!empty($lastGaji)) {
            $carbonTglGaji = Carbon::parse($lastGaji->tgl)->isoFormat('YYYY-MM');
            $carbonTglNow = Carbon::now()->isoFormat('YYYY-MM');
            if ($carbonTglGaji != $carbonTglNow) {
                $status = 0;
            } else {
                $status = 1;
            }
        } else {
            $status = 2;
        }

        $user = DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('roles.name as nama_role','users.*')
                ->where('users.status',null)
                ->get();
        
        $show = DB::table('gaji_terima')
                ->join('users', 'users.id', '=', 'gaji_terima.id_user')
                // ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                // ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->join('gaji_golongan', 'gaji_golongan.id', '=', 'users.id_gol')
                ->where('gaji_terima.deleted_at',null)
                // ->where('users.status',null)
                ->select('users.nama','users.name','users.nip','gaji_golongan.id as id_golongan','gaji_golongan.nama as nama_golongan','gaji_terima.*')
                ->get();

        $gaji = DB::table('gaji')
                ->join('gaji_terima', 'gaji_terima.id', '=', 'gaji.id_terima')
                ->join('users', 'users.id', '=', 'gaji.id_user')
                // ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                // ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->join('gaji_golongan', 'gaji_golongan.id', '=', 'users.id_gol')
                ->where('gaji.status',false)
                ->where('gaji.deleted_at',null)
                // ->where('users.status',null)
                ->select('users.nama as nama_user','users.name as akun_user','users.nip as nip_user','gaji_golongan.id as id_golongan','gaji_golongan.nama as nama_golongan','gaji_terima.struktural','gaji_terima.fungsional','gaji_terima.gapok','gaji_terima.insentif','gaji_terima.potong','gaji_terima.infaq','gaji.*')
                ->get();

        $recent = gaji::select('tgl')->where('status', true)->groupBy('tgl')->orderBy('tgl','DESC')->limit('12')->get();
        // $detailRecent = DB::table('gaji')
        //         ->join('gaji_terima', 'gaji_terima.id', '=', 'gaji.id_terima')
        //         ->join('users', 'users.id', '=', 'gaji.id_user')
        //         // ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        //         // ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        //         ->join('gaji_golongan', 'gaji_golongan.id', '=', 'users.id_gol')
        //         ->where('gaji.status',true)
        //         ->select('users.nama as nama_user','users.name as akun_user','users.nip as nip_user','gaji_golongan.id as id_golongan','gaji_golongan.nama as nama_golongan','gaji_terima.struktural','gaji_terima.fungsional','gaji_terima.gapok','gaji_terima.insentif','gaji_terima.potong','gaji_terima.infaq','gaji.*')
        //         ->get();

        $bln = Carbon::now()->isoFormat('MMMM');
        $thn = Carbon::now()->isoFormat('YYYY');

        // print_r($detailRecent);
        // die();

        $data = [
            'lastGaji' => $lastGaji,
            'user' => $user,
            'status' => $status,
            'bln' => $bln,
            'thn' => $thn,
            'gaji' => $gaji,
            'recent' => $recent,
            // 'detailRecent' => $detailRecent,
            'show' => $show
        ];

        // print_r($data['status']);
        // die();
        return view('pages.kantor.kepegawaian.gaji.final')->with('list', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $getGaji = gaji::where('status',false)->orderBy('id','desc')->get();
        $tglGaji = gaji::where('status',false)->orderBy('id','desc')->first();
        $carbonTglGaji = Carbon::parse($tglGaji->tgl)->isoFormat('MMMM Y');
        for($count = 0; $count < count($getGaji); $count++)
        {
            $ins = array(
                'status' => true
            );
            // $pushNominal[] = $nominal[$count];
            $dataArray[] = $ins; 
        }
        gaji::update($dataArray);

        return redirect::back()->with('message','Hapus Data Gaji Berhasil dilakukan untuk Bulan : '.$carbonTglGaji);
    }

    public function validasi()
    {
        $getUser = Auth::user();
        $now = Carbon::now()->isoFormat('DD/MM/YYYY');
        $tgl = Carbon::now()->isoFormat('YYYY-MM-DD');
        $bln = Carbon::now()->isoFormat('MM');
        $thn = Carbon::now()->isoFormat('YYYY');
        
        $show = DB::table('gaji_terima')
                ->join('users', 'users.id', '=', 'gaji_terima.id_user')
                // ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                // ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->where('gaji_terima.deleted_at',null)
                ->where('gaji_terima.delete',null)
                ->where('users.status',null)
                ->select('users.id as id_users','users.nama','users.name','users.nip','gaji_terima.*')
                ->get();
        
        $tglGaji = gaji::where('status',false)->orderBy('id','desc')->first();
        $getGaji = gaji::where('status',false)->orderBy('id','desc')->get();

        // Karyawan Baru vs Lama
        // $getKoperasi = $show;

        if (empty($tglGaji)) {
            for($count = 0; $count < count($show); $count++)
            {
                $ins = array(
                    'id_user'  => $show[$count]->id_users,
                    'id_terima'  => $show[$count]->id,
                    'total_terima' => $show[$count]->gapok + $show[$count]->struktural + $show[$count]->fungsional + $show[$count]->insentif,
                    'total_potong' => $show[$count]->potong,
                    'total_kotor' => $show[$count]->gapok + $show[$count]->struktural + $show[$count]->fungsional + $show[$count]->insentif,
                    'total_bersih' => ($show[$count]->gapok + $show[$count]->struktural + $show[$count]->fungsional + $show[$count]->insentif) - $show[$count]->potong,
                    'status' => false,
                    'tgl' => $tgl
                );
                $dataArray[] = $ins; 
            }
            gaji::insert($dataArray);
        } else {
            $carbonTglGaji = Carbon::parse($tglGaji->tgl)->isoFormat('YYYY-MM');
            $carbonTglNow = Carbon::now()->isoFormat('YYYY-MM');
            if ($carbonTglGaji == $carbonTglNow) {
                return Redirect::back()->withErrors('Tanggal Validasi Tidak Valid. Anda hanya bisa melakukan Validasi Data Gaji satu bulan sekali.');
            } else {
                // Hapus Data Gaji OLD
                DB::table('gaji')->where('status',false)->update(array('status' => true));
                // for($count = 0; $count < count($getGaji); $count++)
                // {
                //     $ins = array(
                //         'status' => true
                //     );
                //     // $pushNominal[] = $nominal[$count];
                //     $dataArray[] = $ins; 
                // }
                // gaji::update($dataArray);
                // Simpan Data Gaji NEW
                for($count = 0; $count < count($show); $count++)
                {
                    $ins = array(
                        'id_user'  => $show[$count]->id_users,
                        'id_terima'  => $show[$count]->id,
                        'total_terima' => $show[$count]->gapok + $show[$count]->struktural + $show[$count]->fungsional + $show[$count]->insentif,
                        'total_potong' => $show[$count]->potong,
                        'total_kotor' => $show[$count]->gapok + $show[$count]->struktural + $show[$count]->fungsional + $show[$count]->insentif,
                        'total_bersih' => ($show[$count]->gapok + $show[$count]->struktural + $show[$count]->fungsional + $show[$count]->insentif) - $show[$count]->potong,
                        'status' => false,
                        'tgl' => $tgl
                    );
                    $dataArray[] = $ins; 
                }
                gaji::insert($dataArray);
            }
        }
        
        return redirect::back()->with('message','Proses Validasi berjalan dengan lancar. Data berhasil di Validasi Pada : '.$now);
    }

    public function detail($id)
    {
        $getDB = gaji::where('id',$id)->where('status',false)->where('deleted_at',null)->first();
        $getIDuser = $getDB->id_user;
        $getIDterima = $getDB->id_terima;

        // $show = terima::where('id_user', $getID)->where('delete', null)->where('deleted_at', null)->first();
        $show = DB::table('gaji')
                ->join('users', 'users.id', '=', 'gaji.id_user')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->join('gaji_golongan', 'gaji_golongan.id', '=', 'users.id_gol')
                ->join('gaji_terima', 'gaji.id_terima', '=', 'gaji_terima.id')
                ->where('gaji.id_user',$getIDuser)
                ->where('gaji.id_terima',$getIDterima)
                ->where('gaji.status',false)
                ->select('roles.name as nama_role','users.masuk_kerja','users.jabatan','users.nama_rek','users.nomor_rek','users.nama','users.name','users.nip','gaji_golongan.id as id_golongan','gaji_golongan.nama as nama_golongan','gaji_terima.*','gaji.id_terima','gaji.total_terima','gaji.total_potong','gaji.total_kotor','gaji.total_bersih','gaji.tgl')
                ->get();
        
        $struktural = struktural::get();
        $strukturalHas = struktural_has_user::where('id_user', $getIDuser)->get();
        $fungsional = fungsional::get();
        $fungsionalHas = fungsional_has_user::where('id_user', $getIDuser)->get();
        $ref_potong = ref_potong::get();
        $potongHas = potong_has_user::where('id_user', $getIDuser)->get();
        // print_r($potongHas);
        // die();

        $data = [
            'fungsionalHas' => $fungsionalHas,
            'strukturalHas' => $strukturalHas,
            'fungsional' => $fungsional,
            'struktural' => $struktural,
            'ref_potong' => $ref_potong,
            'potongHas' => $potongHas,
            'show' => $show
        ];

        // print_r($data['status']);
        // die();
        return view('pages.kantor.kepegawaian.gaji.detail-gaji')->with('list', $data);
    }

    public function print($id)
    {
        $getDB = gaji::where('id',$id)->where('status',false)->where('deleted_at',null)->first();
        $getIDuser = $getDB->id_user;
        $getIDterima = $getDB->id_terima;

        $show = DB::table('gaji')
                ->join('users', 'users.id', '=', 'gaji.id_user')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->join('gaji_golongan', 'gaji_golongan.id', '=', 'users.id_gol')
                ->join('gaji_terima', 'gaji.id_terima', '=', 'gaji_terima.id')
                ->where('gaji.id_user',$getIDuser)
                ->where('gaji.id_terima',$getIDterima)
                ->where('gaji.status',false)
                ->select('roles.name as nama_role','users.masuk_kerja','users.jabatan','users.nama_rek','users.nomor_rek','users.nama','users.name','users.nip','gaji_golongan.id as id_golongan','gaji_golongan.nama as nama_golongan','gaji_terima.*','gaji.id_terima','gaji.total_terima','gaji.total_potong','gaji.total_kotor','gaji.total_bersih','gaji.tgl')
                ->get();
        
        $struktural = struktural::get();
        $strukturalHas = struktural_has_user::where('id_user', $getIDuser)->get();
        $fungsional = fungsional::get();
        $fungsionalHas = fungsional_has_user::where('id_user', $getIDuser)->get();
        $ref_potong = ref_potong::get();
        $potongHas = potong_has_user::where('id_user', $getIDuser)->get();
        // $dokter = dokter::where('id',(int)$show->dr_pengirim)->first();
        // $tgl = Carbon::parse($show[0]->tgl)->isoFormat('DD-MM-YYYY');
        $tgl = Carbon::now()->isoFormat('DD-MM-YYYY');
        $bulan = Carbon::parse($show[0]->tgl)->isoFormat('MMMM');
        $tahun = Carbon::parse($show[0]->tgl)->isoFormat('YYYY');
        $ttd = 'Zainal Muttaqin'; 

        // print_r($show);
        // die();
        $data = [
            'fungsionalHas' => $fungsionalHas,
            'strukturalHas' => $strukturalHas,
            'fungsional' => $fungsional,
            'struktural' => $struktural,
            'ref_potong' => $ref_potong,
            'potongHas' => $potongHas,
            'show' => $show,
            'tgl' => $tgl,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'ttd' => $ttd
        ];

        // print_r($data);
        // die();
        return view('pages.kantor.kepegawaian.gaji.cetak-gaji')->with('list', $data);
    }

    public function printAll()
    {
        $show = DB::table('gaji')
                ->join('users', 'users.id', '=', 'gaji.id_user')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->join('gaji_golongan', 'gaji_golongan.id', '=', 'users.id_gol')
                ->join('gaji_terima', 'gaji.id_terima', '=', 'gaji_terima.id')
                ->where('gaji.status',false)
                ->where('gaji.deleted_at',null)
                ->select('roles.name as nama_role','users.masuk_kerja','users.jabatan','users.nama_rek','users.nomor_rek','users.nama','users.name','users.nip','gaji_golongan.id as id_golongan','gaji_golongan.nama as nama_golongan','gaji_terima.*','gaji.id_terima','gaji.total_terima','gaji.total_potong','gaji.total_kotor','gaji.total_bersih','gaji.tgl')
                ->get();
        // print_r($show);
        // die();
        
        $struktural = struktural::get();
        $strukturalHas = struktural_has_user::get();
        $fungsional = fungsional::get();
        $fungsionalHas = fungsional_has_user::get();
        $ref_potong = ref_potong::get();
        $potongHas = potong_has_user::get();
        // $dokter = dokter::where('id',(int)$show->dr_pengirim)->first();
        $tgl = Carbon::now()->isoFormat('DD-MM-YYYY');
        $bulan = Carbon::parse($show[0]->tgl)->isoFormat('MMMM');
        $tahun = Carbon::parse($show[0]->tgl)->isoFormat('YYYY');
        $ttd = 'Zainal Muttaqin'; 

        // print_r($show);
        // die();
        $data = [
            'fungsionalHas' => $fungsionalHas,
            'strukturalHas' => $strukturalHas,
            'fungsional' => $fungsional,
            'struktural' => $struktural,
            'ref_potong' => $ref_potong,
            'potongHas' => $potongHas,
            'show' => $show,
            'tgl' => $tgl,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'ttd' => $ttd
        ];

        // print_r($data);
        // die();
        return view('pages.kantor.kepegawaian.gaji.cetak-gajiAll')->with('list', $data);
    }

    public function hapus()
    {
        $getGaji = gaji::where('status',false)->where('status',0)->get();
        // Hapus Data Gaji OLD
        for($count = 0; $count < count($getGaji); $count++)
        {
            $ins = array(
                'id' => $getGaji[$count]->id
            );
            // $pushNominal[] = $nominal[$count];
            $dataArray[] = $ins; 
        }
        // print_r($data->status);
        // die();
        DB::table('gaji')->where('status',false)->where('status',0)->update(array('status' => true));
        gaji::whereIn('id',$dataArray)->delete();
        
        // Hapus Data Gaji = make NOT NULL on deleted_at
        // $deleteGaji = gaji::where('status',false)->where('status',0)->delete();

        return redirect::back()->with('message','Hapus Data Validasi Gaji Berhasil dilakukan');
    }
}

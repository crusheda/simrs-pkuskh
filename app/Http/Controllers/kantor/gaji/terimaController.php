<?php

namespace App\Http\Controllers\kantor\gaji;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\gaji\fungsional;
use App\Models\gaji\struktural;
use App\Models\gaji\fungsional_has_user;
use App\Models\gaji\struktural_has_user;
use App\Models\gaji\potong_has_user;
use App\Models\gaji\golongan;
use App\Models\gaji\terima;
use App\Models\gaji\ref_potong;
use App\Models\user;
use Carbon\Carbon;
use Exception;
use Redirect;
use Auth;

class terimaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('roles.name as nama_role','users.*')
                ->where('users.status',null)
                ->get();
        $notyet = DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('roles.name as nama_role','users.*')
                ->where('users.id_gol',null)
                ->where('users.status',null)
                ->where('roles.name','<>','administrator')
                ->get();
        $struktural = struktural::get();
        $strukturalHas = struktural_has_user::get();
        $fungsional = fungsional::get();
        $fungsionalHas = fungsional_has_user::get();
        $golongan = golongan::get();
        $ref_potong = ref_potong::get();
        $potongHas = potong_has_user::where('deleted_at',null)->get();
        // $recent = DB::table('gaji_terima')->whereNotNull('deleted_at')->where('delete',null)->get();
        // $notyet = user::where('id_gol',null)->get();
        $show = DB::table('gaji_terima')
                ->join('users', 'users.id', '=', 'gaji_terima.id_user')
                // ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                // ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->join('gaji_golongan', 'gaji_golongan.id', '=', 'users.id_gol')
                ->where('gaji_terima.deleted_at',null)
                ->where('users.status',null)
                ->select('users.nama','users.name','users.nip','gaji_golongan.id as id_golongan','gaji_golongan.nama as nama_golongan','gaji_terima.*')
                ->get();

        $bln = Carbon::now()->isoFormat('MM');
        $thn = Carbon::now()->isoFormat('YYYY');
        // print_r($potonghas);
        // die();

        $data = [
            'user' => $user,
            'struktural' => $struktural,
            'strukturalHas' => $strukturalHas,
            'fungsional' => $fungsional,
            'fungsionalHas' => $fungsionalHas,
            'golongan' => $golongan,
            'potongHas' => $potongHas,
            'ref_potong' => $ref_potong,
            'notyet' => $notyet,
            'bln' => $bln,
            'thn' => $thn,
            'show' => $show
        ];
        // foreach ($data['strukturalHas'] as $key => $value) {
        //     print_r($value->id_struktural);
        // }
        // print_r($strukturalHas[0]->id_struktural);
        // die();
        
        // print_r($getmont);
        // die();

        // print_r($data['show']);
        // die();
        return view('pages.kantor.kepegawaian.gaji.terima')->with('list', $data);
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
        $getUser = Auth::user();
        // print_r($request->baru);
        // die();

        // Saving Fungsional
        foreach ($request->fungsional as $key => $value) {
            $data = new fungsional_has_user;
            $data->id_fungsional  = $value;
            $data->id_user  = $request->user_id;
            $data->save();
            
            $getValueFungsional = fungsional::where('id',$value)->first();
            $sumFungsional[] = $getValueFungsional->nominal;
        }
        ///////////////////////////////////////////////////////////////////////////////
        // Saving Struktural
        foreach ($request->struktural as $key => $value) {
            $data = new struktural_has_user;
            $data->id_struktural  = $value;
            $data->id_user  = $request->user_id;
            $data->save();

            $getValueStruktural = struktural::where('id',$value)->first();
            $sumStruktural[] = $getValueStruktural->nominal;
        }
        ///////////////////////////////////////////////////////////////////////////////
        // Saving Golongan
        $data = user::find($request->user_id);
        $data->id_gol = $request->golongan;
        $data->save();
        ///////////////////////////////////////////////////////////////////////////////
        // Saving PotongHasUser
            // Get array from Input Form
            $id_kriteria = $request->input('id');
            $nominal = $request->input('nominal');
            $ket = $request->input('ket');
            // Push Into DB
            for($count = 0; $count < count($id_kriteria); $count++)
            {
                $ins = array(
                    'id_user'  => $request->user_id,
                    'id_potong'  => $id_kriteria[$count],
                    'nominal' => $nominal[$count],
                    'ket' => $ket[$count]
                );
                $pushNominal[] = $nominal[$count];
                $dataArray[] = $ins; 
            }
            potong_has_user::insert($dataArray);
        ///////////////////////////////////////////////////////////////////////////////
        // Hitung Infaq
            if ($request->infaq == 1) {
                //1 % Gaji Pokok
                $infaq = 0.01 * $request->gapok;
            } elseif ($request->infaq == 2) {
                //2,5 % Gaji Pokok
                $infaq = 0.025 * $request->gapok;
            } elseif ($request->infaq == 3) {
                //2,5 % Total Penerimaan Kotor
                $totalKotor = $request->gapok + array_sum($sumFungsional) + array_sum($sumStruktural) + $request->insentif;
                $infaq = 0.025 * $totalKotor;
            }
        ///////////////////////////////////////////////////////////////////////////////
        // Saving Other
            // Hitung Total Potongan
            $totalPotong = array_sum($pushNominal) + $infaq;
            // Karyawan Baru vs Lama
            if ($request->baru == true) {
                $totalAkhirPotong = $totalPotong + 100000;
            } else {
                $totalAkhirPotong = $totalPotong + 5000;
            }

            // Saving Terima
            $data = new terima;
            $data->id_user  = $request->user_id;
            $data->fungsional  = array_sum($sumFungsional);
            $data->struktural  = array_sum($sumStruktural);
            $data->gapok = $request->gapok;
            $data->insentif = $request->insentif;
            $data->potong = $totalAkhirPotong;
            $data->infaq = $infaq;
            if (empty($request->baru)) {
                $data->iuran_pokok = false;
            } else {
                $data->iuran_pokok = true;
            }
            $data->id_infaq = $request->infaq;
            $data->user_store = $getUser->id;
            $data->save();

        return redirect::back()->with('message','Penambahan Karyawan ID : '.$request->user_id.' Berhasil');
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
        $getUser = Auth::user();
        /////////////////////////////////////////////////////////////////////////////// Tampungan Array
        // gaji_terima
        $bln = Carbon::now()->isoFormat('MM');
        $thn = Carbon::now()->isoFormat('YYYY');
        $query_string = "SELECT potong,infaq,created_at,iuran_pokok FROM gaji_terima WHERE id_user = $request->user_id AND YEAR(created_at) = $thn AND MONTH(created_at) = $bln AND deleted_at IS NULL";
        $getTgl = DB::select($query_string);
        // print_r($getTgl);
        // die();

        /////////////////////////////////////////////////////////////////////////////// Delete
        // Delete from gaji_terima
        $del1 = terima::where('id_user', $request->user_id)->delete();

        // Delete from potong_has_user::
        $del2 = potong_has_user::where('id_user', $request->user_id)->delete();

        // Delete from fungsional_has_user::
        $del3 = fungsional_has_user::where('id_user', $request->user_id)->delete();

        // Delete from struktural_has_user::
        $del4 = struktural_has_user::where('id_user', $request->user_id)->delete();
        
        /////////////////////////////////////////////////////////////////////////////// Mulai Save
        // Saving Fungsional
        foreach ($request->fungsional as $key => $value) {
            $data = new fungsional_has_user;
            $data->id_fungsional  = $value;
            $data->id_user  = $request->user_id;
            $data->save();
            
            $getValueFungsional = fungsional::where('id',$value)->first();
            $sumFungsional[] = $getValueFungsional->nominal;
        }
        ///////////////////////////////////////////////////////////////////////////////
        // Saving Struktural
        foreach ($request->struktural as $key => $value) {
            $data = new struktural_has_user;
            $data->id_struktural  = $value;
            $data->id_user  = $request->user_id;
            $data->save();

            $getValueStruktural = struktural::where('id',$value)->first();
            $sumStruktural[] = $getValueStruktural->nominal;
        }
        ///////////////////////////////////////////////////////////////////////////////
        // Saving Golongan
        $data = user::find($request->user_id);
        $data->id_gol = $request->golongan;
        $data->save();
        ///////////////////////////////////////////////////////////////////////////////
        // Saving PotongHasUser
            // Get array from Input Form
            $id_kriteria = $request->input('id');
            $nominal = $request->input('nominal');
            $ket = $request->input('ket');
            // Push Into DB
            for($count = 0; $count < count($id_kriteria); $count++)
            {
                $ins = array(
                    'id_user'  => $request->user_id,
                    'id_potong'  => $id_kriteria[$count],
                    'nominal' => $nominal[$count],
                    'ket' => $ket[$count]
                );
                $pushNominal[] = $nominal[$count];
                $dataArray[] = $ins; 
            }
            potong_has_user::insert($dataArray);
        ///////////////////////////////////////////////////////////////////////////////
        // Hitung Infaq
            if ($request->infaq == 1) {
                //1 % Gaji Pokok
                $infaq = 0.01 * $request->gapok;
            } elseif ($request->infaq == 2) {
                //2,5 % Gaji Pokok
                $infaq = 0.025 * $request->gapok;
            } elseif ($request->infaq == 3) {
                //2,5 % Total Penerimaan Kotor
                $totalKotor = $request->gapok + array_sum($sumFungsional) + array_sum($sumStruktural) + $request->insentif;
                $infaq = 0.025 * $totalKotor;
            }
        ///////////////////////////////////////////////////////////////////////////////
        // Saving Other
            // Hitung Total Potongan
            $totalPotong = array_sum($pushNominal) + $infaq;

            // Validasi Karyawan Baru vs Lama
                // $getTgl ada di atas (Tampungan)
                $tglCarbon = Carbon::now()->isoFormat('YYYY-MM'); // 2021-07
                $tglTimestamp = Carbon::parse($getTgl[0]->created_at)->isoFormat('YYYY-MM'); // 2021-07
                if ($tglCarbon == $tglTimestamp) {
                    $iuranPokok = $getTgl[0]->iuran_pokok;
                    $totalPotongFinal = $totalPotong;
                } else {
                    if ($getTgl[0]->iuran_pokok != false || !empty($getTgl[0]->iuran_pokok)) {
                        $totalPotongFinal = ($totalPotong - 100000) + 5000;
                    } else {
                        $totalPotongFinal = $totalPotong;
                    }
                    $iuranPokok = false;
                }

            // Saving Terima
            $data = new terima;
            $data->id_user  = $request->user_id;
            $data->fungsional  = array_sum($sumFungsional);
            $data->struktural  = array_sum($sumStruktural);
            $data->gapok = $request->gapok;
            $data->insentif = $request->insentif;
            $data->potong = $totalPotongFinal;
            $data->infaq = $infaq;
            $data->id_infaq = $request->infaq;
            $data->iuran_pokok = $iuranPokok;
            $data->user_store = $getUser->id;
            $data->save();

        return redirect::back()->with('message','Perubahan Data Karyawan ID : '.$data->id_user.' Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getUserId = Auth::user();

        // Delete from terima::
        $data = terima::find($id);
            $getID = $data->id_user;
        $data->id_user = $getUserId->id;
        $data->delete = true;
        $data->save();

        // Delete from gaji_terima
        $del1 = terima::where('id_user', $getID)->delete();

        // Delete from potong_has_user::
        $del2 = potong_has_user::where('id_user', $getID)->delete();

        // Delete from fungsional_has_user::
        $del3 = fungsional_has_user::where('id_user', $getID)->delete();

        // Delete from struktural_has_user::
        $del4 = struktural_has_user::where('id_user', $getID)->delete();

        // Delete id_gol in Users
        $del5 = user::where('id',$getID)->first();
        $del5->id_gol = null;
        $del5->save();

        return redirect::back()->with('message','Hapus User ID : '.$getID.' Berhasil');
    }

    public function detail($id)
    {
        $getDB = terima::where('id',$id)->where('delete',null)->where('deleted_at',null)->first();
        $getID = $getDB->id_user;

        // $show = terima::where('id_user', $getID)->where('delete', null)->where('deleted_at', null)->first();
        $show = DB::table('gaji_terima')
                ->join('users', 'users.id', '=', 'gaji_terima.id_user')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->join('gaji_golongan', 'gaji_golongan.id', '=', 'users.id_gol')
                ->where('gaji_terima.id_user',$getID)
                ->where('gaji_terima.deleted_at',null)
                ->where('gaji_terima.delete',null)
                ->where('users.status',null)
                ->select('roles.name as nama_role','users.masuk_kerja','users.jabatan','users.nama_rek','users.nomor_rek','users.nama','users.name','users.nip','gaji_golongan.id as id_golongan','gaji_golongan.nama as nama_golongan','gaji_terima.*')
                ->get();
        
        $struktural = struktural::get();
        $strukturalHas = struktural_has_user::where('id_user', $getID)->get();
        $fungsional = fungsional::get();
        $fungsionalHas = fungsional_has_user::where('id_user', $getID)->get();
        $ref_potong = ref_potong::get();
        $potongHas = potong_has_user::where('id_user', $getID)->get();
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
        return view('pages.kantor.kepegawaian.gaji.detail-terima')->with('list', $data);
    }
}
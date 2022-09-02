<?php

namespace App\Http\Controllers\k3;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\k3\manrisk;
use App\Models\unit;
use App\Models\user;
use Carbon\Carbon;
use Auth;
use Storage;
use Exception;
use Redirect;

class manriskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('pages.new.laporan.k3.accidentreport')->with('list', $data);
        return view('pages.k3.manrisk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unit = unit::orderBy('nama','ASC')->get();

        $data = [
            'unit' => $unit,
        ];

        return view('pages.k3.manrisk.tambah')->with('list', $data);
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
        $id = $user->id;
        $name = $user->name;
        $role = $user->roles;
        foreach ($role as $key => $value) {
            $unitArr[] = $value->name;
        }
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // RISIKO NON KLINIS
        $nilai = $request->dampak * $request->frekuensi;
        if ($nilai >= 1 && $nilai <= 2) {
            $tingkat_risiko = 'Low';
        } elseif ($nilai >= 3 && $nilai <= 4) {
            $tingkat_risiko = 'Medium';
        } elseif ($nilai >= 5 && $nilai <= 9) {
            $tingkat_risiko = 'High';
        } elseif ($nilai >= 10 && $nilai <= 12) {
            $tingkat_risiko = 'Extreme';
        } elseif ($nilai >= 13 && $nilai <= 25) {
            $tingkat_risiko = 'Very Extreme';
        }

        if (!empty($request->user_unit)) {
            $unit = $request->user_unit;
        } else {
            $unit = json_encode($unitArr);
        }

        // print_r($request->user_unit);
        // die();
        $data = new manrisk;
        $data->id_user          = $id;
        $data->unit             = $unit;
        $data->jenis_risiko     = $request->jenis_risiko;
        $data->proses_utama     = $request->proses_utama;
        $data->item_kegiatan    = $request->item_kegiatan;
        $data->jenis_aktivitas  = $request->jenis_aktivitas;
        $data->kode_bahaya      = $request->kode_bahaya;
        $data->sumber_bahaya    = $request->sumber_bahaya;
        $data->risiko           = $request->risiko;
        $data->pengendalian     = $request->pengendalian;
        $data->dampak           = $request->dampak;
        $data->frekuensi        = $request->frekuensi;
        $data->nilai            = $nilai;
        $data->tingkat_risiko   = $tingkat_risiko;
        $data->elm              = $request->has('elm');
        $data->sbt              = $request->has('sbt');
        $data->eng              = $request->has('eng');
        $data->adm              = $request->has('adm');
        $data->apd              = $request->has('apd');
        $data->deskripsi        = $request->deskripsi;
        $data->waktu_penerapan  = $request->waktu_penerapan;
        
        $data->save();
        
        return redirect()->route('manrisk.index')->with('message','Tambah Formulir Manajemen Resiko Berhasil oleh '.$name.' Pada '.$tgl);
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
        $user = Auth::user();
        $name = $user->name;
        $role = $user->roles->first()->name; //kabag-keperawatan
        
        $show = manrisk::where('id',$id)->get();

        $data = [
            'show' => $show,
            'nama' => $name,
        ];
        // print_r($data);
        // die();

        return view('pages.k3.manrisk.ubah')->with('list', $data);
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
        $user = Auth::user();
        $name = $user->name;
        // $role = $user->roles;
        // foreach ($role as $key => $value) {
        //     $unitArr[] = $value->name;
        // }
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // RISIKO NON KLINIS
        $nilai = $request->dampak * $request->frekuensi;
        if ($nilai >= 1 && $nilai <= 2) {
            $tingkat_risiko = 'Low';
        } elseif ($nilai >= 3 && $nilai <= 4) {
            $tingkat_risiko = 'Medium';
        } elseif ($nilai >= 5 && $nilai <= 9) {
            $tingkat_risiko = 'High';
        } elseif ($nilai >= 10 && $nilai <= 12) {
            $tingkat_risiko = 'Extreme';
        } elseif ($nilai >= 13 && $nilai <= 25) {
            $tingkat_risiko = 'Very Extreme';
        }


        $data = manrisk::find($id);
        // if (!empty($request->user_unit)) {
        //     $unit = $request->user_unit;
        //     $data->unit = $unit;
        // } else {
        //     $unit = json_encode($unitArr);
        //     $data->unit = $unit;
        // }
        $data->jenis_risiko     = $request->jenis_risiko;
        $data->proses_utama     = $request->proses_utama;
        $data->item_kegiatan    = $request->item_kegiatan;
        $data->jenis_aktivitas  = $request->jenis_aktivitas;
        $data->kode_bahaya      = $request->kode_bahaya;
        $data->sumber_bahaya    = $request->sumber_bahaya;
        $data->risiko           = $request->risiko;
        $data->pengendalian     = $request->pengendalian;
        $data->dampak           = $request->dampak;
        $data->frekuensi        = $request->frekuensi;
        $data->nilai            = $nilai;
        $data->tingkat_risiko   = $tingkat_risiko;
        $data->elm              = $request->has('elm');
        $data->sbt              = $request->has('sbt');
        $data->eng              = $request->has('eng');
        $data->adm              = $request->has('adm');
        $data->apd              = $request->has('apd');
        $data->deskripsi        = $request->deskripsi;
        $data->waktu_penerapan  = $request->waktu_penerapan;

        // print_r($data);
        // die();
        $data->save();

        return redirect()->route('manrisk.index')->with('message','Ubah Formulir Manajemen Resiko Berhasil oleh '.$name.' Pada '.$tgl);
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

    public function apiData()
    {
        // if ($user->hasRole('it')) {
        //     $show = ref_jadwal_dinas::get();
        // } else {
        //     $show = ref_jadwal_dinas::where('id_user',$id)->get();
        // }
        $show = manrisk::get();
        // print_r($show);
        // die();

        $data = [
            'show' => $show,
        ];

        // print_r($data);
        // die();
        return response()->json($data, 200);
    }

    public function apiBerulang()
    {
        $user = Auth::user();
        $user_id = $user->id;

        if ($user->hasRole(['k3','it'])) {
            $show = manrisk::get();
        } else {
            $show = manrisk::where('id_user',$user_id)->get();
        }

        $data = [
            'show' => $show,
        ];

        // print_r($data);
        // die();
        return response()->json($data, 200);
    }


    public function apiValidasiBerulang($id)
    {
        $data = manrisk::where('id',$id)->first();

        return response()->json($data, 200);
    }

    public function saveBerulang(Request $request)
    {
        $user = Auth::user();
        $name = $user->name;
        $now = Carbon::now();
        $tgl = $now->isoFormat('dddd, D MMMM Y, HH:mm a');
        
        $data = manrisk::find($request->sumber_bahaya);
        $data->residual = $data->residual+1;
        if ($data->residualdate1 == null) {
            $data->residualdate1 = $now;
        } else {
            if ($data->residualdate2 == null) {
                $data->residualdate2 = $now;
            } else {
                if ($data->residualdate3 == null) {
                    $data->residualdate3 = $now;
                } else {
                    if ($data->residualdate4 == null) {
                        $data->residualdate4 = $now;
                    } else {
                        if ($data->residualdate5 == null) {
                            $data->residualdate5 = $now;
                        } else {
                            if ($data->residualdate6 == null) {
                                $data->residualdate6 = $now;
                            } else {
                                if ($data->residualdate7 == null) {
                                    $data->residualdate7 = $now;
                                } else {
                                    if ($data->residualdate8 == null) {
                                        $data->residualdate8 = $now;
                                    } else {
                                        if ($data->residualdate9 == null) {
                                            $data->residualdate9 = $now;
                                        } else {
                                            $data->residualdate10 = $now;
                                        }
                                        
                                    }
                                    
                                }
                                
                            }
                            
                        }
                    }
                    
                }
                
            }
        }
        $data->save();

        return redirect()->route('manrisk.index')->with('message','Tambah Residual Daftar Resiko Berhasil oleh '.$name.' Pada '.$tgl);
    }

    public function apiHapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        manrisk::where('id', $id)->delete();

        return response()->json($tgl, 200);
    }
}

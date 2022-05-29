<?php

namespace App\Http\Controllers\administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use App\Models\user;
use App\Models\unit;
use App\Models\administrasi\ref_jadwal_dinas;
use App\Models\administrasi\staf_jadwal_dinas;
use App\Models\administrasi\jadwal_dinas;
use App\Models\administrasi\detail_jadwal_dinas;
use Carbon\Carbon;
use Auth;
use Redirect;

class jadwalDinasController extends Controller
{
    public function index()
    {
        $show = jadwal_dinas::join('unit','unit.id','=','jadwal_dinas.id_unit')->select('jadwal_dinas.*','unit.nama as nama_unit')->get();
        $unit = unit::get();

        $data = [
            'show' => $show,
            'unit' => $unit,
        ];

        return view('pages.new.administrasi.jadwaldinas.index')->with('list', $data);
    }

    public function create(Request $request)
    {
        // print_r($request->waktu);
        // die();
        $user = Auth::user();
        $id = $user->id;
        
        $waktu = Carbon::parse($request->waktu)->isoFormat('MMMM Y');
        $getRef = ref_jadwal_dinas::where('id_user',$id)->get();
        $getUser = staf_jadwal_dinas::where('id_user',$id)->orderBy('nama','asc')->get();
        $totalDays = Carbon::now()->daysInMonth;
    
        $data = [
            'waktuOri' => $request->waktu,
            'unit' => $request->unit,
            'waktu' => $waktu,
            'ref' => $getRef,
            'user' => $getUser,
            'days' => $totalDays,
        ];

        return view('pages.new.administrasi.jadwaldinas.create')->with('list', $data);
    }

    public function store(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // COUNT DAYS IN THIS MONTH
        $totalDays = Carbon::now()->daysInMonth;

        // AUTH
        $user = Auth::user();
        $id_user = $user->id;
        $name = $user->name;
        $nama_user = $user->nama;
        $role = $user->roles;
        foreach ($role as $key => $value) {
            $unit[] = $value->name;
        }
        
        // for $request->bulan
        $bulan = Carbon::parse($request->bulan);

        // DB
        $queue = jadwal_dinas::orderBy('id_jadwal','DESC')->first();
        $getUser = staf_jadwal_dinas::where('id_user',$id_user)->orderBy('nama','asc')->get();
        $getRef = ref_jadwal_dinas::where('id_user',$id_user)->get();
        // print_r($queue);
        // die();
        if (empty($queue)) {
            $getQueue = 1;
        } else {
            $getQueue = $queue->id_jadwal + 1;
        }
        
        // WAKTU UNTUK LIBUR & CUTI
        $timeLC = Carbon::parse('00:00:00')->toTimeString();
        // print_r($timeLC);
        // die();

        // for $request->waktu
        foreach ($getUser as $key => $value) {
            for ($i=0; $i < $totalDays ; $i++) { 
                // SAVE in DETAIL JADWAL DINAS
                $save1 = new detail_jadwal_dinas;
                $save1->id_jadwal = $getQueue;
                $save1->id_staf = $value->id_staf;
                $save1->tgl = $i+1;
                foreach ($getRef as $kc => $item) {
                    if ($item->id == $request->waktu[$i]) {
                        $save1->id_ref = $item->id;
                        $save1->singkatan = $item->singkat;
                        $save1->waktu = $item->waktu;
                        $save1->berangkat = $item->berangkat;
                        $save1->pulang = $item->pulang;
                    } elseif ($request->waktu[$i] == 100001) {
                        $save1->id_ref = 100001;
                        $save1->singkatan = 'L';
                        $save1->waktu = 'LIBUR';
                        $save1->berangkat = $timeLC;
                        $save1->pulang = $timeLC;
                    } elseif ($request->waktu[$i] == 100002) {
                        $save1->id_ref = 100002;
                        $save1->singkatan = 'C';
                        $save1->waktu = 'CUTI';
                        $save1->berangkat = $timeLC;
                        $save1->pulang = $timeLC;
                    }
                }
                $save1->save();
            }
        }

        // SAVE in JADWAL DINAS
        $save2 = new jadwal_dinas;
        $save2->id_jadwal = $getQueue;
        $save2->id_user = $id_user;
        $save2->id_unit = $request->unit;
        $save2->nama_user = $nama_user;
        $save2->unit = json_encode($unit);
        $save2->waktu = $bulan;
        $save2->save();

        return redirect()->route('jadwal.dinas.index')->with('message','Tambah Jadwal Dinas Berhasil oleh '.$name.' Pada '.$tgl);
    }

    public function showUbah($id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        
        $getJadwal = jadwal_dinas::where('id_jadwal',$id)->first();
        $getDetailJadwal = detail_jadwal_dinas::where('id_jadwal',$id)->orderBy('id','asc')->get();

        $waktu = Carbon::parse($getJadwal->waktu)->isoFormat('MMMM Y');
        $getRef = ref_jadwal_dinas::where('id_user',$getJadwal->id_user)->get();
        $getUser = staf_jadwal_dinas::where('id_user',$getJadwal->id_user)->orderBy('nama','asc')->get();
        $totalDays = Carbon::parse($getJadwal->waktu)->daysInMonth;
        // print_r($getRef);
        // die();
    
        $data = [
            'show' => $getJadwal,
            'detail' => $getDetailJadwal,
            'waktuOri' => $getJadwal->waktu,
            'unit' => $getJadwal->unit,
            'waktu' => $waktu,
            'ref' => $getRef,
            'user' => $getUser,
            'days' => $totalDays,
        ];

        return view('pages.new.administrasi.jadwaldinas.edit')->with('list', $data);
    }

    public function ubah(Request $request, $id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        // print_r($id);
        // die();

        // AUTH
        $user = Auth::user();
        $id_user = $user->id;
        $name = $user->name;
        $nama_user = $user->nama;
        $role = $user->roles;
        
        // for $request->bulan
        $bulan = Carbon::parse($request->bulan);

        // DB
        $getJadwal = jadwal_dinas::where('id_jadwal',$id)->first();
        $getUser = staf_jadwal_dinas::where('id_user',$id_user)->orderBy('nama','asc')->get();
        $getRef = ref_jadwal_dinas::where('id_user',$id_user)->get();

        // COUNT DAYS IN THIS MONTH
        $totalDays = Carbon::parse($getJadwal->waktu)->daysInMonth;
        
        $timeLC = Carbon::parse('00:00:00')->toTimeString();
    
        // for $request->waktu
        // $data = detail_jadwal_dinas::where('id_jadwal',$id)->orderBy('id','asc')->get();
        // foreach ($data as $key => $value) {
        //     foreach ($getRef as $kc => $item) {
        //         if ($item->id == $request->waktu[$key]) {
        //             $data->id_ref = 100001;
        //             $data->singkatan = $item->singkat;
        //             $data->waktu = $item->waktu;
        //             $data->berangkat = $item->berangkat;
        //             $data->pulang = $item->pulang;
        //         } elseif ($request->waktu[$key] == 100001) {
        //             $data->id_ref = 100001;
        //             $data->singkatan = 'L';
        //             $data->waktu = 'LIBUR';
        //             $data->berangkat = $timeLC;
        //             $data->pulang = $timeLC;
        //         } elseif ($request->waktu[$key] == 100002) {
        //             $data->id_ref = 100002;
        //             $data->singkatan = 'C';
        //             $data->waktu = 'CUTI';
        //             $data->berangkat = $timeLC;
        //             $data->pulang = $timeLC;
        //         }
        //     }
        //     $data[$key]->save();
        // }
        // print_r($data);
        // die();

        return redirect()->route('jadwal.dinas.index')->with('message','Ubah Jadwal Dinas Berhasil oleh '.$name.' Pada '.$tgl);
    }

    public function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        jadwal_dinas::where('id_jadwal', $id)->delete();
        detail_jadwal_dinas::where('id_jadwal', $id)->delete();

        return response()->json($tgl, 200);
    }

    public function showDetail($id)
    {
        $show = detail_jadwal_dinas::select('detail_jadwal_dinas.id_jadwal','detail_jadwal_dinas.id_staf as id_user','detail_jadwal_dinas.tgl','detail_jadwal_dinas.singkatan','detail_jadwal_dinas.waktu','detail_jadwal_dinas.berangkat','detail_jadwal_dinas.pulang','detail_jadwal_dinas.updated_at')
                                    ->join('users','detail_jadwal_dinas.id_staf','=','users.id')
                                    ->where('detail_jadwal_dinas.id_jadwal',$id)
                                    ->orderBy('detail_jadwal_dinas.id','asc')
                                    ->get();
        
        $uploader = jadwal_dinas::select('jadwal_dinas.id_jadwal','users.id as id_user','users.nama as nama_user','unit.nama as nama_unit','jadwal_dinas.unit as encode_unit','jadwal_dinas.waktu','jadwal_dinas.updated_at')
                                ->join('users','jadwal_dinas.id_user','=','users.id')
                                ->join('unit','jadwal_dinas.id_unit','=','unit.id')
                                ->where('jadwal_dinas.id_jadwal',$id)
                                ->first();

        $staf = detail_jadwal_dinas::select('detail_jadwal_dinas.id_jadwal','detail_jadwal_dinas.id_staf as id_user','users.nama as nama_user')
                                ->join('users','detail_jadwal_dinas.id_staf','=','users.id')
                                ->where('detail_jadwal_dinas.id_jadwal',$id)
                                ->orderBy('detail_jadwal_dinas.id','asc')
                                ->groupBy('detail_jadwal_dinas.id_jadwal','detail_jadwal_dinas.id_staf','users.nama')
                                ->get();
        
        $ref = ref_jadwal_dinas::where('id_user',$uploader->id_user)->get();
        
        $bulan = Carbon::parse($uploader->waktu)->isoFormat('MMMM Y');
        
        $data = [
            'bulan' => $bulan,
            'show' => $show,
            'staf' => $staf,
            'ref' => $ref,
            'uploader' => $uploader,
        ];

        return response()->json($data, 200);
    }
    
    // STAF JADWAL DINAS
    public function indexStaf()
    {
        $user = Auth::user();
        $id = $user->id;

        $getUser = user::select('id','nama')->where('nama','!=',null)->get();

        if ($user->hasRole('it')) {
            $show = staf_jadwal_dinas::get();
        } else {
            $show = staf_jadwal_dinas::where('id_user',$id)->get();
        }

        $data = [
            'user' => $getUser,
            'show' => $show,
        ];

        return view('pages.new.administrasi.jadwaldinas.staf')->with('list', $data);
    }

    public function storeStaf(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;
        $getUser = user::select('nama')->where('id',$request->id_staf)->first();

        $save = new staf_jadwal_dinas;
        $save->id_user = $id;
        $save->id_staf = $request->id_staf;
        $save->nama = $getUser->nama;
        $save->save();

        return redirect()->back()->with('message','Tambah Referensi Jadwal Berhasil');
    }

    public function ubahStaf(Request $request, $id)
    {
        $getUser = user::select('nama')->where('id',$request->id_staf)->first();

        $data = staf_jadwal_dinas::find($id);
        $data->id_staf = $request->id_staf;
        $data->nama = $getUser->nama;

        $data->save();
        return Redirect::back()->with('message','Perubahan Staf Jadwal Dinas Berhasil');
    }

    public function hapusStaf($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        staf_jadwal_dinas::where('id', $id)->delete();

        return response()->json($tgl, 200);
    }

    // REF JADWAL DINAS
    public function indexRef()
    {
        $user = Auth::user();
        $id = $user->id;

        if ($user->hasRole('it')) {
            $show = ref_jadwal_dinas::get();
        } else {
            $show = ref_jadwal_dinas::where('id_user',$id)->get();
        }

        $data = [
            'show' => $show,
        ];

        return view('pages.new.administrasi.jadwaldinas.ref')->with('list', $data);
    }

    public function storeRef(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;
        $role = $user->roles;
        foreach ($role as $key => $value) {
            $unit[] = $value->name;
        }
        
        $save = new ref_jadwal_dinas;
        $save->id_user = $id;
        $save->unit = json_encode($unit);
        $save->waktu = $request->waktu;
        $save->singkat = $request->singkat;
        $save->berangkat = $request->berangkat;
        $save->pulang = $request->pulang;
        $save->save();

        return redirect()->back()->with('message','Tambah Referensi Jadwal Berhasil');
    }

    public function ubahRef(Request $request, $id)
    {
        // print_r($request->singkat);
        // die();
        $data = ref_jadwal_dinas::find($id);
        $data->waktu = $request->waktu;
        $data->singkat = $request->singkat;
        $data->berangkat = $request->berangkat;
        $data->pulang = $request->pulang;

        $data->save();
        return Redirect::back()->with('message','Perubahan Referensi Jadwal Dinas Berhasil');
    }

    public function hapusRef($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        ref_jadwal_dinas::where('id', $id)->delete();

        return response()->json($tgl, 200);
    }

    // API-API
    public function getDataCreate()
    {
        $getUser = staf_jadwal_dinas::get();

        $data = [
            // 'show' => $show,
            'user' => $getUser,
        ];

        return response()->json($data, 200);
    }
}

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

class jadwalDinasController extends Controller
{
    public function index()
    {
        $show = jadwal_dinas::get();
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
        // print_r('berhasil');
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
                        $save1->waktu = $item->waktu;
                        $save1->berangkat = $item->berangkat;
                        $save1->pulang = $item->pulang;
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
    
    // STAF JADWAL DINAS
    public function indexStaf()
    {
        $user = Auth::user();
        $id = $user->id;

        $getUser = user::select('id','nama')->where('nama','!=',null)->get();
        $show = staf_jadwal_dinas::where('id_user',$id)->get();

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

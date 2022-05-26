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
        // $show = jadwal_dinas::get();

        // $data = [
        //     'show' => $show,
        // ];

        return view('pages.new.administrasi.jadwaldinas.index');
        // return view('pages.new.administrasi.jadwaldinas.index')->with('list', $data);
    }

    public function create(Request $request)
    {
        // print_r($request->waktu);
        // die();
        $user = Auth::user();
        $id = $user->id;
        
        $waktu = Carbon::parse($request->waktu)->isoFormat('MMMM Y');
        $getRef = ref_jadwal_dinas::where('id_user',$id)->get();
        $getUser = staf_jadwal_dinas::where('id_user',$id)->get();
        $totalDays = Carbon::now()->daysInMonth;
        // $getTgl = pengadaan::select('tgl_pengadaan')->where('id_user',$id)->orderBy('tgl_pengadaan','desc')->first();
        // $blnNow = Carbon::now()->isoFormat('MM');

        // if (!empty($getTgl)) {
        //     if (substr($getTgl->tgl_pengadaan,5,2) != $blnNow) {
        //         $ref = ref_barang::where('id',$request->ref_barang)->first();
        
        //         $data = [
        //             'ref' => $ref,
        //         ];
        
        //         return view('pages.new.pengadaan.tambah-pengadaan')->with('list', $data);
        //     } else {
        //         return redirect()->back()->withErrors(["Pada bulan ini anda sudah melakukan Pengadaan","Untuk melakukan pengusulan pengadaan ulang, mohon hapus pengadaan bulan ini terlebih dahulu"]);
        //     }
        // } else {
        //     $ref = ref_barang::where('id',$request->ref_barang)->first();
    
        $data = [
            'waktu' => $waktu,
            'ref' => $getRef,
            'user' => $getUser,
            'days' => $totalDays,
        ];

        return view('pages.new.administrasi.jadwaldinas.create')->with('list', $data);
    }

    public function store(Request $request)
    {
        
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

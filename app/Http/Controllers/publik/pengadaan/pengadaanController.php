<?php

namespace App\Http\Controllers\publik\pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\pengadaan\ref_barang;
use App\Models\pengadaan\barang;
use App\Models\pengadaan\pengadaan;
use App\Models\pengadaan\detail_pengadaan;
use Carbon\Carbon;
use Auth;

class pengadaanController extends Controller
{
    public function index()
    {
        $show = pengadaan::get();
        $ref = ref_barang::get();

        $data = [
            'show' => $show,
            'ref' => $ref,
        ];

        return view('pages.new.pengadaan.pengadaan')->with('list', $data);
    }

    public function create(Request $request)
    {
        // $show = barang::where('ref_barang',$request->ref_barang)->get();
        $ref = ref_barang::where('id',$request->ref_barang)->first();
        // $show = barang::join('ref_barang', 'ref_barang.id', '=', 'barang.ref_barang')->get(['barang.*','ref_barang.nama as ref']);

        $data = [
            // 'show' => $show,
            'ref' => $ref,
        ];
        // print_r($show);
        // die();

        return view('pages.new.pengadaan.tambah-pengadaan')->with('list', $data);
    }

    public function store(Request $request)
    {
        // foreach ($request->total as $key => $value) {
        // }
        // $this->validate($request, [
        //     'barang1' => 'required',
        // ]);
        foreach ($request->barang as $key => $value) {
            if ($value == "Pilih") {
                // return redirect()->back()->withErrors("Lengkai Data Barang Anda")->withInput();
                return redirect()->route('pengadaan.store')->withErrors(["Data tidak lengkap, ulangi sekali lagi","Pastikan data yang anda tambahkan terisi dengan benar"]);
            }
        }

        $user = Auth::user();
        $id = $user->id;
        $name = $user->name;
        $role = $user->roles;
        foreach ($role as $key => $value) {
            $unit[] = $value->name;
        }
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        
        $queue = pengadaan::orderBy('id_pengadaan','DESC')->first();
        // print_r($queue);
        // die();
        if (empty($queue)) {
            $getQueue = 1;
        } else {
            $getQueue = $queue->id_pengadaan + 1;
        }
        // print_r($getQueue);
        // die();
        // print_r($request->satuan);
        // die();
        for ($i=0; $i < count($request->barang); $i++) { 
            $data = new detail_pengadaan;
            $data->id_pengadaan = $getQueue;
            $data->id_barang = $request->barang[$i];
            $data->jumlah = $request->jumlah[$i];
            $data->harga = str_replace(".","",(str_replace("Rp. ", "", $request->harga[$i])));
            $data->satuan = $request->satuan[$i];
            $data->total = str_replace(".","",(str_replace("Rp. ", "", $request->total[$i])));
            $data->ket = $request->ket[$i];
            $data->save();
            
            $totalArr[] = str_replace(".","",(str_replace("Rp. ", "", $request->total[$i])));
        }
        
        $save = new pengadaan;
        $save->id_pengadaan = $getQueue;
        $save->id_user = $id;
        $save->unit = json_encode($unit);
        $save->total = array_sum($totalArr);
        $save->tgl_pengadaan = Carbon::now();
        $save->save();
        
        return redirect()->route('pengadaan.index')->with('message','Tambah Pengadaan Berhasil oleh '.$name.' Pada '.$tgl);
        // return view('pages.new.pengadaan.pengadaan')->with('message','Tambah Pengadaan Berhasil oleh '.$name);
    }

    // API
    public function getBarang($ref_barang)
    {
        $show = barang::where('ref_barang',$ref_barang)->get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    public function getBarangDetail($id)
    {
        $show = barang::where('id',$id)->first();

        return response()->json($show, 200);
    }

    public function getPengadaan()
    {
        $user = Auth::user();
        $lastMonth = Carbon::now()->subMonth()->isoFormat('MM');
        // print_r($monthGet);
        // die();
        if ($user->hasRole('it')) {
            $show = pengadaan::join('users', 'users.id', '=', 'pengadaan.id_user')->select("pengadaan.*","users.nama")->get();
        } else {
            $show = pengadaan::join('users', 'users.id', '=', 'pengadaan.id_user')->where('pengadaan.id_user',$user->id)->select("pengadaan.*","users.nama")->whereMonth('pengadaan.tgl_pengadaan','>=',$lastMonth)->get();
            // print_r($show);
            // die();
        }
        
        // $show = DB::table('pengadaan')
        //         ->join('users', 'users.id', '=', 'pengadaan.id_user')
        //         ->select('users.nama','pengadaan.*')
        //         ->orderBy('tgl_pengadaan','DESC')
        //         // ->limit('30')
        //         ->get();
        // print_r($show);
        // die();
        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    public function detailPengadaan($id)
    {
        $detail = pengadaan::join('users', 'users.id', '=', 'pengadaan.id_user')->select("pengadaan.*","users.nama")->where('id_pengadaan',$id)->first();
        $show = detail_pengadaan::join('barang', 'barang.id', '=', 'detail_pengadaan.id_barang')->join('ref_barang', 'ref_barang.id', '=', 'barang.ref_barang')->select('detail_pengadaan.*','barang.nama','ref_barang.nama as jenis')->where('id_pengadaan',$id)->orderBy('id','ASC')->get();

        // print_r($show);
        // die();
        $data = [
            'detail' => $detail,
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    public function hapusPengadaan($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        pengadaan::where('id_pengadaan', $id)->delete();
        detail_pengadaan::where('id_pengadaan', $id)->delete();

        return response()->json($tgl, 200);
    }
}

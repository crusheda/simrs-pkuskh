<?php

namespace App\Http\Controllers\publik\pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
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
        $user = Auth::user();
        $id = $user->id;
        $getTgl = pengadaan::select('tgl_pengadaan')->where('id_user',$id)->orderBy('tgl_pengadaan','desc')->first();
        $blnNow = Carbon::now()->isoFormat('MM');
        // print_r(substr($getTgl->tgl_pengadaan,5,2));
        // die();

        if (!empty($getTgl)) {
            if (substr($getTgl->tgl_pengadaan,5,2) != $blnNow) {
                $ref = ref_barang::where('id',$request->ref_barang)->first();
        
                $data = [
                    'ref' => $ref,
                ];
        
                return view('pages.new.pengadaan.tambah-pengadaan')->with('list', $data);
            } else {
                return redirect()->back()->withErrors(["Pada bulan ini anda sudah melakukan Pengadaan","Untuk melakukan pengusulan pengadaan ulang, mohon hapus pengadaan bulan ini terlebih dahulu"]);
            }
        } else {
            $ref = ref_barang::where('id',$request->ref_barang)->first();
    
            $data = [
                'ref' => $ref,
            ];
    
            return view('pages.new.pengadaan.tambah-pengadaan')->with('list', $data);
        }
        
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
        // $lastMonth = Carbon::now()->subMonth(2)->isoFormat('MM');
        // print_r($lastMonth);
        // die();
        if ($user->hasRole('sekretaris-direktur|it')) {
            $show = pengadaan::join('users', 'users.id', '=', 'pengadaan.id_user')->select("pengadaan.*","users.nama")->get();
        } else {
            $show = pengadaan::join('users', 'users.id', '=', 'pengadaan.id_user')->where('pengadaan.id_user',$user->id)->select("pengadaan.*","users.nama")->get();
            // print_r($show);
            // die();
        }
        
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

    public function indexRekap()
    {
        $show = pengadaan::get();
        $ref = ref_barang::get();

        $data = [
            'show' => $show,
            'ref' => $ref,
        ];

        return view('pages.new.pengadaan.rekap')->with('list', $data);
    }

    public function rekapAll(Request $request) // 5-2022
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $bln = Carbon::create()->month($bulan)->isoFormat('MMMM');
        
        $unit = pengadaan::join('users','pengadaan.id_user','=','users.id')
                        ->select('users.id as id_user','users.nama','pengadaan.id_pengadaan','pengadaan.unit','pengadaan.created_at')
                        ->whereYear('pengadaan.tgl_pengadaan', $tahun)
                        ->whereMonth('pengadaan.tgl_pengadaan', $bulan)
                        ->groupBy('users.id','users.nama','pengadaan.id_pengadaan','pengadaan.unit','pengadaan.created_at')
                        ->orderBy('pengadaan.unit','ASC')
                        ->get();

        $barang = detail_pengadaan::join('barang','detail_pengadaan.id_barang','=','barang.id')
                        ->join('pengadaan','detail_pengadaan.id_pengadaan','=','pengadaan.id_pengadaan')
                        ->select('detail_pengadaan.id_barang','barang.nama as nama_barang','detail_pengadaan.satuan as satuan_barang','detail_pengadaan.harga as harga_barang')
                        ->whereYear('pengadaan.tgl_pengadaan', $tahun)
                        ->whereMonth('pengadaan.tgl_pengadaan', $bulan)
                        ->orderBy('barang.nama','ASC')
                        ->groupBy('detail_pengadaan.id_barang','barang.nama','detail_pengadaan.satuan','detail_pengadaan.harga')
                        ->get();

        $total = pengadaan::select('total')
                        ->whereYear('tgl_pengadaan', $tahun)
                        ->whereMonth('tgl_pengadaan', $bulan)
                        ->groupBy('total')
                        ->orderBy('unit','ASC')
                        ->get();

        $data = [
            'bln' => $bln,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'total' => $total,
            'unit' => $unit,
            'barang' => $barang,
        ];

        return view('pages.new.pengadaan.rekapAll')->with('list', $data);
    }

    public function getRekap($bulan,$tahun) // 5-2022
    {
        $unit = pengadaan::join('users','pengadaan.id_user','=','users.id')
                        ->select('users.id as id_user','users.nama','pengadaan.id_pengadaan','pengadaan.unit','pengadaan.created_at')
                        ->whereYear('pengadaan.tgl_pengadaan', $tahun)
                        ->whereMonth('pengadaan.tgl_pengadaan', $bulan)
                        ->groupBy('users.id','users.nama','pengadaan.id_pengadaan','pengadaan.unit','pengadaan.created_at')
                        ->orderBy('pengadaan.unit','ASC')
                        ->get();
                        
        $show = detail_pengadaan::join('barang','detail_pengadaan.id_barang','=','barang.id')
                        ->join('pengadaan','detail_pengadaan.id_pengadaan','=','pengadaan.id_pengadaan')
                        ->select('pengadaan.id_pengadaan','pengadaan.unit','detail_pengadaan.id_barang','detail_pengadaan.jumlah','detail_pengadaan.total')
                        ->whereYear('pengadaan.tgl_pengadaan', $tahun)
                        ->whereMonth('pengadaan.tgl_pengadaan', $bulan)
                        // ->groupBy('pengadaan.unit','detail_pengadaan.id_barang','detail_pengadaan.jumlah','detail_pengadaan.total')
                        ->orderBy('pengadaan.unit','ASC')
                        ->get();

        $barang = detail_pengadaan::join('barang','detail_pengadaan.id_barang','=','barang.id')
                        ->join('pengadaan','detail_pengadaan.id_pengadaan','=','pengadaan.id_pengadaan')
                        ->select('detail_pengadaan.id_barang','barang.nama as nama_barang','detail_pengadaan.satuan as satuan_barang','detail_pengadaan.harga as harga_barang')
                        ->whereYear('pengadaan.tgl_pengadaan', $tahun)
                        ->whereMonth('pengadaan.tgl_pengadaan', $bulan)
                        ->orderBy('barang.nama','ASC')
                        ->groupBy('detail_pengadaan.id_barang','barang.nama','detail_pengadaan.satuan','detail_pengadaan.harga')
                        ->get();

        $data = [
            'show' => $show,
            'unit' => $unit,
            'barang' => $barang,
        ];

        return response()->json($data, 200);
    }

    public function addField($id_barang)
    {
        $show = detail_pengadaan::select('id_pengadaan','jumlah','total')
                    ->where('id_barang', $id_barang)
                    ->get();
        $data = [];
        foreach ($show as $key => $value) {
            array_push($data, [
                'id_pengadaan' => $value->id_pengadaan,
                'jumlah' => $value->jumlah,
                'total' => $value->total,
            ]);
        }
        // print_r($data);
        // die();
        // $data = [
        //     'jumlah' => $show->jumlah,
        //     'total' => $show->total,
        // ];
        return response()->json($data, 200);
    }
}

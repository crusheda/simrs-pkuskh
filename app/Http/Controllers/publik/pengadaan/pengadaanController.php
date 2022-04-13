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
        # code...
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
}

<?php

namespace App\Http\Controllers\administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\regulasi\spo;
use App\Models\regulasi\pedoman;
use App\Models\regulasi\panduan;
use App\Models\regulasi\program;
use App\Models\regulasi\kebijakan;
use App\Models\trans_regulasi;
use App\Models\unit;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;

class regulasiController extends Controller
{
    public function index()
    {
        $unit = unit::orderBy('nama','asc')->get();

        $data = [
            'unit' => $unit,
        ];
        
        return view('pages.administrasi.regulasi')->with('list', $data);
    }

    public function download($id)
    {
        $data1 = kebijakan::where('judul', $id)->first();
        $data2 = pedoman::where('judul', $id)->first();
        $data3 = panduan::where('judul', $id)->first();
        $data4 = program::where('judul', $id)->first();
        $data5 = spo::where('judul', $id)->first();
        
        if (!empty($data1)) {
            $filename = $data1->filename;
            $title = $data1->title;
        }
        if (!empty($data2)) {
            $filename = $data2->filename;
            $title = $data2->title;
        }
        if (!empty($data3)) {
            $filename = $data3->filename;
            $title = $data3->title;
        }
        if (!empty($data4)) {
            $filename = $data4->filename;
            $title = $data4->title;
        }
        if (!empty($data5)) {
            $filename = $data5->filename;
            $title = $data5->title;
        }
        // print_r($data);
        // die();
        return Storage::download($filename, $title);
    }

    // API
    public function cariRegulasi(Request $request)
    {
        $unit = unit::orderBy('nama','asc')->get();
        
        if ($request->regulasi != null) {
            if ($request->waktu != null) {
                $month = Carbon::parse($request->waktu)->isoFormat('MM');
                $year = Carbon::parse($request->waktu)->isoFormat('YYYY');
                if ($request->pembuat != null) {
                    // $show = kebijakan::where('pembuat',$request->pembuat)
                    // $show = DB::table('regulasi_kebijakan')->where('pembuat',$request->pembuat)
                    //                 // ->whereMonth('sah',$month)
                    //                 // ->whereYear('sah',$year)
                    //                 ->orderBy('updated_at','DESC')
                    //                 // ->where('deleted_at', null)
                    //                 ->get();
                    // $query_string = "SELECT * FROM regulasi_kebijakan WHERE MONTH(sah) = $month AND YEAR(sah) = $year AND pembuat = $request->pembuat AND deleted_at IS NULL ORDER BY updated_at DESC";
                    $query_string = "SELECT * FROM trans_regulasi WHERE MONTH(sah) = $month AND YEAR(sah) = $year AND jns_regulasi = $request->regulasi AND pembuat = $request->pembuat AND deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                } else {
                    $query_string = "SELECT * FROM trans_regulasi WHERE MONTH(sah) = $month AND YEAR(sah) = $year AND jns_regulasi = $request->regulasi AND deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                }
            } else {
                if ($request->pembuat != null) {
                    $query_string = "SELECT * FROM trans_regulasi WHERE jns_regulasi = $request->regulasi AND pembuat = $request->pembuat AND deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                } else {
                    $query_string = "SELECT * FROM trans_regulasi WHERE jns_regulasi = $request->regulasi AND deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                }
            }
        } else {
            if ($request->waktu != null) {
                $month = Carbon::parse($request->waktu)->isoFormat('MM');
                $year = Carbon::parse($request->waktu)->isoFormat('YYYY');
                if ($request->pembuat != null) {
                    $query_string = "SELECT * FROM trans_regulasi WHERE MONTH(sah) = $month AND YEAR(sah) = $year AND pembuat = $request->pembuat AND deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                } else {
                    $query_string = "SELECT * FROM trans_regulasi WHERE MONTH(sah) = $month AND YEAR(sah) = $year AND deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                }
            } else {
                if ($request->pembuat != null) {
                    $query_string = "SELECT * FROM trans_regulasi WHERE pembuat = $request->pembuat AND deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                } else {
                    $query_string = "SELECT * FROM trans_regulasi WHERE deleted_at IS NULL ORDER BY updated_at DESC";
                    $show = DB::select($query_string);
                }
            }
        }
        
        $data = [
            'show' => $show,
            'unit' => $unit,
            'count' => count($show),
        ];

        return response()->json($data, 200);
    }
    public function apiTotalRegulasi()
    {
        $totKebijakan   = kebijakan::count();
        $totPedoman     = pedoman::count();
        $totPanduan     = panduan::count();
        $totProgram     = program::count();
        $totSpo         = spo::count();

        $total = $totKebijakan + $totPedoman + $totPanduan + $totProgram + $totSpo;
        // print_r($total);
        // die();

        $data = [
            'total' => $total,
            'totkebijakan' => $totKebijakan,
            'totpedoman' => $totPedoman,
            'totpanduan' => $totPanduan,
            'totprogram' => $totProgram,
            'totspo' => $totSpo,
        ];

        return response()->json($data, 200);
    }
    
    public function autoCompleteRegulasi(Request $request)
    {
    	// if($request->cari){
    	// 	$cari = kebijakan::search($request->cari)->get();	
    	// }else{
    	// 	$cari = kebijakan::get();
    	// }

        // print_r($cari);
        // die();
        

        $getkebijakan = kebijakan::select("judul")
                        ->where("judul","LIKE","%{$request->cari}%")
                        ->groupBy ('judul')
                        ->get();
        $getpedoman = pedoman::select("judul")
                        ->where("judul","LIKE","%{$request->cari}%")
                        ->groupBy ('judul')
                        ->get();
        $getpanduan = panduan::select("judul")
                        ->where("judul","LIKE","%{$request->cari}%")
                        ->groupBy ('judul')
                        ->get();
        $getprogram = program::select("judul")
                        ->where("judul","LIKE","%{$request->cari}%")
                        ->groupBy ('judul')
                        ->get();
        $getspo = spo::select("judul")
                        ->where("judul","LIKE","%{$request->cari}%")
                        ->groupBy ('judul')
                        ->get();
   
        $data = [];
        foreach ($getkebijakan as $item)
        {
            array_push($data, $item->judul);
        }
        foreach ($getpedoman as $item)
        {
            array_push($data, $item->judul);
        }
        foreach ($getpanduan as $item)
        {
            array_push($data, $item->judul);
        }
        foreach ($getprogram as $item)
        {
            array_push($data, $item->judul);
        }
        foreach ($getspo as $item)
        {
            array_push($data, $item->judul);
        }

        return response()->json($data);
    }
}

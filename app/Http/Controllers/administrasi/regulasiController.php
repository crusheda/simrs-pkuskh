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
use App\Models\unit;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;

class regulasiController extends Controller
{
    public function index()
    {
        return view('pages.administrasi.regulasi'); //->with('list', $data)
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

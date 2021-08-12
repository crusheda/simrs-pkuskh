<?php

namespace App\Http\Controllers\kantor;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\laporan_bulanan;
use App\Models\unit;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;
use Response;

class laporanBulananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unit = unit::pluck('id','name','nama');
        $user = Auth::user();
        $name = $user->name;
        $role = $user->roles->first()->name; //kabag-keperawatan

        $thn = Carbon::now()->isoFormat('Y');
        
        if (Auth::user()->hasRole('pelayanan')) {
            $show = laporan_bulanan::all();
        }else {
            $show = laporan_bulanan::where('unit', $role)->get();
        }

        $data = [
            'show' => $show,
            'thn'  => $thn,
            'unit' => $unit,
            'role' => $role
        ];
        return view('pages.kantor.laporan.bulanan')->with('list', $data);
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
        $this->validate($request,[
            'file' => 'required|file|max:100000',
            ]);

        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');     

        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        $path = $uploadedFile->store('public/files/laporan-bulanan/'.$request->unit.'/'.$request->thn.'/'.$request->bln);

        $data = new laporan_bulanan;
        $data->judul = $request->judul;
        $data->bln = $request->bln;
        $data->thn = $request->thn;
        $data->unit = $request->unit;

            $data->title = $request->title ?? $uploadedFile->getClientOriginalName();
            $data->filename = $path;

        $data->ket = $request->ket;

        $data->save();
        return Redirect::back()->with('message','Tambah Laporan Bulanan Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = laporan_bulanan::find($id);
        // return Storage::download($data->filename, $data->title);
        // return Storage::url($data->filename, $data->title);
        // return response()->download(storage_path("app/".$data->filename));
        return response()->file(storage_path("app/".$data->filename));
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
        $data = laporan_bulanan::find($id);
        $data->judul = $request->judul;
        $data->bln = $request->bln;
        $data->thn = $request->thn;
        $data->unit = $request->unit;
        $data->ket = $request->ket;

        $data->save();
        return Redirect::back()->with('message','Perubahan Laporan Bulanan Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = laporan_bulanan::find($id);
        $file = $data->filename;

        Storage::delete($file);
        $data->delete();

        // redirect
        return Redirect::back()->with('message','Hapus Laporan Bulanan Berhasil');
    }

    public function filter(Request $request)
    {
        $getthn = substr(Carbon::now(),0,4);
        $thnsend = Carbon::now()->isoFormat('Y');
        
        if ($request->query('bulan') == 'Bulan') {
            $thn = $request->query('tahun');
            $bln = null;
        } elseif ($request->query('tahun') == 'Tahun') {
            $bln = $request->query('bulan');
            $thn = null;
        } else {
            $bln = $request->query('bulan');
            $thn = $request->query('tahun');
        }
        
        $time= 'Bulan : '.$bln.' Tahun : '.$thn;
        
        if($bln && $thn){
            $query_string = "SELECT * FROM laporan_bulanan WHERE YEAR(updated_at) = $thn AND MONTH(updated_at) = $bln";
            $show = DB::select($query_string);
        }
        elseif($bln && $thn == null){
            $query_string = "SELECT * FROM laporan_bulanan WHERE MONTH(updated_at) = $bln";
            $show = DB::select($query_string);
        }
        elseif($thn && $bln == null){
            $query_string = "SELECT * FROM laporan_bulanan WHERE YEAR(updated_at) = $thn";
            $show = DB::select($query_string);
        }        

        // print_r($show);
        // die();

        $data = [
            'getthn' => $getthn,
            'show' => $show,
            'thn'  => $thnsend,
            'time' => $time
        ];

        return view('pages.kantor.laporan.filter-bulanan')->with('list', $data);
    }
}

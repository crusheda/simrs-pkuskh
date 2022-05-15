<?php

namespace App\Http\Controllers\administrasi\regulasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\regulasi\spo;
use App\Models\unit;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;

class spoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = spo::get();
        $today = Carbon::now()->isoFormat('YYYY/MM/DD');
        $unit = unit::orderBy('nama','asc')->get();

        $data = [
            'show' => $show,
            'unit' => $unit,
            'today' => $today,
        ];
        return view('pages.new.administrasi.regulasi.spo')->with('list', $data);
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
            'file' => ['max:100000','mimes:pdf,docx,doc,xls,xlsx,ppt,pptx,rtf'],
            'judul' => 'required',
            'unit' => 'required',
            'pembuat' => 'required',
        ]);
        
        if ($request->pembuat == 'Pilih') {
            return redirect()->back()->withErrors('Penyimpanan Gagal, mohon pilih Unit Pembuat');
        }

        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');     

        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        $path = $uploadedFile->store('public/files/regulasi/spo');

        $data = new spo;
        $data->id_user = Auth::user()->id;
        $data->sah = $request->sah;
        $data->judul = $request->judul;
        $data->pembuat = $request->pembuat;
        $data->unit = $request->unit;

            $data->title = $request->title ?? $uploadedFile->getClientOriginalName();
            $data->filename = $path;

        $data->save();
        return Redirect::back()->with('message','Tambah Regulasi SPO Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = spo::find($id);
        return Storage::download($data->filename, $data->title);
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
        $this->validate($request,[
            'judul' => 'required',
            'unit' => 'required',
            'pembuat' => 'required',
        ]);

        $data = spo::find($id);
        $data->sah = $request->sah;
        $data->judul = $request->judul;
        $data->pembuat = $request->pembuat;
        $data->unit = $request->unit;

        $data->save();
        return Redirect::back()->with('message','Perubahan Regulasi SPO Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = spo::find($id);
        $file = $data->filename;

        Storage::delete($file);
        $data->delete();

        // redirect
        return Redirect::back()->with('message','Hapus Regulasi SPO Berhasil');
    }
    
    public function apiGet()
    {
        $show = spo::join('unit','unit.id','=','regulasi_spo.pembuat')->select('unit.nama as nama_unit','regulasi_spo.*')->get();
        $unit = unit::orderBy('nama','asc')->get();

        $data = [
            'show' => $show,
            'unit' => $unit,
        ];

        return response()->json($data, 200);
    }
    
    public function getubah($id)
    {
        $show = spo::join('users','users.id','=','regulasi_spo.id_user')->join('unit','unit.id','=','regulasi_spo.pembuat')->select('users.nama','unit.nama as nama_unit','regulasi_spo.*')->where('regulasi_spo.id', $id)->first();
        // print_r($show);
        // die();
        $unit = unit::orderBy('nama','asc')->get();

        $sizeFile = number_format(Storage::size($show->filename) / 1048576,2);

        $data = [
            'id' => $id,
            'show' => $show,
            'unit' => $unit,
            'sizeFile' => $sizeFile,
        ];

        return response()->json($data, 200);
    }
    
    public function ubah(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = spo::find($request->id);
        $data->sah = $request->sah;
        $data->judul = $request->judul;
        $data->pembuat = $request->pembuat;
        $data->unit = $request->unit;
        $data->save();
        
        return response()->json($tgl, 200);
    }
    
    public function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        spo::where('id', $id)->delete();

        return response()->json($tgl, 200);
    }
}

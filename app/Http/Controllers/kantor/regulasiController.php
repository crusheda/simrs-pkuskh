<?php

namespace App\Http\Controllers\kantor;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\regulasi;
use App\Models\unit;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;

class regulasiController extends Controller
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
        
        if (Auth::user()->hasRole('kantor')) {
            $show = regulasi::all();
        }else {
            $show = regulasi::where('unit', $role)->get();
        }

        $data = [
            'show' => $show,
            'thn'  => $thn,
            'unit' => $unit
        ];
        return view('pages.kantor.regulasi')->with('list', $data);
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
        if ($request->jenis == 'SPO') {
            $path = $uploadedFile->store('public/files/regulasi/spo');
        } elseif ($request->jenis == 'PEDOMAN') {
            $path = $uploadedFile->store('public/files/regulasi/pedoman');
        } elseif ($request->jenis == 'PANDUAN') {
            $path = $uploadedFile->store('public/files/regulasi/panduan');
        } elseif ($request->jenis == 'KEBIJAKAN') {
            $path = $uploadedFile->store('public/files/regulasi/kebijakan');
        } elseif ($request->jenis == 'PROGRAM') {
            $path = $uploadedFile->store('public/files/regulasi/program');
        }

        $data = new regulasi;
        $data->sah = $request->sah;
        $data->judul = $request->judul;
        $data->jenis = $request->jenis;
        $data->unit = $request->unit;

            $data->title = $request->title ?? $uploadedFile->getClientOriginalName();
            $data->filename = $path;

        $data->ket = $request->ket;

        $data->save();
        return Redirect::back()->with('message','Tambah Regulasi Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = regulasi::find($id);
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
        $data = regulasi::find($id);
        $data->sah = $request->sah;
        $data->judul = $request->judul;
        $data->jenis = $request->jenis;
        $data->unit = $request->unit;
        $data->ket = $request->ket;

        $data->save();
        return Redirect::back()->with('message','Perubahan Regulasi Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = regulasi::find($id);
        $file = $data->filename;

        Storage::delete($file);
        $data->delete();

        // redirect
        return Redirect::back()->with('message','Hapus Regulasi Berhasil');
    }
}

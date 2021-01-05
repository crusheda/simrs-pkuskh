<?php

namespace App\Http\Controllers\it\log;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\logit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Storage;
use Auth;
use \PDF;
use Image;

class logController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = logit::get();

        $data = [
            'show' => $show
        ];

        return view('pages.it.log.index')->with('list', $data);
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
            'nama' => 'required',
            'kegiatan' => 'required',
            'keterangan' => 'nullable',
            'lokasi' => 'nullable',
            'title' => 'nullable',
            'file' => 'nullable|file|max:1000000',
            ]);

        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');     
        // print_r($uploadedFile);
        // die();
        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        if ($uploadedFile == '') {
            $path = '';
            $title = '';
        }else {
            $path = $uploadedFile->store('public/files/it/log');
            $title = $request->title ?? $uploadedFile->getClientOriginalName();
        }
        // print_r($request->lokasi);
        // die();

        $data = new logit;
        $data->nama = $request->nama;
        $data->kegiatan = $request->kegiatan;
        
            $data->title = $title;
            
            $data->filename = $path;
        if ($request->keterangan == '') {
            $data->keterangan = '';
            if ($request->lokasi == '') {
                $data->lokasi = '';
            }else {
                $data->lokasi = $request->lokasi;
            }
        }elseif ($request->lokasi == '') {
            $data->lokasi = '';
            if ($request->keterangan == '') {
                $data->keterangan = '';
            }else {
                $data->keterangan = $request->keterangan;
            }
        }else {
            $data->lokasi = $request->lokasi;
            $data->keterangan = $request->keterangan;
        }

        $data->save();
        return redirect('/it/supervisi')->with('message','Tambah Kegiatan Supervisi Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = logit::find($id);
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
        $data = logit::find($id);
        // return view('pages.it.log.index')->with('list', $data);
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
            'kegiatan' => 'required',
            'lokasi' => 'nullable',
            'keterangan' => 'nullable',
            ]);
        $data = logit::find($id);
        $data->kegiatan = $request->kegiatan;

        if ($request->keterangan == '') {
            $data->keterangan = '';
            if ($request->lokasi == '') {
                $data->lokasi = '';
            }else {
                $data->lokasi = $request->lokasi;
            }
        }elseif ($request->lokasi == '') {
            $data->lokasi = '';
            if ($request->keterangan == '') {
                $data->keterangan = '';
            }else {
                $data->keterangan = $request->keterangan;
            }
        }else {
            $data->lokasi = $request->lokasi;
            $data->keterangan = $request->keterangan;
        }

        $data->save();
        return redirect('/it/supervisi')->with('message','Perubahan Kegiatan Supervisi Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = logit::find($id);
        $delete_file = $data->filename;
        Storage::delete($delete_file);
        $data->delete();

        // redirect
        return \Redirect::to('/it/supervisi')->with('message','Hapus Kegiatan Supervisi Berhasil');
    }

    public function showGambar($id)
    {
        return Image::make(storage_path() . '/it/log/' . $id )->response();
        print_r($id);
        die();
    }
}

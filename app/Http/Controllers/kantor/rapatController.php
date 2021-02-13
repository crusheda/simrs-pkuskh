<?php

namespace App\Http\Controllers\kantor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use App\Models\rapat;
use Illuminate\Http\RedirectResponse;

class rapatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = rapat::all();
        // $total = karyawan::count();
        // $show = rapat::orderBy('created_at', 'DESC')->paginate(30);

        $data = [
            // 'count' => $total,
            'show' => $show
        ];
        return view('pages.kantor.rapat')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.kantor.tambah-berkas');
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
            'keterangan' => 'nullable',
            'title1' => 'nullable',
            'title2' => 'nullable',
            'title3' => 'nullable',
            'title4' => 'nullable',
            'file1' => 'required|file|max:100000',
            'file2' => 'required|file|max:100000',
            'file3' => 'required|file|max:100000',
            'file4' => 'required|file|max:100000',
            'file5' => 'required|file|max:100000',
            ]);

        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile1 = $request->file('file1');
        $uploadedFile2 = $request->file('file2');
        $uploadedFile3 = $request->file('file3');
        $uploadedFile4 = $request->file('file4');        
        $uploadedFile5 = $request->file('file5');        

        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        $path1 = $uploadedFile1->store('public/files/notulen/undangan');
        $path2 = $uploadedFile2->store('public/files/notulen/materi');
        $path3 = $uploadedFile3->store('public/files/notulen/absensi');
        $path4 = $uploadedFile4->store('public/files/notulen/notulen');
        $path5 = $uploadedFile5->store('public/files/notulen/dokumentasi');

        $data = new rapat;
        $data->nama = $request->nama;
        $data->kepala = $request->kepala;
        $data->tanggal = $request->tanggal;
        $data->lokasi = $request->lokasi;

            $data->title1 = $request->title1 ?? $uploadedFile1->getClientOriginalName();
            $data->title2 = $request->title2 ?? $uploadedFile2->getClientOriginalName();
            $data->title3 = $request->title3 ?? $uploadedFile3->getClientOriginalName();
            $data->title4 = $request->title4 ?? $uploadedFile4->getClientOriginalName();
            $data->title5 = $request->title5 ?? $uploadedFile5->getClientOriginalName();
            
            $data->filename1 = $path1;
            $data->filename2 = $path2;
            $data->filename3 = $path3;
            $data->filename4 = $path4;
            $data->filename5 = $path5;

        $data->keterangan = $request->keterangan;

        $data->save();
        return redirect('/rapat')->with('message','Tambah Notulen Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = rapat::find($id);
        return Storage::download($data->filename1, $data->title1);
    }

    public function show2($id)
    {
        $data = rapat::find($id);
        return Storage::download($data->filename2, $data->title2);
    }

    public function show3($id)
    {
        $data = rapat::find($id);
        return Storage::download($data->filename3, $data->title3);
    }

    public function show4($id)
    {
        $data = rapat::find($id);
        return Storage::download($data->filename4, $data->title4);
    }

    public function show5($id)
    {
        $data = rapat::find($id);
        return Storage::download($data->filename5, $data->title5);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = rapat::find($id);
        return view('pages.kantor.edit-notulen')->with('list', $data);
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
            'nama' => 'required',
            'kepala' => 'nullable',
            'tanggal' => 'nullable',
            'lokasi' => 'nullable',
            'keterangan' => 'nullable',
            ]);
        $data = rapat::find($id);
        $data->nama = $request->nama;
        $data->kepala = $request->kepala;
        $data->tanggal = $request->tanggal;
        $data->lokasi = $request->lokasi;
        $data->keterangan = $request->keterangan;

        $data->save();
        return redirect('/rapat')->with('message','Perubahan Notulen Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = rapat::find($id);
        $data->delete();

        // redirect
        return \Redirect::to('/rapat')->with('message','Hapus Notulen Rapat Berhasil');
    }

    public function download(Request $id)
    {
        $data = rapat::find($id);
        $data->filename = $filename;
        $path = storage_path($filename);

        return response()->file($pathToFile, $headers);
    }

    public function apifile()
    {
        $show = rapat::all();
        // $total = karyawan::count();
        // $show = rapat::orderBy('created_at', 'DESC')->paginate(30);

        $data = [
            // 'count' => $total,
            'show' => $show
        ];

        return response()->json($show, 200);
    }
}

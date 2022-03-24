<?php

namespace App\Http\Controllers\kantor;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\regulasi;
use App\Models\regulasi_note;
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
        $user = Auth::user();
        $name = $user->name;
        // $role = $user->roles->first()->name; //kabag-keperawatan
        $unit = $user->roles; //kabag-keperawatan

        $today = Carbon::now()->isoFormat('YYYY/MM/DD');
        
        $users = DB::table('users')
                ->get();

        foreach ($unit as $key => $value) {
            $role[] = $value->name;
        }

        $thn = Carbon::now()->isoFormat('Y');
        
        $show = regulasi::all();
        $note = regulasi_note::orderBy('updated_at','DESC')->get();
        // $show = DB::table('regulasi')
        //     ->join('regulasi_note', 'regulasi.id', '=', 'regulasi_note.id_regulasi')
        //     ->where('regulasi.deleted_at', null)
        //     // ->select('regulasi.*','regulasi_note.id_regulasi','regulasi_note.note','regulasi_note.updated_at')
        //     ->get();

        $data = [
            'user' => $users,
            'show' => $show,
            'note' => $note,
            'thn'  => $thn,
            'today' => $today,
            'role' => $role
        ];
        return view('pages.new.administrasi.regulasi')->with('list', $data);
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
            ]);

        $user = Auth::user();
        $id_user = $user->id;
        $unit = $user->roles; //kabag-keperawatan

        foreach ($unit as $key => $value) {
            $role[] = $value->name;
        }

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
        $data->id_user = $id_user;
        $data->sah = $request->sah;
        $data->judul = $request->judul;
        $data->jenis = $request->jenis;
        $data->unit = json_encode($role);

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

    public function addNote(Request $request, $id)
    {
        $user = Auth::user();
        $id_user = $user->id;

        $data = new regulasi_note;
        $data->id_regulasi = $id;
        $data->id_user = $id_user;
        $data->note = $request->note;
        $data->save();

        return Redirect::back()->with('message','Tambah Catatan Regulasi Berhasil');
    }
}

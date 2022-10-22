<?php

namespace App\Http\Controllers\administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\perencanaan\rka;
use Carbon\Carbon;
use Redirect;
use Storage;
use Response;
use Auth;

class rkaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = rka::get();
        $user = Auth::user();
        $nama = $user->nama;

        $users = DB::table('users')->get();

        $data = [
            'show' => $show,
        ];

        return view('pages.administrasi.rka')->with('list', $data);
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
        $request->validate([
            'file' => ['mimes:xls,xlsx,pdf','max:50000'],
        ]);

        $now = Carbon::now();
        $verifikasi = rka::get();
        $tahun = Carbon::now()->isoFormat('YYYY');
        $tgl = $now->isoFormat('dddd, D MMMM Y, HH:mm:ss a');
        // print_r($now);
        // die();

        $uploadedFile = $request->file('file');

        $title = $uploadedFile->getClientOriginalName();
        foreach ($verifikasi as $key => $value) {
            if ($value->title == $title) {
                return redirect()->back()->withErrors('File yang Anda Upload sudah Ada, mohon Rename file dan silakan Upload ulang.');
                // return response()->json($value->title, 500);
            }
        }
        $path = $uploadedFile->storeAs("public/files/rka/", $title);

        $user = Auth::user();
        $id_user = $user->id;
        $nama = $user->nama;
        $role = $user->roles;

        foreach ($role as $key => $value) {
            $unit[] = $value->name;
        }

        $data = new rka;
        $data->id_user = $id_user;
        $data->nama = $nama;
        $data->tahun = $tahun;
        $data->unit = json_encode($unit);
        $data->tgl = $now;
        $data->title = $title;
        $data->filename = $path;
        $data->save();

        return redirect()->back()->with('message','Upload Berkas Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = rka::find($id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function table()
    {
        $data = rka::leftJoin('foto_profil', 'foto_profil.user_id', '=', 'rka.id_user')
            ->join('users', 'users.id', '=', 'rka.id_user')
            ->select('foto_profil.filename as foto_profil', 'users.nama as nama_profil', 'rka.*')
            ->orderBy('rka.tgl', 'desc')
            ->get();
            // [
            //     'foto_profil.filename as foto_profil',
            //     'users.nama',
            //     'rka.id',
            //     'rka.unit',
            //     'rka.nama',
            //     'rka.tahun',
            //     'rka.title',
            //     'rka.updated_at',
            // ]

        return response()->json($data, 200);
    }

    public function upload(Request $request)
    {
        $now = Carbon::now();
        $verifikasi = rka::get();
        $tahun = Carbon::now()->isoFormat('YYYY');
        $tgl = $now->isoFormat('dddd, D MMMM Y, HH:mm:ss a');
        // print_r($now);
        // die();

        $uploadedFile = $request->file('fileToUpload');

        $title = $uploadedFile->getClientOriginalName();
        foreach ($verifikasi as $key => $value) {
            if ($value->title == $title) {
                return response()->json($value->title, 500);
            }
        }
        $path = $uploadedFile->storeAs("public/files/perencanaan/rka/", $title);

        $user = Auth::user();
        $id_user = $user->id;
        $nama = $user->nama;
        $role = $user->roles;

        foreach ($role as $key => $value) {
            $unit[] = $value->name;
        }

        $data = new rka;
        $data->id_user = $id_user;
        $data->nama = $nama;
        $data->tahun = $tahun;
        $data->unit = json_encode($unit);
        $data->tgl = $now;
        $data->title = $title;
        $data->filename = $path;
        $data->save();

        return response()->json($tgl, 200);
    }

    public function fileupload(Request $request)
    {
        $tahun = Carbon::now()->isoFormat('YYYY');
        $image = $request->file('file');
        // dd($image);
        $fileInfo = $image->getClientOriginalName();
        $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        $file_name= $filename.'-'.time().'.'.$extension;
        $image->move(public_path('gallery'),$file_name);
            
        // $imageUpload = new Gallery;
        // $imageUpload->original_filename = $fileInfo;
        // $imageUpload->filename = $file_name;
        // $imageUpload->save();
        return response()->json(['success'=>$file_name]);
        // print_r()

        // if ($request->hasFile('file')) {

        //     // Upload path
        //     $destinationPath = 'public/files/rka/'.$tahun.'/';

        //     // Get file extension
        //     $extension = $request->file('file')->getClientOriginalExtension();

        //     // Valid extensions
        //     $validextensions = array("xls", "xlsx", "pdf");

        //     // Check extension
        //     if (in_array(strtolower($extension), $validextensions)) {

        //         // Rename file 
        //         $fileName = $request->file('file')->getClientOriginalName() . time() . '.' . $extension;
        //         // Uploading file to given path
        //         $request->file('file')->move($destinationPath, $fileName);
        //     }
        // }
        return view('pages.profil.index');
    }

    public function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        $now = Carbon::now();

        $data = rka::where('id', $id)->first();
        $file = $data->filename;

        Storage::delete($file);
        $data->delete();

        return response()->json($tgl, 200);
    }
}

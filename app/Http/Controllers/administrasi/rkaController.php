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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $data = rka::orderBy('tgl','desc')->get();

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
    
    public function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        $now = Carbon::now();

        rka::where('id', $id)->delete();

        return response()->json($tgl, 200);
    }
}

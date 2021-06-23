<?php

namespace App\Http\Controllers\kantor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\unit;
use App\Models\karyawan;
use App\Models\user;
use App\Models\foto_profil;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;
use \PDF;

class kepegawaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user();
        $name = $auth->name;
        $role = $auth->roles->first()->name; //kabag-keperawatan

        $show = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('foto_profil', 'foto_profil.user_id', '=', 'users.id')
            ->select('roles.name as nama_role','foto_profil.title as title','foto_profil.filename as filename','users.*')
            ->get();
        
        // print_r($show);
        // die();

        $data = [
            'show' => $show
        ];
        return view('pages.kantor.kepegawaian.karyawan')->with('list', $data);
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
        $id = $request->id;

        $data = user::find($id);
        $data->nip = $request->nip;
        $data->jabatan = $request->jabatan;
        $data->masuk_kerja = $request->masuk_kerja;
        $data->no_str = $request->no_str;
        $data->masa_str = $request->masa_str;
        $data->masa_sip = $request->masa_sip;
        // $data->pengalaman_kerja = $request->pengalaman_kerja;
        
        $data->save();

        return Redirect::back()->with('message','Dokumen Kepegawaian ID: '.$id.' Berhasil Di Update');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->join('foto_profil', 'foto_profil.user_id', '=', 'users.id')
                ->select('roles.name as nama_role','foto_profil.title as title','foto_profil.filename as filename','users.*')
                ->where('users.id','=',$id)
                ->get();
        
        $data = [
            'show' => $show,
        ];

        return view('pages.kantor.kepegawaian.detail-karyawan')->with('list', $data);
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

    public function generatePDF($id)
    {
        # code...
        $now = Carbon::now()->isoFormat('D MMM YYYY');
        $getUser = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('foto_profil', 'foto_profil.user_id', '=', 'users.id')
            ->select('roles.name as nama_role','foto_profil.title as title','foto_profil.filename as filename','users.*')
            ->where('users.id','=',$id)
            ->get();

        $filename = '('.strtoupper($getUser[0]->nama_role).') '.$getUser[0]->nama.' - '.$now.'.PDF';
        // print_r($filename);
        // die();

        $data = [
            'now' => $now,
            'user' => $getUser,
        ];
        // $foto = storage_path().'/app/'.$getUser[0]->filename;
        // print_r($foto);
        // die();

        // print_r($yest2);
        // die();

        $pdf = PDF::loadView('pages.kantor.kepegawaian.cetak-karyawan', $data);
        // return $pdf->download();
        return $pdf->stream($filename);
    }
}

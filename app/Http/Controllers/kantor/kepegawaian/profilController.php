<?php

namespace App\Http\Controllers\kantor\kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class profilController extends Controller
{
    public function showProfil($id)
    {
        $show = DB::table('users')
                ->join('data_users','data_users.user_id','=','users.id')
                ->join('foto_profil','foto_profil.user_id','=','users.id')
                ->where('users.id', '=', $id)
                ->select('data_users.nama as data_nama','foto_profil.title','foto_profil.filename','users.*')
                ->first();    
        
        $showlog = logs::where('user_id', $id)->where('log_type', '=', 'login')->select('log_date')->orderBy('log_date', 'DESC')->get();
        
        $data = [
            'id_user' => $id,
            'showlog' => $showlog,
            'show' => $show,
        ];

        return view('pages.new.kantor.kepegawaian.profil-karyawan')->with('list', $data);
    }
}

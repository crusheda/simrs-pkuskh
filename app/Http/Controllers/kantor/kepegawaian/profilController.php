<?php

namespace App\Http\Controllers\kantor\kepegawaian;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\logs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Storage;
use Exception;
use Redirect;

class profilController extends Controller
{
    public function showProfil($id)
    {
        $show = DB::table('users')
                ->where('users.id', $id)
                ->first();  
        
        $foto = DB::table('foto_profil')
            ->where('user_id', '=', $id)
            // ->get()
            ->first();    
        
        $showlog = logs::where('user_id', $id)->where('log_type', '=', 'login')->select('log_date')->orderBy('log_date', 'DESC')->get();
        // print_r($foto);
        // die();
        $data = [
            'id_user' => $id,
            'showlog' => $showlog,
            'show' => $show,
            'foto' => $foto,
        ];

        return view('pages.new.kepegawaian.profil-karyawan')->with('list', $data);
    }
}

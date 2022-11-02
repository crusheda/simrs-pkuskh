<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use App\Models\tdkperawat;
use App\Models\user;
use App\Models\logs;
use Carbon\Carbon;
use AamDsam\Bpjs\VClaim;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $name = $user->name;
        $role = $user->roles->first()->name;
        $id = $user->id;

        $user = user::where('id',$id)->first();

        // LOG PERAWAT
        // if (Auth::user()->hasRole('kabag-keperawatan')) {
        //     $recentLogPerawat = '1';
        // }
        // else {
        //     if (auth()->user()->can('log_perawat')) {
            
        //         $query = tdkperawat::where('unit', $role)->where('name', $name)->where('deleted_at','=', null)->orderBy('id', 'DESC')->first();
        //         if ($query == null) {
        //             $recentLogPerawat = 1;
        //         } else {
        //             $convert_query = Carbon::parse($query->tgl)->isoFormat('D MMMM Y');
        //             $convert_now = Carbon::now()->isoFormat('D MMMM Y'); // sesuai tgl kalender di PC
        //             if ($convert_now == $convert_query) {
        //                 $recentLogPerawat = 0;
        //             } else {
        //                 $recentLogPerawat = 1;
        //             }
        //         }
                
        //     } else {
        //         $recentLogPerawat = 2;
        //     }
        // }

        $data = [
            'user' => $user,
            // 'recentLogPerawat' => $recentLogPerawat,
        ];

        // return view('pages.index')->with('list', $data);
    }

    public function newIndex()
    {
        $user = Auth::user();
        $name = $user->name;
        $role = $user->roles->first()->name;
        $id = $user->id;
        
        $foto = DB::table('foto_profil')
                ->where('user_id', '=', $id)
                // ->get()
                ->first();  
                
        $showlog = logs::where('user_id', $id)->where('log_type', '=', 'login')->select('log_date')->orderBy('log_date', 'DESC')->get();

        $referensi = new VClaim\Peserta($this->vclaim_conf());
        // print_r($referensi);
        // die();
        
        $data = [
            'user' => $user,
            'foto' => $foto,
            'showlog' => $showlog,
            // 'referensi' => $referensi->propinsi(),
        ];

        return view('pages.new.dashboard')->with('list', $data);
    }

    public function fileManager()
    {
        return view('pages.new.administrasi.filemanajer');
    }

    function vclaim_conf(){
        $config = [
            'koders' => env('BPJS_KODERS'),
            'cons_id' => env('BPJS_CONSID'),
            'secret_key' => env('BPJS_SCREET_KEY'),
            'base_url' => env('BPJS_BASE_URL'),
            'service_name' => env('BPJS_SERVICE_NAME'),
        ];
        return $config;
    }
}

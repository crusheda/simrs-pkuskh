<?php

namespace App\Http\Controllers\qrcode;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\absensi;
use App\Models\user;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class ScannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = absensi::where('deleted_at', null)->orderBy('updated_at','DESC')->limit('50')->get(); // Ambil Data Absen Terakhir
        $date = Carbon::now()->isoFormat('YYYY/MM/DD HH:MM:SS'); // 2021/08/04 01:57:45
        
        $data = [
            'show' => $show,
            'date' => $date,
        ];
        return view('pages.qrcode.scanner')->with('list', $data);
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
    
    public function simpan(Request $request)
    {
        $qrcode = Crypt::decryptString($request->qrcode);
        // $user = DB::table('users')
        //         ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        //         ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        //         ->select('roles.name as nama_role','users.*')
        //         ->where('users.status',null)
        //         ->get();
        $user = user::where('status', null)->where('id',$qrcode)->first();
        $nama = $user->nama;
        
        $getAbsen = absensi::where('deleted_at', null)->where('id_user', $qrcode)->orderBy('updated_at', 'DESC')->first(); // Ambil Data Absen Terakhir
        $countAbsen = absensi::where('deleted_at', null)->where('id_user', $qrcode)->get(); // Ambil Data Absen Terakhir
        if (count($countAbsen) > 0) {
            $carbon = Carbon::now();
            $tglCarbon = Carbon::now()->isoFormat('YYYY-MM-DD'); // 2021-07-23
            $tglMasuk = Carbon::parse($getAbsen->tgl_masuk)->isoFormat('YYYY-MM-DD');
            // AND = BENAR SALAH -> SALAH
            // OR BENAR SALAH -> BENAR
            if ($getAbsen->tgl_masuk != null) {
                if ($getAbsen->tgl_pulang != null) {
                    $carbonNOW = Carbon::now()->isoFormat('HH');
                    $tglPulang5Hour = Carbon::parse($getAbsen->tgl_pulang)->addHours(5)->isoFormat('HH');
                    if ($tglPulang5Hour < $carbonNOW) {
                        $data = new absensi;
                        $data->id_user = $qrcode;
                        $data->nama = $nama;
                        $data->qrcode = $qrcode;
                        $data->tgl_masuk = Carbon::now();
                        $data->save();  
    
                        $icon = 'success';
                        $message = 'Anda Berhasil Absen Masuk';
                    } else {
                        $icon = 'error';
                        $message = 'Maaf, Anda Belum Waktunya Absen Masuk';
                    }
                } else {
                    if ($tglCarbon != $tglMasuk) {
                        $carbon12hour = Carbon::now()->subHours(12)->isoFormat('HH');
                        $tglMasukHour = Carbon::parse($getAbsen->tgl_masuk)->isoFormat('HH');
                        if ($tglMasukHour > $carbon12hour) {
                            $data = absensi::find($getAbsen->id);
                            $data->tgl_pulang = Carbon::now();
                            $data->save();

                            $icon = 'success';
                            $message = 'Anda Berhasil Absen Pulang Lepas Malam';
                        } else {
                            $data = new absensi;
                            $data->id_user = $qrcode;
                            $data->nama = $nama;
                            $data->qrcode = $qrcode;
                            $data->tgl_masuk = Carbon::now();
                            $data->save();   
                            
                            $icon = 'success';
                            $message = 'Anda Berhasil Absen Masuk Tanpa Absen Pulang Sebelumnya'; 
                        }
                    } else {
                        $carbonhour = Carbon::now()->isoFormat('HH');
                        $tglMasuk7Hour = Carbon::parse($getAbsen->tgl_masuk)->addHours(7)->isoFormat('HH');
                        if ($carbonhour > $tglMasuk7Hour) {
                            $data = absensi::find($getAbsen->id);
                            $data->tgl_pulang = Carbon::now();
                            $data->save();
        
                            $icon = 'success';
                            $message = 'Anda Berhasil Absen Pulang Kerja';
                        } else {
                            $icon = 'error';
                            $message = 'Maaf, anda belum waktunya Pulang Kerja';
                        }
                    }
                }
            } else {
                $icon = 'error';
                $message = 'Maaf, ada yang salah dengan Sistem. Silakan Hubungi IT';
            }
        } else {
            $data = new absensi;
            $data->id_user = $qrcode;
            $data->nama = $nama;
            $data->qrcode = $qrcode;
            $data->tgl_masuk = Carbon::now();
            $data->save();
            
            $icon = 'success';
            $message = 'Anda Berhasil Absen Masuk Untuk Yang Pertama Kalinya';
        }

        return response()->json(
            [
                'success' => true,
                'title' => 'Hai, '.$nama,
                'icon' => $icon,
                'message' => $message
            ]
        );
    }

    public function apiAbsensi()
    {
        $data = absensi::where('deleted_at', null)->get(); // Ambil Data Absen Terakhir
        return response()->json($data, 200);
    }
}

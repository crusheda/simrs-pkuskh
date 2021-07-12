<?php

namespace App\Http\Controllers\queue\informasi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use App\Models\queue_poli;
use App\Models\set_queue_poli;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Redirect;

class queuePoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $day = Carbon::now()->isoFormat('D MMMM Y');

        $user = Auth::user();
        $id    = $user->id;
        $name = $user->name;
        $role = $user->roles->first()->name; //kabag-keperawatan
        
        $show = queue_poli::orderBy('id', 'DESC')->get();
        $poli = set_queue_poli::select('id','kode_queue','nama_queue')->where('aktif', true)->get();

        $tgl = Carbon::now()->isoFormat('D');
        $bln = Carbon::now()->isoFormat('MM');
        $thn = Carbon::now()->isoFormat('Y');
        $date = Carbon::now()->isoFormat('YYYY-MM-D');
        $getAntrian = "SELECT qp.kode_queue,sqp.nama_queue,COUNT(qp.kode_queue) as jumlah FROM queue_poli qp
                JOIN set_queue_poli sqp ON qp.kode_queue = sqp.id
                WHERE qp.deleted_at is null
                AND YEAR(qp.tgl_queue) = $thn 
                AND MONTH(qp.tgl_queue) = $bln 
                AND DAY(qp.tgl_queue) = $tgl 
                GROUP BY qp.kode_queue,sqp.nama_queue,qp.kode_queue";
        // $demo = "SELECT CONVERT(VARCHAR(10), tgl_queue, 23) from queue_poli";
        // $showdemo = DB::select($demo);

        $antrian = DB::select($getAntrian);
         
        $data = [
            'now' => $now,
            'day' => $day,
            'show' => $show,
            'poli' => $poli,
            'antrian' => $antrian,
        ];

        return view('pages.queue.informasi.index')->with('list', $data);
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
        $getTgl = Carbon::parse($request->tgl_queue)->isoFormat('D/MM/Y');
        $getadd0 = Carbon::now()->addDays(0)->isoFormat('D/MM/Y');
        $getadd1 = Carbon::now()->addDays(1)->isoFormat('D/MM/Y');
        $getadd2 = Carbon::now()->addDays(2)->isoFormat('D/MM/Y');
        $getadd3 = Carbon::now()->addDays(3)->isoFormat('D/MM/Y');
        $getadd4 = Carbon::now()->addDays(4)->isoFormat('D/MM/Y');
        $getadd5 = Carbon::now()->addDays(5)->isoFormat('D/MM/Y');

        if ($getTgl == $getadd0 || $getTgl == $getadd1 || $getTgl == $getadd2 || $getTgl == $getadd3 || $getTgl == $getadd4 || $getTgl == $getadd5) {
            $tglDaftar = $request->tgl_queue;
        } else {
            return Redirect::back()->withErrors('Tanggal Tidak Valid, mohon masukkan Tanggal Daftar Pasien Maksimal 5 Hari Ke depan');
        }
        
        // print_r($hasil);
        // die();

        $getQueue = set_queue_poli::find($request->kode_queue);
        $now = Carbon::now();
        // $getLast = queue_poli::select('queue')->orderBy('queue', 'DESC')->first();
        $getLast = queue_poli::where('kode_queue', $request->kode_queue)->where('deleted_at','=', null)->where('inden','=', false)->orderBy('id', 'DESC')->first();
        $getLastTglInden = queue_poli::select('tgl_queue')->where('kode_queue', $request->kode_queue)->where('deleted_at','=', null)->where('inden','=', true)->where('tgl_queue','=', $request->tgl_queue)->orderBy('id', 'DESC')->first();
        $getLastInden = queue_poli::where('kode_queue', $request->kode_queue)->where('deleted_at','=', null)->where('inden','=', true)->where('tgl_queue','=', $request->tgl_queue)->orderBy('id', 'DESC')->first();
        if ($request->inden == true) {
            if ($getLastInden == null) {
                $plus = 1;
                $done = sprintf("%03d", $plus);
            }else {
                $convert_query = Carbon::parse($getLastInden->tgl_queue)->isoFormat('D MMMM Y');
                $convert_now = Carbon::now()->isoFormat('D MMMM Y');
                $proses = (int)substr($getLastInden->queue,1);
                $plus = $proses + 1;
                $done = sprintf("%03d", $plus);
                // print_r($getLastInden);
                // die();
            }
            $sttInden = true;
            // $tglDaftar = $request->tgl_queue;
            // $tglDaftarCarbon = Carbon::parse($tglDaftar)->isoFormat('d');
            // 0 = minggu
            // 3 = Rabu
            // 6 = Sabtu
            // $tglnow = $now->toDateString();
            // $tglInput = Carbon::parse($tglDaftar->toDateString());
            // $getTgl = $tglInput - $now;
        }else {
            if ($getLast == null) {
                $plus = 1;
                $done = sprintf("%03d", $plus);
            } else {
                $convert_query = Carbon::parse($getLast->tgl_queue)->isoFormat('D MMMM Y');
                $convert_now = Carbon::now()->isoFormat('D MMMM Y');
                
                if ($convert_query == $convert_now) {
        
                    $proses = (int)substr($getLast->queue,1);
                    $plus = $proses + 1;
                    $done = sprintf("%03d", $plus);
                    // print_r($done);
                    // die();
                } else {
                    $plus = 1;
                    $done = sprintf("%03d", $plus);
                }
            }
            $sttInden = false;
            $tglDaftar = $now;
        }
        
        $data = new queue_poli;
        $data->no_rm = $request->no_rm;
        $data->nama = $request->nama;
        $data->no_ktp = $request->NO_KTP;
        $data->no_hp = $request->TELPON_HP;
        $data->ref_desa = $request->REF_DESA;
        $data->alamat = $request->ALAMAT;
        $data->pekerjaan = $request->REF_PEKERJAAN;
        $data->umur = $request->UMUR;
        $data->kode_queue = $request->kode_queue;
        $data->queue = $getQueue->kode_queue.$done;
        $data->inden = $sttInden;
        $data->tgl_queue = $tglDaftar;

        // print_r($getTgl);
        // die();
        $data->save();
    
        return Redirect::back()->with('message','Data berhasil ditambahkan.');
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
        $getQueue = set_queue_poli::find($request->kode_queue);

        $data = queue_poli::find($id);
        $data->tgl_queue = $request->tgl_queue;
        $data->queue = $getQueue->kode_queue . substr($data->queue,1,10);
        $data->kode_queue = $request->kode_queue;
        $data->save();

        return Redirect::back()->with('message','Ubah Data Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = queue_poli::where('id', $id)->delete();

        return Redirect::back()->with('message','Hapus Data Berhasil.');
    }

    public function apiStatusAntrian()
    {
        $tgl = Carbon::now()->isoFormat('D');
        $bln = Carbon::now()->isoFormat('MM');
        $thn = Carbon::now()->isoFormat('Y');

        $getData = "SELECT sqp.nama_queue, count(sqp.kode_queue) as jumlah FROM queue_poli qp
                JOIN set_queue_poli sqp ON qp.kode_queue = sqp.id
                WHERE qp.deleted_at is null
                AND qp.tgl_visite is null
                AND YEAR(qp.tgl_queue) = $thn 
                AND MONTH(qp.tgl_queue) = $bln 
                AND DAY(qp.tgl_queue) = $tgl
                GROUP BY sqp.nama_queue,sqp.kode_queue";
        $data = DB::select($getData);

        return response()->json($data, 200);
    }
}

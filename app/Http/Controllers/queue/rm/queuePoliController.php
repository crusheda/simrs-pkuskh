<?php

namespace App\Http\Controllers\queue\rm;

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
         
        $data = [
            'now' => $now,
            'day' => $day,
            'show' => $show,
            'poli' => $poli,
        ];
        // print_r($data['show']);
        // die();

        return view('pages.queue.rm.index')->with('list', $data);
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
        $getQueue = set_queue_poli::find($request->kode_queue);
        $now = Carbon::now();
        // $getLast = queue_poli::select('queue')->orderBy('queue', 'DESC')->first();
        $getLast = queue_poli::where('kode_queue', $request->kode_queue)->where('deleted_at','=', null)->where('inden','=', false)->orderBy('id', 'DESC')->first();
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
            } else {
                $plus = 1;
                $done = sprintf("%03d", $plus);
            }
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
        $data->inden = 0;
        $data->tgl_queue = $now;

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
        $data = queue_poli::find($id);
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
}

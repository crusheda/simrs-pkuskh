<?php

namespace App\Http\Controllers\queue\pasien;

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
        //
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

    // public function apiFindQueue($id)
    // {
    //     $data = DB::table('queue_poli')
    //         ->join('set_queue_poli', 'queue_poli.kode_queue', '=', 'set_queue_poli.id')
    //         ->select('queue_poli.id','queue_poli.no_rm','queue_poli.nama','set_queue_poli.nama_queue','queue_poli.queue','queue_poli.inden','queue_poli.tgl_queue')
    //         ->where('queue_poli.deleted_at', null)
    //         ->where('queue_poli.tgl_visite', null)
    //         // ->where('queue_poli.kode_queue', $poli)
    //         ->where('queue_poli.no_rm', $id)
    //         ->orderBy('queue_poli.no_rm','ASC')
    //         // ->groupBy('set_queue_poli.nama_queue')
    //         ->first();
            
    //     return response()->json($data, 200);
    // }
}

<?php

namespace App\Http\Controllers\queue\poli;

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
        $poli = set_queue_poli::get();
        $queue = queue_poli::get();
        $now = Carbon::now();

        // $show = DB::table('queue_poli')
        //         ->join('set_queue_poli', 'queue_poli.kode_queue', '=', 'set_queue_poli.id')
        //         ->select('queue_poli.kode_queue' ,'set_queue_poli.nama_queue')
        //         ->where('queue_poli.deleted_at', null)
        //         ->groupBy('queue_poli.kode_queue','set_queue_poli.nama_queue')
        //         ->get();
        $tgl = Carbon::now()->isoFormat('D');
        $bln = Carbon::now()->isoFormat('MM');
        $thn = Carbon::now()->isoFormat('Y');
        $date = Carbon::now()->isoFormat('YYYY-MM-D');

        $showdata = "SELECT qp.kode_queue,sqp.nama_queue,COUNT(qp.kode_queue) as jumlah FROM queue_poli qp
                JOIN set_queue_poli sqp ON qp.kode_queue = sqp.id
                WHERE qp.deleted_at is null
                AND YEAR(qp.tgl_queue) = $thn 
                AND MONTH(qp.tgl_queue) = $bln 
                AND DAY(qp.tgl_queue) = $tgl 
                GROUP BY qp.kode_queue,sqp.nama_queue,qp.kode_queue";
        // $demo = "SELECT CONVERT(VARCHAR(10), tgl_queue, 23) from queue_poli";
        // $showdemo = DB::select($demo);

        $show = DB::select($showdata);
        // $query = queue_poli::where('unit', $role)->where('name', $name)->where('deleted_at','=', null)->orderBy('id', 'DESC')->first();
        // $convert_query = Carbon::parse($query->tgl)->isoFormat('D MMMM Y');
        // $convert_now = Carbon::now()->isoFormat('D MMMM Y');

        // print_r($show);
        // die();

        $data = [
            'poli' => $poli,
            'queue' => $queue,
            'show' => $show,
            'now' => $now
        ];

        return view('pages.queue.poli.index')->with('list', $data);
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
        // $show = queue_poli::where('kode_queue', $id)->orderBy('queue', 'ASC')->get();
        $tgl = Carbon::now()->isoFormat('D');
        $bln = Carbon::now()->isoFormat('MM');
        $thn = Carbon::now()->isoFormat('Y');
        $date = Carbon::now()->isoFormat('YYYY-MM-D');
        $show = DB::table('queue_poli')
                ->join('set_queue_poli', 'queue_poli.kode_queue', '=', 'set_queue_poli.id')
                ->select('queue_poli.id','no_rm','queue_poli.nama','set_queue_poli.nama_queue','queue_poli.queue','queue_poli.tgl_queue')
                ->where('queue_poli.deleted_at', null)
                ->where('queue_poli.tgl_visite', null)
                ->where('queue_poli.kode_queue', $id)
                ->whereYear('queue_poli.tgl_queue', '=',$thn)
                ->whereMonth('queue_poli.tgl_queue', '=',$bln)
                ->whereDay('queue_poli.tgl_queue', '=',$tgl)
                ->get();
        // $show = queue_poli::get();
        // print_r($show);
        // die();

        $data = [
            'show' => $show,
            'kode' => $id,
        ];

        return view('pages.queue.poli.queue')->with('list', $data);
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

    public function apiQueue($id)
    {
        // $data = queue_poli::where('kode_queue', $id)->orderBy('queue', 'ASC')->get();

        $tgl = Carbon::now()->isoFormat('D');
        $bln = Carbon::now()->isoFormat('MM');
        $thn = Carbon::now()->isoFormat('Y');
        $date = Carbon::now()->isoFormat('YYYY-MM-D');
        $data = DB::table('queue_poli')
                ->join('set_queue_poli', 'queue_poli.kode_queue', '=', 'set_queue_poli.id')
                ->select('queue_poli.id','no_rm','queue_poli.nama','set_queue_poli.nama_queue','queue_poli.queue','queue_poli.tgl_queue')
                ->where('queue_poli.deleted_at', null)
                ->where('queue_poli.tgl_visite', null)
                ->where('queue_poli.kode_queue', $id)
                ->whereYear('queue_poli.tgl_queue', '=',$thn)
                ->whereMonth('queue_poli.tgl_queue', '=',$bln)
                ->whereDay('queue_poli.tgl_queue', '=',$tgl)
                ->get();

        // $data = "SELECT * FROM queue_poli qp
        //         JOIN set_queue_poli sqp ON qp.kode_queue = sqp.id
        //         WHERE qp.kode_queue = $id
        //         AND qp.deleted_at is null
        //         AND qp.tgl_visite is null
        //         AND YEAR(qp.tgl_queue) = $thn 
        //         AND MONTH(qp.tgl_queue) = $bln 
        //         AND DAY(qp.tgl_queue) = $tgl";

        return response()->json($data, 200);
    }

    public function hapusQueue($id)
    {
        $now = Carbon::now();
        $data = queue_poli::find($id);
        $data->tgl_visite = $now;
        $data->save();

        $success = queue_poli::where('id', $id)->delete();
        
        $message = "";
        if ($success) {
            $message = "Hapus Antrian Berhasil.";
        }else {
            $message = "Hapus Antrian Gagal.";
        }
        $response = [
            'success' => $success,
            'id' => $id,
            'message' => $message
        ];

        return response()->json($response, 200);
    }
}

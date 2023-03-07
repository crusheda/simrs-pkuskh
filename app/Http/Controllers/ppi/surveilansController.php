<?php

namespace App\Http\Controllers\ppi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\ppi\surveilans;
use App\Models\dokter;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Validator,Redirect,Response,File;
use Exception;
use Storage;
use Auth;

class surveilansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = surveilans::get();

        $data = [
            'show' => $show,
        ];

        return view('pages.ppi.surveilans.index')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dokter = dokter::where("jabatan","LIKE","%SPESIALIS%")->get();
        
        $data = [
            'dokter' => $dokter,
        ];

        return view('pages.ppi.surveilans.tambah')->with('list', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        $getData = surveilans::first();
        if (!empty($getData)) {
            $id_surveilans = $getData->id_surveilans + 1;
        } else {
            $id_surveilans = 1;
        }

        $data = new surveilans;
        
        // STEP 1
        $data->id_surveilans = $id_surveilans;
        $data->rm = $request->rm;
        $data->nama = $request->nama;
        $data->jns_kelamin = $request->jns_kelamin;
        $data->umur = $request->umur;
        $data->asal_pasang = $request->asal_pasang;
        $data->asal_ditemukan = $request->asal_ditemukan;

        // STEP 2
        $data->tgl_masuk = $request->tgl_masuk;
        $data->diagnosa = $request->diagnosa;
        $data->jns_surveilans = $request->jns_surveilans;
        
        // STEP 3
        if ($request->jns_surveilans == 1) { // PHLEBITIS
            $data->jns_pemasangan = $request->jns_pemasangan_ph;
            $data->tujuan_pemasangan = json_encode($request->tujuan_pemasangan_ph);
            $data->lokasi = $request->lokasi_ph;
            $data->tgl_pemasangan = $request->tgl_pemasangan_ph;
            $data->tgl_infeksi = $request->tgl_infeksi_ph;
            $data->tanda_infeksi = json_encode($request->tanda_infeksi_ph);
            $data->bundles = json_encode($request->bundles_ph);
        } elseif ($request->jns_surveilans == 2) { // CAUTI
            $data->jns_pemasangan = $request->jns_pemasangan_cauti;
            $data->tgl_pemasangan = $request->tgl_pemasangan_cauti;
            $data->tgl_infeksi = $request->tgl_infeksi_cauti;
            $data->tanda_infeksi = json_encode($request->tanda_infeksi_cauti);
            $data->bundles = json_encode($request->bundles_cauti);
        } elseif ($request->jns_surveilans == 3) { // VAP
            $data->no_ventilator = $request->no_ventilator_vap;
            $data->tgl_pemasangan = $request->tgl_pemasangan_vap;
            $data->tgl_infeksi = $request->tgl_infeksi_vap;
            $data->tanda_infeksi = json_encode($request->tanda_infeksi_vap);
            $data->bundles = json_encode($request->bundles_vap);
        } elseif ($request->jns_surveilans == 4) { // IDO
            $data->tindakan_operasi = $request->tindakan_operasi_ido;
            $data->dr_operator = $request->dr_operator_ido;
            $data->jns_operasi = $request->jns_operasi_ido;
            $data->tgl_infeksi = $request->tgl_infeksi_ido;
            $data->tanda_infeksi = json_encode($request->tanda_infeksi_ido);
            $data->bundles = json_encode($request->bundles_ido);
        }
        
        $data->save();

        return redirect()->route('surveilans.index')->with('message','Data berhasil ditambahkan, Pasien a/n '.$request->nama);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = surveilans::where('id', $id)->get();

        return response()->json($show, 200);
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

    // PUSH API AREA
    public function getPasien($rm)
    {
        $client = new Client();

        // NEW IP PUBLIC
        $res = $client->request('GET', 'http://103.210.117.106:8000/api/all/'.$rm);
        $data = json_decode($res->getBody());
        // dd($data);

        return response()->json($data, 200);
    }
}

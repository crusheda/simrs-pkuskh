<?php

namespace App\Http\Controllers\it\pengadaan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\pengadaan;
use Illuminate\Http\Request;
use Carbon\Carbon;
// use Auth;
use \PDF;

class nonrutinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = pengadaan::get();

        $getby = "SELECT token, unit, pemohon, created_at FROM pengadaan 
                  WHERE jnspengadaan = 'nonrutin'
                  GROUP BY unit, pemohon, token, created_at";

        $query_getby = DB::select($getby);

        $data = [
            'show' => $show,
            'getby' => $query_getby
        ];
        // print_r($data);
        // die();

        return view('pages.pengadaan.nonrutin')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pengadaan.tambah-nonrutin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = Carbon::now()->addHours(7);
        // $unit = Auth::User()->name;
        // $pemohon = Auth::User()->first_name.' '.Auth::User()->last_name;
        $jnspengadaan = 'nonrutin';

        $data = $request->all();
        $finalArray = array();
        $counter = 0;
        $counter = pengadaan::max('token');
        $token = $counter + 1;

        // print_r($token);
        // die();

        for ($i=0; $i < count($data['barang']); $i++) {
            array_push($finalArray, array(
                'unit'=> $unit,
                'pemohon'=>$pemohon,
                'barang'=>$data['barang'][$i],
                'jumlah'=>$data['jumlah'][$i],
                'satuan'=>$data['satuan'][$i],
                'harga'=> $data['harga'][$i],
                'total'=>$data['jumlah'][$i] * $data['harga'][$i],
                'keterangan'=>$data['keterangan'][$i],
                'jnspengadaan'=>$jnspengadaan,
                'token' => $token,
                'created_at'=> $now )
            );
        }

        pengadaan::insert($finalArray);
        
        return redirect('pengadaan/nonrutin')->with('message','Tambah Data Pengadaaan Non Rutin Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = pengadaan::find($token);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = pengadaan::find($id);
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
        $data = pengadaan::find($id);
        $data->delete();

        // redirect
        return \Redirect::to('pengadaan/nonrutin')->with('message','Hapus Pengadaan Non Rutin Berhasil');
    }

    public function getbyapi($token)
    {
        $show = pengadaan::where("token", "=" ,$token)->get();

        return response()->json($show, 200);
    }
}

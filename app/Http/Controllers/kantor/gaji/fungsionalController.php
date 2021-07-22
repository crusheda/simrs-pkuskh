<?php

namespace App\Http\Controllers\kantor\gaji;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\gaji\fungsional;
use Carbon\Carbon;
use Exception;
use Redirect;
use Auth;

class fungsionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = fungsional::get();

        $data = [
            'show' => $show
        ];
        
        // print_r($getmont);
        // die();

        // print_r($data['show']);
        // die();
        return view('pages.kantor.kepegawaian.gaji.fungsional')->with('list', $data);
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
        $data = new fungsional;
        $data->ket  = $request->ket;
        $data->nominal  = $request->nominal;
        
        $data->save();
        return redirect::back()->with('message','Tunjangan Fungsional '.$request->ket.' Berhasil Ditambahkan');
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
        $data = fungsional::find($id);

        $data->ket  = $request->ket;
        $data->nominal  = $request->nominal;
        
        $data->save();
        return redirect::back()->with('message','Ubah Tunjangan Fungsional Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = fungsional::find($id);
        $data->delete();

        return redirect::back()->with('message','Hapus Tunjangan Fungsional Berhasil');
    }
}

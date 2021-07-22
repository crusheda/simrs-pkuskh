<?php

namespace App\Http\Controllers\kantor\gaji;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\gaji\ref_potong;
use Carbon\Carbon;
use Exception;
use Redirect;
use Auth;

class potongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = ref_potong::get();

        $data = [
            'show' => $show
        ];
        
        // print_r($getmont);
        // die();

        // print_r($data['show']);
        // die();
        return view('pages.kantor.kepegawaian.gaji.potong')->with('list', $data);
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
        $data = new ref_potong;
        $data->kriteria  = $request->kriteria;
        $data->nominal  = $request->nominal;
        $data->ket  = $request->ket;
        
        $data->save();
        return redirect::back()->with('message','Kriteria '.$request->kriteria.' Berhasil Ditambahkan');
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
        $data = ref_potong::find($id);

        $data->kriteria  = $request->kriteria;
        $data->nominal  = $request->nominal;
        $data->ket  = $request->ket;
        
        $data->save();
        return redirect::back()->with('message','Ubah Kriteria Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ref_potong::find($id);
        $data->delete();

        return redirect::back()->with('message','Hapus Kriteria Berhasil');
    }
}

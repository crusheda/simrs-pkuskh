<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\logprofkpr;
use App\Models\unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class logProfKprController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = logprofkpr::get();

        $data = [
            'show' => $show,
        ];
        // print_r($data);
        // die();

        return view('pages.logperawat.pernyataanprofkpr')->with('list', $data);
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
        $this->validate($request,[
            'unit' => 'nullable',
            'pernyataan' => 'nullable',
            ]);

        $data = new logprofkpr;
        $data->unit = $request->unit;
        $data->pernyataan = $request->pernyataan;

        $data->save();

        return redirect('/logprofkpr')->with('message','Tambah Pernyataan Profesi Keperawatan Berhasil.');
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
        $this->validate($request,[
            'unit' => 'nullable',
            'pernyataan' => 'nullable',
            ]);

        $data = logprofkpr::find($id);
        $data->unit = $request->unit;
        $data->pernyataan = $request->pernyataan;

        $data->save();

        return redirect()->back()->with('message','Ubah Pernyataan Profesi Keperawatan Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = logprofkpr::find($id);
        $data->delete();

        // redirect
        return \Redirect::to('logprofkpr')->with('message','Hapus Pernyataan Profesi Keperawatan Berhasil.');
    }
}

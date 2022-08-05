<?php

namespace App\Http\Controllers\k3;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\k3\manrisk;
use App\Models\unit;
use Carbon\Carbon;
use Auth;
use Storage;
use Exception;
use Redirect;

class manriskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('pages.new.laporan.k3.accidentreport')->with('list', $data);
        return view('pages.k3.manrisk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.k3.manrisk.tambah');
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

    public function apiData()
    {
        $user = Auth::user();
        $id = $user->id;

        // if ($user->hasRole('it')) {
        //     $show = ref_jadwal_dinas::get();
        // } else {
        //     $show = ref_jadwal_dinas::where('id_user',$id)->get();
        // }
        $show = manrisk::get();

        $data = [
            'show' => $show,
        ];

        // print_r($data);
        // die();
        return response()->json($data, 200);
    }
}

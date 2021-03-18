<?php

namespace App\Http\Controllers\queue\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use App\Models\set_queue_poli;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Redirect;

class setQueuePoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $id    = $user->id;
        $name = $user->name;
        $role = $user->roles->first()->name; //kabag-keperawatan
        
        $show = set_queue_poli::orderBy('id', 'DESC')->get();

        $data = [
            'show' => $show,
        ];

        // print_r($last);
        // die();

        return view('pages.queue.admin.index')->with('list', $data);
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
        $data = new set_queue_poli;
        $data->kode_queue = $request->kode_queue;
        $data->nama_queue = $request->nama_queue;
        $data->aktif = true;
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
        $data = set_queue_poli::find($id);
        $data->kode_queue = $request->kode_queue;
        $data->nama_queue = $request->nama_queue;
        $data->aktif = $request->aktif;
        $data->save();
    
        return Redirect::back()->with('message','Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = set_queue_poli::where('id', $id)->delete();

        return Redirect::back()->with('message','Hapus Data Berhasil.');
    }
}

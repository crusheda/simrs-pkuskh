<?php

namespace App\Http\Controllers\system\setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\user;
use App\Models\system\strukturorganisasi;
use App\Models\model_has_roles;
use App\Models\role;
use Carbon\Carbon;
use Redirect;
use Auth;

class strukturOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = role::get();
        $show = strukturorganisasi::get();

        $data = [
            'show' => $show,
            'role' => $role,
        ];

        return view('pages.system.setting.strukturorganisasi.index')->with('list', $data);
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
        $getRole = role::where('id',$request->role)->first();
        
        $data = new strukturorganisasi;
        $data->role_id = $request->role;
        $data->role_name = $getRole->name;
        $data->accepted = json_encode($request->accepted);
        $data->save();

        return Redirect::back()->with('message','Tambah Struktur Bagian '.$getRole->name.' Berhasil');
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
        $getRole = role::where('id',$request->role)->first();

        $data = strukturorganisasi::find($id);

        $data->role_id = $request->role;
        $data->role_name = $getRole->name;
        $data->accepted = json_encode($request->accepted);
        
        $data->save();
        return redirect::back()->with('message','Ubah Struktur '.$getRole->name.' Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = strukturorganisasi::find($id);
        $data->delete();

        return redirect::back()->with('message','Hapus Struktur Berhasil');
    }
}

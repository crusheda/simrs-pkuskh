<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use App\Models\notif;
use Carbon\Carbon;
use Auth;
use Redirect;

class notifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = notif::get();

        $data = [
            'show' => $show,
        ];
        // print_r($data);
        // die();

        return view('pages.new.administrator.notif')->with('list', $data);
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
            'judul' => 'required',
            'icon' => 'required',
            'ket' => 'required',
            'tgl' => 'required',
            ]);
            
        // print_r($icon);
        // die();
        $tgl = Carbon::parse($request->tgl);
        
        $data = new notif;
        $data->judul = $request->judul;
        if ($request->color == null) {
            $data->color = "#6777ef";
        } else {
            $data->color = $request->color;
        }
        $data->icon = $request->icon;
        $data->ket = $request->ket;
        $data->tgl = $tgl;
        $data->status = true;

        $data->save();

        return redirect()->back()->with('message','Tambah Notifikasi Berhasil.');
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
            'judul' => 'required',
            'icon' => 'required',
            'ket' => 'required',
            'tgl' => 'required',
        ]);

        $data = new notif;
        $data->judul = $request->judul;
        $data->icon = $request->icon;
        $data->ket = $request->ket;
        $data->tgl = $request->tgl;

        $data->save();
        return redirect()->back()->with('message','Perubahan Notifikasi Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = notif::find($id);
        $data->delete();

        // redirect
        return redirect()->back()->with('message','Hapus Notifikasi Berhasil.');
    }

    public function apiNotif()
    {
        $show = notif::where('status', true)->where('deleted_at', null)->orderBy('id', 'desc')->get();

        return response()->json($show, 200);
    }
}

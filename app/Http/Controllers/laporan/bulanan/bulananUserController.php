<?php

namespace App\Http\Controllers\laporan\bulanan;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\laporan_bulanan;
use App\Models\unit;
use App\Models\setRoleUser;
use App\User;
use Carbon\Carbon;
use Redirect;
use Storage;
use Auth;
use Response;
use Exception;

class bulananUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $id = $user->id;
        $name = $user->name;
        $role = $user->roles; //kabag-keperawatan

        $tgl = Carbon::now()->isoFormat('YYYY/MM/DD');
        $tglAfter3Day = Carbon::now()->addDays(3)->isoFormat('YYYY/MM/DD');
        $tglAfter2Day = Carbon::now()->addDays(2)->isoFormat('YYYY/MM/DD');
        $tglAfter1Day = Carbon::now()->addDays(1)->isoFormat('YYYY/MM/DD');
        $thn = Carbon::now()->isoFormat('Y');

        // print_r($show);
        // die();

        $data = [
            'user' => $user,
            'tgl'  => $tgl,
            'tglAfter3Day'  => $tglAfter3Day,
            'tglAfter2Day'  => $tglAfter2Day,
            'tglAfter1Day'  => $tglAfter1Day,
            'thn'  => $thn,
            'role' => $role
        ];
        
        return view('pages.administrasi.laporan.bulanan.userIndex')->with('list', $data);
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
    
    public function table()
    {
        $user = Auth::user();
        $id = $user->id;

        $show = laporan_bulanan::where('id_user',$id)->orderBy('updated_at','desc')->get();
        // print_r($show);
        // die();
        
        $tgl = Carbon::now()->isoFormat('YYYY/MM/DD');
        $tglAfter3Day = Carbon::now()->addDays(3)->isoFormat('YYYY/MM/DD');
        $tglAfter2Day = Carbon::now()->addDays(2)->isoFormat('YYYY/MM/DD');
        $tglAfter1Day = Carbon::now()->addDays(1)->isoFormat('YYYY/MM/DD');

        $data = [
            'show' => $show,
            'tgl' => $tgl,
            'tglAfter1Day' => $tglAfter1Day,
            'tglAfter2Day' => $tglAfter2Day,
            'tglAfter3Day' => $tglAfter3Day,
        ];

        return response()->json($data, 200);
    }
}

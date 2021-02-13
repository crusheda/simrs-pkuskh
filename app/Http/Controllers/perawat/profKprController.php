<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use App\Models\profkpr;
use App\Models\logprofkpr;
use App\Models\unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Redirect;

class profKprController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thn = Carbon::now()->isoFormat('D MMMM Y');
        $user = Auth::user();
        $id    = $user->id;
        $name = $user->name;
        $role = $user->roles->first()->name; //kabag-keperawatan
        $log = logprofkpr::pluck('id','pernyataan');
        // $pernyataan = logtgsperawat::pluck('id','pernyataan');
        
        if (Auth::user()->hasRole('kabag-keperawatan')) {
            $show = DB::table('profkpr')
                ->select('queue' ,'name' ,'unit')
                ->where('deleted_at', null)
                ->groupBy('queue' ,'name' ,'unit')
                ->get();
            $pernyataan = '';
            $recent = 'Anda adalah Admin Log';
        }
        else {
            $show = DB::table('profkpr')
                // ->select('id' ,'name' ,'unit' ,'tgl')
                ->where('deleted_at', null)
                ->where('queue', $id)
                ->where('unit', $role)
                // ->groupBy('id' ,'name' ,'unit' ,'tgl')
                ->get();
                
            if ($user->hasPermissionTo('log_perawat')) {
                $pernyataan = logprofkpr::get();
                $recent = profkpr::where('unit', $role)->where('queue', $id)->where('deleted_at','=', null)->orderBy('id', 'DESC')->select('tgl')->pluck('tgl')->first();
            }
            // print_r($done);
            // die();
        }
         
        $data = [
            'pernyataan' => $pernyataan,
            'show' => $show,
            'recent' => $recent,
            'thn' => $thn,
            'log' => $log,
        ];
        // print_r($data['show']);
        // die();

        return view('pages.logperawat.profkpr')->with('list', $data);
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
        $user = Auth::user();
        $id    = $user->id;
        $name = $user->name; //jamhuri
        $email = $user->email; //jamhuri@pkuskh.com
        $role = $user->roles->first()->name; //kabag_keperawatan

        // print_r($find);
        // die();
        if ($request->tgl == null) {
            $tgl = '';
        } else {
            $tgl = $request->tgl;
        }
        
            $data = new profkpr;
            $data->queue = $id;
            $data->name = $name;
            $data->email = $email;
            $data->unit = $role;
            $data->pernyataan = $request->pernyataan;
            $data->tgl = $request->tgl;
            $data->ket = $request->ket;
            $data->save();
        
        return Redirect::back()->with('message','Data Profesi Keperawatan Berhasil Ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showdata = profkpr::where('queue', $id)->get();
        $last = profkpr::select('tgl')->where('queue', $id)->orderBy('id', 'DESC')->first();
        
        $data = [
            'show' => $showdata,
            'last' => $last
        ];
        // print_r($data['recent']);
        // die();
        return view('pages.logperawat.detail-profkpr')->with('list', $data);
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
        $data = profkpr::find($id);
        $data->pernyataan = $request->pernyataan;
        $data->tgl = $request->tgl;
        $data->ket = $request->ket;
        $data->save();
    
        return Redirect::back()->with('message','Data Profesi Keperawatan Berhasil Diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = profkpr::where('id', $id)->delete();

        return Redirect::back()->with('message','Hapus Profesi Keperawatan Berhasil.');
    }
}

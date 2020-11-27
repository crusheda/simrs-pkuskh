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

class profKprController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thn = substr(Carbon::now(),0,4);
        $user = Auth::user();
        $role = $user->roles->first()->name; //kabag_keperawatan
        $unit = unit::pluck('id','name');
        $pernyataan = logprofkpr::pluck('id','pernyataan');
        
        $show = DB::table('profkpr')
            ->select('queue' ,'name' ,'unit' ,'tgl')
            ->where('deleted_at', null)
            ->groupBy('queue' ,'name' ,'unit' ,'tgl')
            ->get();
        $all = profkpr::get();

        if ($role == 'ibs') {
            $recent = profkpr::where('unit', 'IBS')->select('tgl')->first();
        }elseif ($role == 'bangsal-dewasa') {
            $recent = profkpr::where('unit', 'Bangsal Dewasa')->select('tgl')->first();
        }elseif ($role == 'bangsal-anak') {
            $recent = profkpr::where('unit', 'Bangsal Anak')->select('tgl')->first();
        }elseif ($role == 'poli') {
            $recent = profkpr::where('unit', 'Poliklinik')->select('tgl')->first();
        }elseif ($role == 'icu') {
            $recent = profkpr::where('unit', 'ICU')->select('tgl')->first();
        }elseif ($role == 'kebidanan') {
            $recent = profkpr::where('unit', 'Kebidanan')->select('tgl')->first();
        }else {
            $recent = profkpr::select('tgl')->first();
        }
         
        $data = [
            'pernyataan' => $pernyataan,
            'show' => $show,
            'all' => $all,
            'unit' => $unit,
            'recent' => $recent,
            'thn' => $thn
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
}

<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use App\Models\tgsperawat;
use App\Models\logtgsperawat;
use App\Models\unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class tgsPerawatController extends Controller
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
        $name = $user->name;
        $role = $user->roles->first()->name; //kabag-keperawatan
        // $pernyataan = logtgsperawat::pluck('id','pernyataan');
        
        if (Auth::user()->hasRole('kabag-keperawatan')) {
            $show = DB::table('tgsperawat')
                ->select('queue' ,'name' ,'unit' ,'tgl')
                ->where('deleted_at', null)
                ->groupBy('queue' ,'name' ,'unit' ,'tgl')
                ->get();
        }
        else {
            $show = DB::table('tgsperawat')
                ->select('queue' ,'name' ,'unit' ,'tgl')
                ->where('deleted_at', null)
                ->where('unit', $role)
                ->groupBy('queue' ,'name' ,'unit' ,'tgl')
                ->get();
                
            if ($user->hasPermissionTo('log_perawat')) {
                $pernyataan = logtgsperawat::where('unit', $role)->get();
                $recent = tgsperawat::where('unit', $role)->select('tgl')->first();
            }
        }
         
        $data = [
            'pernyataan' => $pernyataan,
            'show' => $show,
            'recent' => $recent,
            'thn' => $thn
        ];
        // print_r($data['show']);
        // die();

        return view('pages.logperawat.tgsperawat')->with('list', $data);
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
        
        $user = Auth::user();
        $name = $user->name; //jamhuri
        $email = $user->email; //jamhuri@pkuskh.com
        $role = $user->roles->first()->name; //kabag_keperawatan
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

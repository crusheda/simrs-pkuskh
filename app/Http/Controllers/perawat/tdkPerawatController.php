<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use App\Models\logperawat;
use App\Models\tdkperawat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class tdkPerawatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $show = tdkperawat::get();

        $thn = substr(Carbon::now(),0,4);
        $user = Auth::user();
        $role = $user->roles->first()->name; //kabag_keperawatan
        
        if (Auth::user()->hasRole('kabag-keperawatan')) {
            $show = DB::table('tdkperawat')
                ->select('queue' ,'name' ,'unit' ,'tgl')
                ->where('deleted_at', null)
                ->groupBy('queue' ,'name' ,'unit' ,'tgl')
                ->get();
            $tdk = logperawat::get();
        }
        else {
            $show = DB::table('tdkperawat')
                ->select('queue' ,'name' ,'unit' ,'tgl')
                ->where('unit', $role)
                ->where('deleted_at', null)
                ->groupBy('queue' ,'name' ,'unit' ,'tgl')
                ->get();
            if ($role == 'ibs') {
                $tdk = logperawat::where('unit', 'IBS')->get();
            }elseif ($role == 'bangsal-dewasa') {
                $tdk = logperawat::where('unit', 'Bangsal Dewasa')->get();
            }elseif ($role == 'bangsal-anak') {
                $tdk = logperawat::where('unit', 'Bangsal Anak')->get();
            }elseif ($role == 'poli') {
                $tdk = logperawat::where('unit', 'Poliklinik')->get();
            }elseif ($role == 'icu') {
                $tdk = logperawat::where('unit', 'ICU')->get();
            }elseif ($role == 'kebidanan') {
                $tdk = logperawat::where('unit', 'Kebidanan')->get();
            }
        }
        
        $data = [
            'show' => $show,
            'tdk' => $tdk,
            'thn' => $thn
        ];
        // print_r($data['show']);
        // die();
        
        // if (Auth::user()->hasRole('kabag_keperawatan')) {
        //     # code...
        //     $cek = 'benar';
        // }else {
        //     $cek = 'salah';
        // }

        // $cek = Role::findByName('kantor');

        return view('pages.logperawat.tdkperawat')->with('list', $data);
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
        $getqueue = tdkperawat::max('queue');
        $queue = $getqueue + 1;
        $gettgl = Carbon::now(); 
        $user = Auth::user();
        $name = $user->name; //jamhuri@pkuskh.com
        $email = $user->email; //jamhuri@pkuskh.com
        $role = $user->roles->first()->name; //kabag_keperawatan

        // print_r($getqueue);
        // die();

            // $baris = logperawat::get()->where('unit', $email);
            $pertanyaan = $request->input('pertanyaan');
            $jawaban = $request->input('box');
            // print_r($jawaban);
            // die();
            
            for($count = 0; $count < count($pertanyaan); $count++)
            {
                $ins = array(
                    'queue' => $queue,
                    'name' => $name,
                    'email' => $email,
                    'unit' => $role,
                    'pertanyaan'  => $pertanyaan[$count],
                    'jawaban'  => $jawaban[$count],
                    'tgl' => $gettgl
                );
                
                $data[] = $ins; 
            }

        tdkperawat::insert($data);

        return redirect('/tdkperawat')->with('message','Tambah Tindakan Harian Perawat Berhasil.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showdata = tdkperawat::where('queue', $id)->get();
        $first = tdkperawat::where('queue', $id)->first();

        $data = [
            'show' => $showdata,
            'first' => $first
        ];
        // print_r($data);
        // die();
        return view('pages.logperawat.detail-tdkperawat')->with('list', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $showdata = tdkperawat::where('queue', $id)->get();
        $first = tdkperawat::where('queue', $id)->first();

        $data = [
            'show' => $showdata,
            'first' => $first
        ];

        return view('pages.logperawat.ubah-tdkperawat')->with('list', $data);
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
        // print_r($request->all());
        // die();
        // $jawaban = $request->input('jawaban');
        //     // print_r($jawaban);
        //     // die();
            
        //     for($count = 0; $count < count($jawaban); $count++)
        //     {
        //         $ins = array(
        //             'jawaban'  => $jawaban[$count]
        //         );
                
        //         $data[] = $ins; 
        //     }

        // tdkperawat::insert($data);

        // return \Redirect::to('tdkperawat/'.$id)->with('message','Ubah Tindakan Harian Perawat Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($queue)
    {
        $data = tdkperawat::where('queue', $queue)->delete();
        // $data->delete();

        // redirect
        return \Redirect::to('tdkperawat')->with('message','Hapus Tindakan Harian Perawat Berhasil.');
    }

    public function generatePDF($id)
    {
        # code...
    }

    public function cariLog(Request $request)
    {
        $getthn = substr(Carbon::now(),0,4);
        $bln = $request->query('bulan');
        $thn = $request->query('tahun');
        $time= 'Bulan : '.$bln.' Tahun : '.$thn;

        if($bln && $thn){
            $query_string = "SELECT * FROM tdkperawat WHERE YEAR(tgl) = $thn AND MONTH(tgl) = $bln";
            $show = DB::select($query_string);
        }
        // elseif($bulan){
        //     $query_string = "SELECT * FROM output WHERE MONTH(created_at) = $bulan";
        //     $show = DB::select($query_string);
        //     $total = count($show);
        // }
        // elseif($tahun){
        //     $query_string = "SELECT * FROM output WHERE YEAR(created_at) = $tahun";
        //     $show = DB::select($query_string);
        //     $total = count($show);
        // }        

        $data = [
            'getthn' => $getthn,
            'show' => $show,
            'time' => $time
        ];

        return view('pages.logperawat.cari-tdkperawat')->with('list', $data);
    }
}

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
        $now = Carbon::now();
        $today = Carbon::now()->isoFormat('YYYY/MM/DD');
        // ex : $user->created_at->isoFormat('dddd, D MMMM Y');      "Minggu, 28 Juni 2020"
        // ex : $post->updated_at->diffForHumans();                  "2 hari yang lalu"

        $thn = Carbon::now()->isoFormat('Y');
        $user = Auth::user();
        $name = $user->name;
        $role = $user->roles->first()->name; //kabag-keperawatan
        
            $show = DB::table('tdkperawat')
                ->select('queue' ,'name' ,'unit' ,'tgl')
                ->where('deleted_at', null)
                ->groupBy('queue' ,'name' ,'unit' ,'tgl')
                ->get();
            $tdk = logperawat::get();
        // print_r($convert_query);
        // die();    
        
        $data = [
            'show' => $show,
            'tdk' => $tdk,
            'thn' => $thn,
            'now' => $now,
            'today' => $today,
            // 'convert' => $convert,
            // 'cek' => $cek
        ];

        // return view('pages.logperawat.tdkperawat')->with('list', $data);
        return view('pages.new.laporan.logperawat.log.tindakan-harian-old')->with('list', $data);
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

        $user = Auth::user();
        $name = $user->name;
        $role = $user->roles->first()->name; //kabag-keperawatan
        
        $convert_query = Carbon::parse($first->tgl)->isoFormat('D MMMM Y');
        $convert_now = Carbon::now()->isoFormat('D MMMM Y');

        if ($convert_now == $convert_query) {
            $recent = 1;
        } else {
            $recent = 0;
            // print_r($convert_query);
            // die();    
        }

        $data = [
            'show' => $showdata,
            'first' => $first,
            'recent' => $recent
        ];
        // print_r($data['recent']);
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
        $data = tdkperawat::find($id);
        $data->jawaban = $request->jawaban;

        $data->save();

        return \Redirect::to('tdkperawat/'.$data->queue)->with('message','Ubah Tindakan Harian Perawat Berhasil.');
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
        
        if ($request->query('bulan') == 'Bulan') {
            $thn = $request->query('tahun');
            $bln = null;
        } elseif ($request->query('tahun') == 'Tahun') {
            $bln = $request->query('bulan');
            $thn = null;
        } else {
            $bln = $request->query('bulan');
            $thn = $request->query('tahun');
        }
        
        $time= 'Bulan : '.$bln.' Tahun : '.$thn;
        
        if($bln && $thn){
            $query_string = "SELECT name,unit,pertanyaan,sum(jawaban) as hasil FROM tdkperawat WHERE YEAR(tgl) = $thn AND MONTH(tgl) = $bln GROUP BY name,unit,pertanyaan";
            $show = DB::select($query_string);
        }
        elseif($bln && $thn == null){
            $query_string = "SELECT * FROM tdkperawat WHERE MONTH(tgl) = $bln";
            $show = DB::select($query_string);
        }
        elseif($thn && $bln == null){
            $query_string = "SELECT * FROM tdkperawat WHERE YEAR(tgl) = $thn";
            $show = DB::select($query_string);
        }        

        // print_r($show);
        // die();

        $data = [
            'getthn' => $getthn,
            'show' => $show,
            'time' => $time
        ];

        return view('pages.logperawat.cari-tdkperawat')->with('list', $data);
    }
}

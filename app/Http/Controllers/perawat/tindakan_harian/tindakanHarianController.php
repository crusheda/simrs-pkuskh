<?php

namespace App\Http\Controllers\perawat\tindakan_harian;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\logperawat\tindakan_harian;
use App\Models\logperawat;
use App\User;
use Carbon\Carbon;
use Redirect;
use Auth;

class tindakanHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        // ex : $user->created_at->isoFormat('dddd, D MMMM Y');      "Minggu, 28 Juni 2020"
        // ex : $post->updated_at->diffForHumans();                  "2 hari yang lalu"

        $thn = Carbon::now()->isoFormat('YYYY');
        $today = Carbon::now()->isoFormat('YYYY/MM/DD');

        $user = Auth::user();
        $id_user = $user->id;
        $name = $user->name;
        $unit = $user->roles;

        // GET LIST USER INPUT [PERAWAT]
        // $users = User::whereHas(
        //     'roles', function($q){
        //         $q->whereIn('name', ['igd','icu','bangsal-dewasa','bangsal-anak','kebidanan','ibs','poli']);
        //     }
        // )->get();

        // $showAll = tindakan_harian::all();

        if (Auth::user()->hasRole('kabag-keperawatan')) {
            $show = tindakan_harian::select('queue','shift','nama','unit','tgl')->groupBy('queue','shift','nama','unit','tgl')->orderBy('tgl','desc')->get();
            $pernyataan = null;
        }
        else {
            $get_pernyataan = logperawat::orderBy('updated_at','DESC')->get();
            
            // GET ROLE
            foreach ($unit as $key => $value) {
                foreach ($get_pernyataan as $py => $item) {
                    if ($value->name == $item->unit) {
                        $array_pernyataan[] = $item->id;
                    }
                }
                $role[] = $value->name;
            }
            
            // GET DATA
            $getId = [];
            if (count($showAll) > 0) {
                foreach ($showAll as $key => $value) {
                    $arr = json_decode($value->unit);
                    foreach ($arr as $ky => $val) {
                        foreach ($role as $gt => $item) {
                            // print_r($val);
                            if ($val == $item) {
                                $getId[] = $value->id;
                            }
                        }
                    }
                }
            } else {
                $show = $showAll;
            }

            // JIKA USER BELUM PERNAH MEMASUKKAN TINDAKAN HARIAN
            if (!empty($getId)) {
                $show = tindakan_harian::whereIn('id', $getId)->select('queue','shift','nama','unit','tgl')->groupBy('queue','shift','nama','unit','tgl')->orderBy('tgl','desc')->get();
            } else {
                $show = tindakan_harian::where('id_user', $id_user)->select('queue','shift','nama','unit','tgl')->groupBy('queue','shift','nama','unit','tgl')->orderBy('tgl','desc')->get();
            }

            $pernyataan = logperawat::whereIn('id', $array_pernyataan)->get();
        }   
        
        // print_r($showEdit);
        // die();

        $data = [
            // 'users' => $users,
            'show' => $show,
            // 'show_all' => $showAll,
            // 'show_edit' => $showEdit,
            'pernyataan' => $pernyataan,
            'user' => $user,
            'thn' => $thn,
            'today' => $today,
        ];

        return view('pages.logperawat.tindakan_harian.index')->with('list', $data);
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
        if ($request->shift == 'Pilih') {
            return redirect::back()->withErrors('Shift Jaga belum dimasukkan, mohon ulangi sekali lagi.');
        }

        $getqueue = tindakan_harian::max('queue');
        $queue = $getqueue + 1;
        $tgl = Carbon::now(); 

        $user = Auth::user();
        $id_user = $user->id; 
        $nama = $user->nama; 
        $unit = $user->roles; //kabag_keperawatan

        foreach ($unit as $key => $value) {
            $role[] = $value->name;
        }

        // print_r($nama);
        // die();

            // $baris = logperawat::get()->where('unit', $email);
            $pernyataan = $request->input('pernyataan');
            $jawaban = $request->input('box');
            // print_r($jawaban);
            // die();
            
            for($count = 0; $count < count($pernyataan); $count++)
            {
                $ins = array(
                    'queue' => $queue,
                    'shift' => $request->shift,
                    'id_user' => $id_user,
                    'nama' => $nama,
                    'unit' => json_encode($role),
                    'pernyataan'  => $pernyataan[$count],
                    'jawaban'  => $jawaban[$count],
                    'tgl' => $tgl
                );
                
                $data[] = $ins; 
            }

        tindakan_harian::insert($data);

        return redirect()->back()->with('message','Tambah Tindakan Harian Berhasil.');
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
        if (Auth::user()->hasRole('kabag-keperawatan')) {
        } else {
            $validasi = tindakan_harian::where('queue',$id)->first();
            if (Auth::user()->id != $validasi->id_user) {
                return Redirect::back()->withErrors(['Maaf, anda tidak diperbolehkan mengganti tindakan harian perawat lain']);
            }
        }
        $pernyataan = $request->input('pernyataan');
        $jawaban = $request->input('box');
        
        for($count = 0; $count < count($pernyataan); $count++)
        {
            $ins = array(
                'shift' => $request->shift,
                'jawaban'  => $jawaban[$count],
            );
            
            tindakan_harian::where('queue',$id)->where('pernyataan',$pernyataan[$count])->update($ins);
        }

        return redirect()->back()->with('message','Tambah Tindakan Harian Berhasil.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasRole('kabag-keperawatan')) {
        } else {
            $validasi = tindakan_harian::where('queue',$id)->first();
            if (Auth::user()->id != $validasi->id_user) {
                return Redirect::back()->withErrors(['Maaf, anda tidak diperbolehkan menghapus tindakan harian perawat lain']);
            }
        }
        tindakan_harian::where('queue', $id)->delete();

        return redirect()->back()->with('message','Hapus Tindakan Harian Berhasil.');
    }

    public function getDataEdit($queue)
    {
        $show = tindakan_harian::leftJoin('logperawat', 'tindakan_harian_perawat.pernyataan', '=', 'logperawat.id')->select('tindakan_harian_perawat.id','tindakan_harian_perawat.queue','tindakan_harian_perawat.shift','tindakan_harian_perawat.pernyataan as id_pernyataan','logperawat.pertanyaan as pernyataan','tindakan_harian_perawat.jawaban')->where('tindakan_harian_perawat.queue', $queue)->orderBy('tindakan_harian_perawat.id','asc')->get();
        
        return response()->json($show, 200);
    }
    
    public function cari(Request $request)
    {
        $thn = Carbon::now()->isoFormat('YYYY');
        
        // $unit = $request->unit_cari;
        $shift = $request->shift_cari;
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        if ($shift != 'Shift' && $bulan != 'Bulan' && $tahun != 'Tahun') {
            $show = DB::table('tindakan_harian_perawat')
                ->join('logperawat', 'logperawat.id', '=', 'tindakan_harian_perawat.pernyataan')
                ->select('tindakan_harian_perawat.nama','tindakan_harian_perawat.unit','logperawat.pertanyaan',DB::raw('SUM(tindakan_harian_perawat.jawaban) as total_jawaban'))
                ->orderBy('tindakan_harian_perawat.tgl','DESC')
                ->where('tindakan_harian_perawat.shift', $shift)
                ->whereMonth('tindakan_harian_perawat.tgl', $bulan)
                ->whereYear('tindakan_harian_perawat.tgl', $tahun)
                ->where('tindakan_harian_perawat.deleted_at', null)
                ->where('tindakan_harian_perawat.jawaban','!=', '0')
                ->groupBy('tindakan_harian_perawat.nama','tindakan_harian_perawat.unit','logperawat.pertanyaan')
                ->get();
        } elseif ($shift == 'Shift' && $bulan == 'Bulan' && $tahun == 'Tahun') {
            return Redirect::back()->withErrors(['Maaf, anda belum memilih satupun pilihan filter yang ada']);
        } 
        
        elseif ($shift == 'Shift' && $bulan == 'Bulan' && $tahun != 'Tahun') {
            // $shift = '';
            // $bulan = '';
            $show = DB::table('tindakan_harian_perawat')
                ->join('logperawat', 'logperawat.id', '=', 'tindakan_harian_perawat.pernyataan')
                ->select('tindakan_harian_perawat.nama','tindakan_harian_perawat.unit','logperawat.pertanyaan',DB::raw('SUM(tindakan_harian_perawat.jawaban) as total_jawaban'))
                ->orderBy('tindakan_harian_perawat.tgl','DESC')
                ->whereYear('tindakan_harian_perawat.tgl', $tahun)
                ->where('tindakan_harian_perawat.deleted_at', null)
                ->where('tindakan_harian_perawat.jawaban','!=', '0')
                ->groupBy('tindakan_harian_perawat.nama','tindakan_harian_perawat.unit','logperawat.pertanyaan')
                ->get();
        } elseif ($shift == 'Shift' && $bulan != 'Bulan' && $tahun == 'Tahun') {
            // $shift = '';
            // $tahun = '';
            $show = DB::table('tindakan_harian_perawat')
                ->join('logperawat', 'logperawat.id', '=', 'tindakan_harian_perawat.pernyataan')
                ->select('tindakan_harian_perawat.nama','tindakan_harian_perawat.unit','logperawat.pertanyaan',DB::raw('SUM(tindakan_harian_perawat.jawaban) as total_jawaban'))
                ->orderBy('tindakan_harian_perawat.tgl','DESC')
                ->whereMonth('tindakan_harian_perawat.tgl', $bulan)
                ->where('tindakan_harian_perawat.deleted_at', null)
                ->where('tindakan_harian_perawat.jawaban','!=', '0')
                ->groupBy('tindakan_harian_perawat.nama','tindakan_harian_perawat.unit','logperawat.pertanyaan')
                ->get();
        } elseif ($shift != 'Shift' && $bulan == 'Bulan' && $tahun == 'Tahun') {
            // $bulan = '';
            // $tahun = '';
            $show = DB::table('tindakan_harian_perawat')
                ->join('logperawat', 'logperawat.id', '=', 'tindakan_harian_perawat.pernyataan')
                ->select('tindakan_harian_perawat.nama','tindakan_harian_perawat.unit','logperawat.pertanyaan',DB::raw('SUM(tindakan_harian_perawat.jawaban) as total_jawaban'))
                ->orderBy('tindakan_harian_perawat.tgl','DESC')
                ->where('tindakan_harian_perawat.shift', $shift)
                ->where('tindakan_harian_perawat.deleted_at', null)
                ->where('tindakan_harian_perawat.jawaban','!=', '0')
                ->groupBy('tindakan_harian_perawat.nama','tindakan_harian_perawat.unit','logperawat.pertanyaan')
                ->get();
        }

        elseif ($shift == 'Shift' && $bulan != 'Bulan' && $tahun != 'Tahun') {
            // $shift = '';
            $show = DB::table('tindakan_harian_perawat')
                ->join('logperawat', 'logperawat.id', '=', 'tindakan_harian_perawat.pernyataan')
                ->select('tindakan_harian_perawat.nama','tindakan_harian_perawat.unit','logperawat.pertanyaan',DB::raw('SUM(tindakan_harian_perawat.jawaban) as total_jawaban'))
                ->orderBy('tindakan_harian_perawat.tgl','DESC')
                ->whereMonth('tindakan_harian_perawat.tgl', $bulan)
                ->whereYear('tindakan_harian_perawat.tgl', $tahun)
                ->where('tindakan_harian_perawat.deleted_at', null)
                ->where('tindakan_harian_perawat.jawaban','!=', '0')
                ->groupBy('tindakan_harian_perawat.nama','tindakan_harian_perawat.unit','logperawat.pertanyaan')
                ->get();
        } elseif ($shift != 'Shift' && $bulan == 'Bulan' && $tahun != 'Tahun') {
            // $bulan = '';
            $show = DB::table('tindakan_harian_perawat')
                ->join('logperawat', 'logperawat.id', '=', 'tindakan_harian_perawat.pernyataan')
                ->select('tindakan_harian_perawat.nama','tindakan_harian_perawat.unit','logperawat.pertanyaan',DB::raw('SUM(tindakan_harian_perawat.jawaban) as total_jawaban'))
                ->orderBy('tindakan_harian_perawat.tgl','DESC')
                ->where('tindakan_harian_perawat.shift', $shift)
                ->whereYear('tindakan_harian_perawat.tgl', $tahun)
                ->where('tindakan_harian_perawat.deleted_at', null)
                ->where('tindakan_harian_perawat.jawaban','!=', '0')
                ->groupBy('tindakan_harian_perawat.nama','tindakan_harian_perawat.unit','logperawat.pertanyaan')
                ->get();
        } elseif ($shift != 'Shift' && $bulan != 'Bulan' && $tahun == 'Tahun') {
            // $tahun = '';
            $show = DB::table('tindakan_harian_perawat')
                ->join('logperawat', 'logperawat.id', '=', 'tindakan_harian_perawat.pernyataan')
                ->select('tindakan_harian_perawat.nama','tindakan_harian_perawat.unit','logperawat.pertanyaan',DB::raw('SUM(tindakan_harian_perawat.jawaban) as total_jawaban'))
                ->orderBy('tindakan_harian_perawat.tgl','DESC')
                ->where('tindakan_harian_perawat.shift', $shift)
                ->whereMonth('tindakan_harian_perawat.tgl', $bulan)
                ->where('tindakan_harian_perawat.deleted_at', null)
                ->where('tindakan_harian_perawat.jawaban','!=', '0')
                ->groupBy('tindakan_harian_perawat.nama','tindakan_harian_perawat.unit','logperawat.pertanyaan')
                ->get();
        }
            
        // print_r($show[0][0]->shift);
        // die();

        $data = [
            'show' => $show,
            'shift' => $shift,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'thn' => $thn,
        ];

        return view('pages.logperawat.tindakan_harian.cari')->with('list', $data);
    }

    // API
    public function table()
    {
        $now = Carbon::now();

        $thn = Carbon::now()->isoFormat('YYYY');
        $today = Carbon::now()->isoFormat('YYYY/MM/DD');

        $user = Auth::user();
        $id_user = $user->id;
        $name = $user->name;
        $unit = $user->roles;

        $showAll = tindakan_harian::all();

        if (Auth::user()->hasRole('kabag-keperawatan')) {
            $show = tindakan_harian::select('queue','shift','nama','unit','tgl')->groupBy('queue','shift','nama','unit','tgl')->orderBy('tgl','desc')->get();
            $pernyataan = null;
        }
        else {
            $get_pernyataan = logperawat::orderBy('updated_at','DESC')->get();
            
            // GET ROLE
            foreach ($unit as $key => $value) {
                foreach ($get_pernyataan as $py => $item) {
                    if ($value->name == $item->unit) {
                        $array_pernyataan[] = $item->id;
                    }
                }
                $role[] = $value->name;
            }
            
            // GET DATA
            $getId = [];
            if (count($showAll) > 0) {
                foreach ($showAll as $key => $value) {
                    $arr = json_decode($value->unit);
                    foreach ($arr as $ky => $val) {
                        foreach ($role as $gt => $item) {
                            // print_r($val);
                            if ($val == $item) {
                                $getId[] = $value->id;
                            }
                        }
                    }
                }
            } else {
                $show = $showAll;
            }

            // JIKA USER BELUM PERNAH MEMASUKKAN TINDAKAN HARIAN
            if (!empty($getId)) {
                $show = tindakan_harian::whereIn('id', $getId)->select('queue','shift','nama','unit','tgl')->groupBy('queue','shift','nama','unit','tgl')->orderBy('tgl','desc')->get();
            } else {
                $show = tindakan_harian::where('id_user', $id_user)->select('queue','shift','nama','unit','tgl')->groupBy('queue','shift','nama','unit','tgl')->orderBy('tgl','desc')->get();
            }
        }

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }
}

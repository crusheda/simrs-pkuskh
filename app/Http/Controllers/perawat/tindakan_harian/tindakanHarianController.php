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

            $pernyataan = logperawat::whereIn('id', $array_pernyataan)->get();
        }   
        
        // print_r($showEdit);
        // die();

        $data = [
            // 'users' => $users,
            'show' => $show,
            'show_all' => $showAll,
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
        
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');
        
        $time= 'Bulan : '.$bulan.' Tahun : '.$tahun;
        
        $user = DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('users.*')
                ->where('roles.name', 'ibs')
                ->get();

        $show = DB::table('ibs_supervisi')
                ->join('ibs_has_tim', 'ibs_supervisi.id_tim', '=', 'ibs_has_tim.id_tim')
                ->select('ibs_supervisi.id_tim as tim','ibs_has_tim.shift','ibs_has_tim.tgl_mulai','ibs_has_tim.tgl_selesai')
                ->orderBy('ibs_supervisi.tgl','DESC')
                ->whereMonth('ibs_supervisi.created_at', $bulan)
                ->whereYear('ibs_supervisi.created_at', $tahun)
                ->where('ibs_has_tim.tgl_selesai', '!=', null)
                ->where('ibs_supervisi.deleted_at', null)
                ->where('ibs_has_tim.deleted_at', null)
                ->groupBy('ibs_supervisi.id_tim','ibs_has_tim.shift','ibs_has_tim.tgl_mulai','ibs_has_tim.tgl_selesai')
                ->get();
                
        $showtim = DB::table('ibs_has_tim')
                ->join('users', 'users.id', '=', 'ibs_has_tim.id_user')
                ->select('users.*','ibs_has_tim.id_tim','ibs_has_tim.shift','ibs_has_tim.tgl_mulai','ibs_has_tim.tgl_selesai')
                ->where('ibs_has_tim.deleted_at', null)
                ->get();
                
        $get_data = DB::table('ibs_supervisi')
                ->join('ibs_refsupervisi','ibs_supervisi.id_supervisi','=','ibs_refsupervisi.id')
                ->select('ibs_supervisi.id','ibs_supervisi.id_supervisi','ibs_refsupervisi.supervisi as nama_supervisi','ibs_refsupervisi.ruang as nama_ruang','ibs_supervisi.id_tim as kodetim','ibs_supervisi.kondisi','ibs_supervisi.ket','ibs_supervisi.title','ibs_supervisi.filename','ibs_supervisi.tgl','ibs_supervisi.id_user')
                ->where('ibs_supervisi.deleted_at', null)
                ->whereMonth('ibs_supervisi.created_at', $bulan)
                ->whereYear('ibs_supervisi.created_at', $tahun)
                ->orderBy('ibs_refsupervisi.id', 'ASC')
                ->get();
                
        // print_r($show);
        // die();

        $data = [
            'getdata' => $get_data,
            'time' => $time,
            'thn' => $thn,
            'user' => $user,
            'showtim' => $showtim,
            'show' => $show
        ];

        return view('pages.ibs.supervisi.cari')->with('list', $data);
    }
}

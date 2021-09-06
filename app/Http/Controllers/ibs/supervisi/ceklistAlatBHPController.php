<?php

namespace App\Http\Controllers\ibs\supervisi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\ibs\ibs_refsupervisi;
use App\Models\ibs\ibs_supervisi;
use App\Models\ibs\ibs_has_tim;
use App\Models\user;
use Carbon\Carbon;
use Storage;
use Response;
use Auth;

class ceklistAlatBHPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $id_user = $user->id;
        $name_user = $user->name;

        $today = Carbon::now();
        $now = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');
        $thn = Carbon::now()->isoFormat('YYYY');
        // $show = ibs_supervisi::orderBy('tgl','DESC')->limit('20')->groupBy('')->get();
        $timIbs = ibs_has_tim::orderBy('id_tim', 'DESC')->first();

        if (empty($timIbs)) {
            $kodetim = 1;
        } else {
            $kodetim = $timIbs->id_tim + 1;
        }

        $user = DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('users.*')
                ->where('roles.name', 'ibs')
                ->get();

            if ($name_user == 'adik18') {
                $show = DB::table('ibs_supervisi')
                        ->join('ibs_has_tim', 'ibs_supervisi.id_tim', '=', 'ibs_has_tim.id_tim')
                        ->select('ibs_supervisi.id_tim as tim','ibs_has_tim.shift','ibs_has_tim.tgl_mulai','ibs_has_tim.tgl_selesai')
                        ->where('ibs_supervisi.deleted_at', null)
                        ->where('ibs_has_tim.deleted_at', null)
                        // ->orderBy('tgl','DESC')
                        // ->limit('20')
                        ->groupBy('ibs_supervisi.id_tim','ibs_has_tim.shift','ibs_has_tim.tgl_mulai','ibs_has_tim.tgl_selesai')
                        ->get();
            } else {
                $show = DB::table('ibs_supervisi')
                        ->join('ibs_has_tim', 'ibs_supervisi.id_tim', '=', 'ibs_has_tim.id_tim')
                        ->select('ibs_supervisi.id_tim as tim','ibs_has_tim.shift','ibs_has_tim.tgl_mulai','ibs_has_tim.tgl_selesai')
                        ->where('ibs_supervisi.deleted_at', null)
                        ->where('ibs_has_tim.deleted_at', null)
                        // ->orderBy('tgl','DESC')
                        ->where('user', $id_user)
                        // ->limit('20')
                        ->groupBy('ibs_supervisi.id_tim','ibs_has_tim.shift','ibs_has_tim.tgl_mulai','ibs_has_tim.tgl_selesai')
                        ->get();
            }
                        
        $showtim = DB::table('ibs_has_tim')
                ->join('users', 'users.id', '=', 'ibs_has_tim.id_user')
                ->select('users.*','ibs_has_tim.id_tim','ibs_has_tim.shift','ibs_has_tim.tgl_mulai','ibs_has_tim.tgl_selesai')
                ->where('ibs_has_tim.deleted_at', null)
                ->get();
                
        $get_data = DB::table('ibs_supervisi')
                ->join('ibs_refsupervisi','ibs_supervisi.id_supervisi','=','ibs_refsupervisi.id')
                ->select('ibs_supervisi.id','ibs_supervisi.id_supervisi','ibs_refsupervisi.supervisi as nama_supervisi','ibs_refsupervisi.ruang as nama_ruang','ibs_supervisi.id_tim as kodetim','ibs_supervisi.kondisi','ibs_supervisi.ket','ibs_supervisi.title','ibs_supervisi.filename','ibs_supervisi.tgl','ibs_supervisi.id_user')
                ->where('ibs_supervisi.deleted_at', null)
                ->orderBy('ibs_refsupervisi.id', 'ASC')
                ->get();

        $query_minus = "SELECT id_tim as tim,count(id_tim) as jumlah FROM ibs_supervisi WHERE kondisi IS NULL AND deleted_at IS NULL GROUP BY id_tim,id_tim";
        $minus = DB::select($query_minus);

        // print_r($show);
        // die();

        $data = [
            'getdata' => $get_data,
            'today' => $today,
            'now' => $now,
            'thn' => $thn,
            'user' => $user,
            'minus' => $minus,
            'kodetim' => $kodetim,
            'showtim' => $showtim,
            'show' => $show
        ];

        // print_r($show);
        // die();

        return view('pages.ibs.supervisi.index')->with('list', $data);
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
        $data = ibs_supervisi::find($id);
        return Storage::download($data->filename, $data->title);
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

    public function pushTim(Request $request)
    {
        $this->validate($request,[
            'kodetim' => 'required',
            'shift' => 'required',
            ]);

        $user = Auth::user();
        $id_user = $user->id;

        $kodetim = $request->kodetim;
        $shift = $request->shift;

        $ruang = ibs_refsupervisi::select('ruang')->orderBy('id', 'ASC')->groupBy('ruang')->get();
        $show = ibs_refsupervisi::get();
        $user = DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('users.*')
                ->where('roles.name', 'ibs')
                ->get();
        $today = Carbon::now();
        $cekData = ibs_has_tim::where('id_tim', $kodetim)->where('shift', $shift)->first();
        // print_r($cekData);
        // die();
        if (empty($cekData)) {
            foreach ($request->tim as $key => $value) {
                $data = new ibs_has_tim;
                $data->id_tim = $kodetim;
                $data->id_user = $value;
                $data->shift = $shift;
                $data->tgl_mulai = $today;
                $data->user = $id_user;
                $data->save();
            }
            foreach ($show as $key => $value) {
                $data = new ibs_supervisi;
                $data->id_supervisi = $value->id;
                $data->id_tim = $kodetim;
                $data->save();
            }
        }
        
        $showtim = DB::table('ibs_has_tim')
                ->join('users', 'users.id', '=', 'ibs_has_tim.id_user')
                ->select('users.*','ibs_has_tim.shift','ibs_has_tim.tgl_mulai')
                ->where('id_tim', $kodetim)
                ->where('shift', $shift)
                ->get();

        $getData = ibs_has_tim::where('id_tim', $kodetim)->where('shift', $shift)->first();
        $getLampiran = ibs_supervisi::where('id_tim', $kodetim)->get();
        // print_r($showtim);
        // die();

        $data = [
            'cekdata' => $getData,
            'tim' => $kodetim,
            'shift' => $shift,
            'showtim' => $showtim,
            'getLampiran' => $getLampiran,
            'ruang' => $ruang,
            'user' => $user,
            'show' => $show
        ];

        return view('pages.ibs.supervisi.cekalat')->with('list', $data);
    }

    public function kondisiAlat($tim)
    {
        $get_data = DB::table('ibs_supervisi')
                    ->join('ibs_refsupervisi','ibs_supervisi.id_supervisi','=','ibs_refsupervisi.id')
                    ->select('ibs_supervisi.id','ibs_supervisi.id_supervisi','ibs_refsupervisi.supervisi as nama_supervisi','ibs_refsupervisi.ruang as nama_ruang','ibs_supervisi.id_tim as kodetim','ibs_supervisi.kondisi','ibs_supervisi.ket','ibs_supervisi.title as title','ibs_supervisi.filename as filename')
                    ->where('ibs_supervisi.id_tim', $tim)
                    ->where('ibs_supervisi.deleted_at', null)
                    ->orderBy('ibs_refsupervisi.id', 'ASC')
                    ->get();

        $data = [
            'show' => $get_data,
        ];

        return response()->json($data, 200);
    }

    public function kondisi(Request $request)
    {
        $user = Auth::user();
        $id_user = $user->id;
        $now = Carbon::now();
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm:ss a');

            $data = ibs_supervisi::find($request->id);
            $data->kondisi = $request->kondisi;
            // $data->ket = $request->ket;
            $data->id_user = $id_user;
            $data->tgl = $now;
            $data->save();

        return response()->json($tgl, 200);
    }

    public function ket(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm:ss a');

        $data = ibs_supervisi::find($request->id);
        $data->ket = $request->ket;
        $data->save();

        return response()->json($tgl, 200);
    }

    public function lampiran(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm:ss a');

        $uploadedFile = $request->file('fileToUpload'); 

        $title = $uploadedFile->getClientOriginalName();
        $path = $uploadedFile->storeAs("public/files/ibs/ceklist_alat_bhp/lampiran/", $title);
        // print_r($path);
        // die();
        
        $data = ibs_supervisi::find($request->id);
        $data->title = $title;
        $data->filename = $path;
        $data->save();

        return response()->json($tgl, 200);
    }

    public function showLampiran($tim)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm:ss a');
        $now = Carbon::now();

        $get_data1 = ibs_supervisi::where('id_tim', $tim)->get();
        $get_data2 = ibs_has_tim::where('id_tim', $tim)->get();

        foreach ($get_data1 as $key => $value) {
            ibs_supervisi::where('id_tim',$value->id_tim)->delete();
        }
        foreach ($get_data2 as $key => $value) {
            ibs_has_tim::where('id_tim',$value->id_tim)->delete();
        }

        return response()->json($tgl, 200);
    }

    public function batalCek($tim)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm:ss a');
        $now = Carbon::now();

        $get_data1 = ibs_supervisi::where('id_tim', $tim)->get();
        $get_data2 = ibs_has_tim::where('id_tim', $tim)->get();

        foreach ($get_data1 as $key => $value) {
            ibs_supervisi::where('id_tim',$value->id_tim)->delete();
        }
        foreach ($get_data2 as $key => $value) {
            ibs_has_tim::where('id_tim',$value->id_tim)->delete();
        }

        return response()->json($tgl, 200);
    }

    public function selesaiCek($tim)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm:ss a');
        $now = Carbon::now();

        DB::table('ibs_has_tim')->where('id_tim',$tim)->update(array('tgl_selesai' => $now));
        // $data = ibs_supervisi::where('id_tim',$id);
        // $data->tgl_selesai = $now;
        // $data->save();

        return response()->json($tgl, 200);
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

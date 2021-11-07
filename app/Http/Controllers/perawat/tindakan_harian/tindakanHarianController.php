<?php

namespace App\Http\Controllers\perawat\tindakan_harian;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\logperawat\tindakan_harian;
use App\Models\logperawat;
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

        $users = DB::table('users')->get();
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
            // $arr[] = json_decode($showAll[0]->unit);
            
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
                // die();
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
}

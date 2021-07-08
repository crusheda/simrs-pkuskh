<?php

namespace App\Http\Controllers\lab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\antigen;
use App\Models\dokter;
use Carbon\Carbon;
use Exception;
use Redirect;
use Storage;
use Auth;
use \PDF;

class antigenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now()->isoFormat('YYYY-MM-DD HH:mm:ss');
        // $tgl = Carbon::parse($data->tgl)->isoFormat('%Y-%m-%dT%H:%M:%S');
        // $now = Carbon::now()->isoFormat('%Y-%m-%dT%H:%M:%S');
        // $now = Carbon::createFromFormat('Y-m-d', $tgl);
        $dokter = dokter::get();
        $show = DB::table('antigen')
                ->join('dokter', 'dokter.id', '=', 'antigen.dr_pengirim')
                ->where('antigen.deleted_at',null)
                ->select('dokter.id as dr_id','dokter.nama as dr_nama','dokter.jabatan as dr_jabatan','antigen.*')
                ->orderBy('tgl','DESC')
                ->limit('30')
                ->get();

        $data = [
            'show' => $show,
            'dokter' => $dokter,
            'now' => $now
        ];

        // print_r($data['show']);
        // die();
        return view('pages.lab.antigen')->with('list', $data);
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
        $user_id = $user->id;

        $pj = 'dr. Endang Tri Peterani, Sp.PK';

        $data = new antigen;
        $data->dr_pengirim  = $request->dr_pengirim;
        $data->pemeriksa  = $request->pemeriksa;
        $data->rm           = $request->rm;
        $data->nama         = $request->nama;
        $data->jns_kelamin  = $request->jns_kelamin;
        $data->umur         = $request->umur;
        $data->alamat       = $request->alamat.', '.strtoupper($request->kec).', '.strtoupper($request->kab);
        $data->tgl          = $request->tgl;
        $data->hasil        = $request->hasil;
        $data->pj           = $pj;
        $data->user_id      = $user_id;
        
        $data->save();
        return redirect::back()->with('message','Hasil Antigen Berhasil Ditambahkan a/n '.$request->nama);
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
        $data = antigen::find($id);

        $data->dr_pengirim  = $request->dr_pengirim;
        $data->pemeriksa  = $request->pemeriksa;
        // $data->rm           = $request->rm;
        // $data->nama         = $request->nama;
        // $data->jns_kelamin  = $request->jns_kelamin;
        // $data->umur         = $request->umur;
        // $data->alamat       = $request->alamat;
        $data->tgl          = $request->tgl;
        $data->hasil        = $request->hasil;
        
        $data->save();
        return redirect::back()->with('message','Ubah Hasil Antigen Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = antigen::find($id);
        $data->delete();

        return redirect::back()->with('message','Hapus Hasil Antigen Berhasil');
    }

    public function cetak($id)
    {
        $data = antigen::where('id',$id)->first();

        // 1 = dr. Gede Sri Dhyana, Sp.OG
        // 2 = dr. H. Ahmad Sutamat, Sp.OG
        $nama = $data->nama;
        $tgl = Carbon::parse($data->tgl)->isoFormat('DD/MM/YYYY HH:mm');
        // print_r($tgl);
        // die();

        if ($data->hasil == 'POSITIF') {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path().'/doc/lab/antigen/antigen-positif.docx');
        }elseif ($data->hasil == 'NEGATIF') {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path().'/doc/lab/antigen/antigen-negatif.docx');
        }else {
            return redirect('lab/antigen')->withErrors('Gagal Unduh Laporan');
        }
        $tgl_name = Carbon::parse($data->tgl)->isoFormat('DD MMM YYYY');
        $file_name = 'Antigen '.$nama.' '.$tgl_name;
        // $filename = 'Antigen RSPKUSKH';
        $filename = str_replace(array('"', "'", ' ', ','), '_', $file_name);;

        $dokter = dokter::where('id',(int)$data->dr_pengirim)->first();
        // print_r($dokter);
        // die();
        $templateProcessor->setValues([
            'dr_pengirim' => $dokter->nama,
            'pemeriksa' => $data->pemeriksa,
            'rm' => $data->rm,
            'nama' => $nama,
            'jns_kelamin' => $data->jns_kelamin,
            'umur' => $data->umur,
            'alamat' => $data->alamat,
            'tgl' => $tgl,
        ]);

        header("Content-Disposition: attachment; filename=$filename.docx");

        $templateProcessor->saveAs('php://output');
    }

    public function print($id)
    {
        $show = DB::table('antigen')
                ->join('dokter', 'dokter.id', '=', 'antigen.dr_pengirim')
                ->where('antigen.deleted_at',null)
                ->where('antigen.id',$id)
                ->select('dokter.id as dr_id','dokter.nama as dr_nama','dokter.jabatan as dr_jabatan','antigen.*')
                ->first();
                
        // $dokter = dokter::where('id',(int)$show->dr_pengirim)->first();
        $tgl = Carbon::parse($show->tgl)->isoFormat('DD/MM/YYYY HH:mm');

        $data = [
            'show' => $show,
            // 'dokter' => $dokter,
            'tgl' => $tgl
        ];

        // print_r($data);
        // die();
        return view('pages.lab.cetak-antigen')->with('list', $data);
    }

    public function showAll()
    {
        $dokter = dokter::get();
        $show = DB::table('antigen')
                ->join('dokter', 'dokter.id', '=', 'antigen.dr_pengirim')
                ->where('antigen.deleted_at',null)
                ->select('dokter.id as dr_id','dokter.nama as dr_nama','dokter.jabatan as dr_jabatan','antigen.*')
                ->orderBy('tgl','DESC')
                ->get();

        $data = [
            'show' => $show,
            'dokter' => $dokter
        ];

        return view('pages.lab.antigen-all')->with('list', $data);
    }
}

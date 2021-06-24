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
        $dokter = dokter::get();
        $show = DB::table('antigen')
                ->join('dokter', 'dokter.id', '=', 'antigen.dr_pengirim')
                ->select('dokter.id as dr_id','dokter.nama as dr_nama','dokter.jabatan as dr_jabatan','antigen.*')
                ->get();

        $data = [
            'show' => $show,
            'dokter' => $dokter
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
        $data->rm           = $request->rm;
        $data->nama         = $request->nama;
        $data->jns_kelamin  = $request->jns_kelamin;
        $data->umur         = $request->umur;
        $data->alamat       = $request->alamat;
        $data->tgl          = $request->tgl;
        $data->hasil        = $request->hasil;
        $data->pj           = $pj;
        $data->user_id      = $user_id;
        
        $data->save();
        return redirect::back()->with('message','Tambah Hasil Antigen Berhasil');
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
        
        // $filename = 'Antigen '.$nama.' - '.$tgl;
        $filename = 'Antigen RSPKUSKH';

        $dokter = dokter::where('id',(int)$data->dr_pengirim)->first();
        // print_r($dokter);
        // die();
        $templateProcessor->setValues([
            'dr_pengirim' => $dokter->nama,
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
}

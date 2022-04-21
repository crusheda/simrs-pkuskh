<?php

namespace App\Http\Controllers\kebidanan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\skl;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use Auth;
use \PDF;

class sklController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = skl::limit(30)->orderBy('no_surat', 'DESC')->get();
        
        $query = skl::orderBy('no_surat', 'DESC')->first();
        if ($query != null) {
            $nomer = $query->no_surat + 1;
        } else {
            $nomer = 1;
        }

        $data = [
            'show' => $show,
            'nomer' => $nomer
        ];

        // print_r($data);
        // die();

        return view('pages.new.kebidanan.skl')->with('list', $data);
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
        $name = $user->name;
        $tgl = Carbon::parse($request->tgl); 

        $query = skl::orderBy('no_surat', 'DESC')->first();
        if ($query != null) {
            $nomer = $query->no_surat + 1;
        } else {
            $nomer = 1;
        }
        // ex : $user->created_at->isoFormat('dddd, D MMMM Y');      "Minggu, 28 Juni 2020"
        // ex : $post->updated_at->diffForHumans();                  "2 hari yang lalu"

        // print_r($nomer);
        // die();

        $data = new skl;
        $data->no_surat = $nomer;
        $data->tgl = $tgl;
        $data->hari = $tgl->isoFormat('dddd');
        $data->ibu = $request->ibu;
        $data->ayah = $request->ayah;
        $data->anak = $request->anak;
        $data->kelamin = $request->kelamin;
        $data->bb = $request->bb;
        $data->tb = $request->tb;
        $data->alamat = $request->alamat;
        $data->dr = $request->dr;
        $data->user = $name;
        
        $data->save();
        return redirect('/kebidanan/skl')->with('message','Tambah SKL Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = skl::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = skl::find($id);
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
        $data = skl::find($id);
        $tgl = Carbon::parse($request->tgl);

        $data->no_surat = $request->no_surat;
        $data->tgl = $tgl;
        $data->hari = $tgl->isoFormat('dddd');
        $data->ibu = $request->ibu;
        $data->ayah = $request->ayah;
        $data->anak = $request->anak;
        $data->kelamin = $request->kelamin;
        $data->bb = $request->bb;
        $data->tb = $request->tb;
        $data->alamat = $request->alamat;
        $data->dr = $request->dr;

        $data->save();

        return redirect('/kebidanan/skl')->with('message','Perubahan Identitas Bayi Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = skl::find($id);
        $data->delete();

        // redirect
        return redirect('/kebidanan/skl')->with('message','Hapus Identitas Bayi Berhasil');
    }

    public function showAll()
    {
        return view('pages.new.kebidanan.skl-all');
    }

    public function apiAll()
    {
        $show = skl::orderBy('no_surat', 'DESC')->get();
        
        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    public function cetak($id)
    {
        $data = skl::where('id',$id)->first();

        // 1 = dr. Gede Sri Dhyana, Sp.OG
        // 2 = dr. H. Ahmad Sutamat, Sp.OG
        
        $tgl = Carbon::parse($data->tgl)->isoFormat('D MMMM Y');
        $thn = Carbon::parse($data->tgl)->isoFormat('Y');
        $jam = Carbon::parse($data->tgl)->toTimeString();

        if ($data->dr == 1) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path().'/doc/kebidanan/skl-gede.docx');
        }elseif ($data->dr == 2) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path().'/doc/kebidanan/skl-ahmad.docx');
        }elseif ($data->dr == 3) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path().'/doc/kebidanan/skl-febrian.docx');
        }elseif ($data->dr == null) {
            return redirect('/kebidanan/skl')->with('message','Maaf, Input Dokter Belum Terisi');
        }
        
        $filename = "SKL ";
        // .$data->no_surat." - ".$data->ibu

        $templateProcessor->setValues([
            'no_surat' => $data->no_surat,
            'hari' => $data->hari,
            'tgl' => $tgl,
            'thn' => $thn,
            'jam' => $jam,
            'kelamin' => $data->kelamin,
            'ibu' => $data->ibu,
            'ayah' => $data->ayah,
            'alamat' => $data->alamat,
            'anak' => $data->anak,
            'bb' => $data->bb,
            'tb' => $data->tb,
        ]);

        header("Content-Disposition: attachment; filename=$filename.docx");

        $templateProcessor->saveAs('php://output');
    }

    public function print($id)
    {
        $show = skl::where('id',$id)->first();
                
        $tgl = Carbon::parse($show->tgl)->isoFormat('D MMMM Y');
        $thn = Carbon::parse($show->tgl)->isoFormat('Y');
        $jam = Carbon::parse($show->tgl)->toTimeString();

        $data = [
            'show' => $show,
            'tgl' => $tgl,
            'thn' => $thn,
            'jam' => $jam,
        ];

        // print_r($data);
        // die();
        return view('pages.kebidanan.skl.cetak-skl')->with('list', $data);
    }
}

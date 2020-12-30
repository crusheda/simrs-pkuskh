<?php

namespace App\Http\Controllers\kebidanan;

use App\Http\Controllers\Controller;
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
        $show = skl::get();

        $data = [
            'show' => $show
        ];

        return view('pages.kebidanan.skl.index')->with('list', $data);
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

        // ex : $user->created_at->isoFormat('dddd, D MMMM Y');      "Minggu, 28 Juni 2020"
        // ex : $post->updated_at->diffForHumans();                  "2 hari yang lalu"

        $data = new skl;
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

    public function cetak($id)
    {
        $data = skl::where('id',$id)->first();

        // 1 = dr. Gede Sri Dhyana, Sp.OG
        // 2 = dr. H. Ahmad Sutamat, Sp.OG
        
        $tgl = Carbon::parse($data->tgl)->isoFormat('D MMMM Y');
        $jam = Carbon::parse($data->tgl)->toTimeString();

        if ($data->dr == 1) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('doc\kebidanan\skl-gede.docx');
        }elseif ($data->dr == 2) {
            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('doc\kebidanan\skl-ahmad.docx');
        }else {
            return redirect('/kebidanan/skl')->with('message','Maaf, Input Dokter Belum Terisi');
        }
        
        $filename = "SKL - Ny. ".$data->ibu." - ".$tgl;

        $templateProcessor->setValues([
            'no_surat' => $data->no_surat,
            'hari' => $data->hari,
            'tgl' => $tgl,
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
}

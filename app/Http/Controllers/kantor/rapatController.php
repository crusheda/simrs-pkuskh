<?php

namespace App\Http\Controllers\kantor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use Redirect;
use Auth;
use ZipArchive;
use Carbon\Carbon;
use App\Models\rapat;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class rapatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = rapat::all();
        // $total = karyawan::count();
        // $show = rapat::orderBy('created_at', 'DESC')->paginate(30);

        $data = [
            // 'count' => $total,
            'show' => $show
        ];
        return view('pages.kantor.rapat')->with('list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.kantor.tambah-berkas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'keterangan' => 'nullable',
            'title1' => 'nullable',
            'title2' => 'nullable',
            'title3' => 'nullable',
            'title4' => 'nullable',
            // 'file1' => 'required|file|max:100000',
            // 'file2' => 'required|file|max:100000',
            // 'file3' => 'required|file|max:100000',
            // 'file4' => 'required|file|max:100000',
            // 'file5' => 'required|file|max:100000',
            ]);

        $user = Auth::user();
        $id = $user->id;

        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile1 = $request->file('file1');
        $uploadedFile2 = $request->file('file2');
        $uploadedFile3 = $request->file('file3');
        $uploadedFile4 = $request->file('file4');        
        $uploadedFile5 = $request->file('file5');        

        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        $path1 = $uploadedFile1->store('public/files/notulen/undangan');
        $path3 = $uploadedFile3->store('public/files/notulen/absensi');
        $path4 = $uploadedFile4->store('public/files/notulen/notulen');
        $path5 = $uploadedFile5->store('public/files/notulen/dokumentasi');
        
        if ($request->hasFile('file2')) {
            foreach ($uploadedFile2 as $file) {
                $array_filename2[] = $file->store('public/files/notulen/materi');
                $array_title2[] = $file->getClientOriginalName();
            }
        }

        $data = new rapat;
        $data->nama = $request->nama;
        $data->kepala = $request->kepala;
        $data->tanggal = $request->tanggal;
        $data->lokasi = $request->lokasi;

            $data->title1 = $request->title1 ?? $uploadedFile1->getClientOriginalName();
            // $data->title2 = $request->title2 ?? $uploadedFile2->getClientOriginalName();
            $data->title2 = json_encode($array_title2);
            $data->title3 = $request->title3 ?? $uploadedFile3->getClientOriginalName();
            $data->title4 = $request->title4 ?? $uploadedFile4->getClientOriginalName();
            $data->title5 = $request->title5 ?? $uploadedFile5->getClientOriginalName();
            
            $data->filename1 = $path1;
            $data->filename2 = json_encode($array_filename2);
            $data->filename3 = $path3;
            $data->filename4 = $path4;
            $data->filename5 = $path5;

        $data->keterangan = $request->keterangan;
        $data->user_id = $id;
        // print_r($id);
        // die();
        $data->save();
        return redirect('/rapat')->with('message','Tambah Berkas Rapat Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = rapat::find($id);
        return Storage::download($data->filename1, $data->title1);
    }

    public function show2($id)
    {
        $data = rapat::find($id);
        return Storage::download($data->filename2, $data->title2);
    }

    public function show2all($id)
    {
        $data = DB::table('rapat')
                ->join('users', 'rapat.user_id', '=', 'users.id')
                ->select('users.name','rapat.created_at','rapat.filename2','rapat.title2')
                ->where('rapat.deleted_at', null)
                ->where('rapat.id', $id)
                ->get();

        $name = $data[0]->name;
        $tgl_materi = Carbon::parse($data[0]->created_at)->isoFormat('D MMM Y');

        // Text from DB Convert into Array First with JsonDECODE
        $files_mentah = json_decode($data[0]->filename2);
        $filename_mentah = json_decode($data[0]->title2);

        // Define Where ZIP will be Saved and Named
        $zip_path = storage_path().'/app/public/files/notulen/materi/multiple/'.$name.' - '.$tgl_materi.'.zip'; // Folder dibuat manual dulu
        $zip_name = $name.' - '.$tgl_materi.'.zip';

        // Making ZIP ARCHIVE
        $zip = new ZipArchive();        
        if ($zip->open($zip_path, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE) !== TRUE) {
            die ("An error occurred creating your ZIP file.");
        }
        
        // Looping with Foreach
        foreach ($files_mentah as $key => $file) {

            // Change DIR File from Array into String with JsonENCODE
            $files = json_encode($file);
            $filename_mentah2 = json_encode($filename_mentah[$key]);
            $filename = str_replace('"','',$filename_mentah2);     // Remove Quotes "" from Encoding Json 

            // Adding Path into String Each File From DB
            $path = storage_path().'/app/'.$file;
            $filepath = $path;

            // Checking File and Adding File
            if (file_exists($filepath)) {
                // $filepath = direktori file yang akan dimasukkan
                // $filename = nama file yang digunakan untuk mengganti nama file dari $filepath
                $zip->addFile($filepath, $filename) or die ("ERROR: Could not add the file $filename");
            } else {
                die("File $filename di Direktori $filepath doesnt exit");
            }
        }

        $zip->close();

        // Konten apa saja yang terkandung dalam ZIP (Contoh : PDF, Application, etc)
        $headers = ["Content-Type"=>"pdf/zip"];

        return response()->download($zip_path,$zip_name,$headers);
    }

    public function show3($id)
    {
        $data = rapat::find($id);
        return Storage::download($data->filename3, $data->title3);
    }

    public function show4($id)
    {
        $data = rapat::find($id);
        return Storage::download($data->filename4, $data->title4);
    }

    public function show5($id)
    {
        $data = rapat::find($id);
        return Storage::download($data->filename5, $data->title5);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = rapat::find($id);
        return view('pages.kantor.edit-notulen')->with('list', $data);
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
        $this->validate($request,[
            'nama' => 'required',
            'kepala' => 'nullable',
            'tanggal' => 'nullable',
            'lokasi' => 'nullable',
            'keterangan' => 'nullable',
            ]);

        $data = rapat::find($id);
        $data->nama = $request->nama;
        $data->kepala = $request->kepala;
        $data->tanggal = $request->tanggal;
        $data->lokasi = $request->lokasi;
        $data->keterangan = $request->keterangan;

        $data->save();
        return Redirect::back()->with('message','Perubahan Berkas Rapat Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = rapat::find($id);
        $data->delete();

        // redirect
        return \Redirect::to('/rapat')->with('message','Hapus Berkas Rapat Berhasil');
    }

    public function download(Request $id)
    {
        $data = rapat::find($id);
        $data->filename = $filename;
        $path = storage_path($filename);

        return response()->file($pathToFile, $headers);
    }

    public function apifile()
    {
        $show = rapat::all();
        // $total = karyawan::count();
        // $show = rapat::orderBy('created_at', 'DESC')->paginate(30);

        $data = [
            // 'count' => $total,
            'show' => $show
        ];

        return response()->json($show, 200);
    }
}

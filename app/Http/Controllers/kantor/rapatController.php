<?php

namespace App\Http\Controllers\kantor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use Redirect;
use Auth;
use File;
use Validator;
use ZipArchive;
use Carbon\Carbon;
use App\Models\rapat;
use App\Models\user;
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
        $user = user::whereNotNull('nik')->where('status',null)->get();
        $tgl = Carbon::now();
        $today = Carbon::now()->isoFormat('YYYY/MM/DD');
        // $total = karyawan::count();
        // $show = rapat::orderBy('created_at', 'DESC')->paginate(30);

        $data = [
            // 'count' => $total,
            'show' => $show,
            'user' => $user,
            'tgl' => $tgl,
            'today' => $today,
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
        $request->validate([
            'keterangan' => 'nullable',
            // 'file2' => 'required',
            'file2.*' => ['required','mimes:doc,docx,xls,xlsx,ppt,pptx,pdf,jpg,gif,png,jpeg','max:50000'],
            ]);
        // request()->validate([
        //     'file' => 'required',
        //     'file.*' => 'mimes:doc,pdf,docx,txt,zip,jpeg,jpg,png'
        // ]);
        // print_r($request->file2);
        // die();
        // $this->validate($request,['file2' => ['required','mimes:doc,docx,xls,xlsx,ppt,pptx,pdf','max:50000']]);

        $user = Auth::user();
        $id_user = $user->id;
        $nama_user = $user->nama;

        $uploadedFile2 = $request->file('file2');
        
        if ($request->hasFile('file2')) {
            foreach ($uploadedFile2 as $file) {
                $array_filename2[] = $file->store('public/files/rapat/'.$id_user);
                $array_title2[] = $file->getClientOriginalName();
            }
        }

        $data = new rapat;
        $data->id_user = $id_user;
        $data->nama_user = $nama_user;
        $data->nama = $request->nama;
        $data->kepala = $request->kepala;
        $data->tanggal = $request->tanggal;
        $data->lokasi = $request->lokasi;

            $data->title2 = json_encode($array_title2);
            $data->filename2 = json_encode($array_filename2);

        $data->keterangan = $request->keterangan;
        $data->user_id = $id_user;
        // print_r($id);
        // die();
        $data->save();
        
        return redirect()->back()->with('message','Tambah Berkas Rapat Berhasil');
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
        
        // Name File ZIP
        $zip_name = $name.' - '.$tgl_materi.'.zip';

        // Making ZIP ARCHIVE
        $zip = new ZipArchive();        
        if ($zip->open($zip_path, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE) !== TRUE) {
            die ("Error saat proses pembuatan ZIP, silakan hubungi IT");
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

    public function showAll($id)
    {
        $data = rapat::where('id', $id)->first();

        $name = $data->nama_user;
        $tgl = Carbon::parse($data->created_at)->isoFormat('D MMM Y');

        // Text from DB Convert into Array First with JsonDECODE
        $files_mentah = json_decode($data->filename2);
        $filename_mentah = json_decode($data->title2);

        // Define Where ZIP will be Saved and Named
        $zip_path = storage_path().'/app/public/files/rapat/'.$data->id_user.'/zip'.'/'.$name.' - '.$tgl.'.zip'; // Folder dibuat manual dulu
        $zip_name = $name.' - '.$tgl.'.zip';

        // Check if Folder exist
        $path_folder_zip = storage_path().'/app/public/files/rapat/'.$data->id_user.'/zip';
        if(!File::exists($path_folder_zip)) {
            // Make Directory for ZIP
            File::makeDirectory($path_folder_zip);
        }

        // Making ZIP ARCHIVE
        $zip = new ZipArchive();
        if ($zip->open($zip_path, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE) !== TRUE) {
            die ("ERROR: Saat proses pembuatan ZIP, silakan hubungi IT");
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
                $zip->addFile($filepath, $filename) or die ("ERROR: Tidak bisa menambahkan file $filename");
            } else {
                die("File $filename di Direktori $filepath tidak ditemukan");
            }
        }

        $zip->close();

        // Konten apa saja yang terkandung dalam ZIP (Contoh : PDF, Application, etc)
        $headers = ["Content-Type"=>"pdf/zip"];

        return response()->download($zip_path,$zip_name,$headers);
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
        return Redirect::back()->with('message','Hapus Berkas Rapat Berhasil');
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

        $data = [
            // 'count' => $total,
            'show' => $show
        ];

        return response()->json($show, 200);
    }
}

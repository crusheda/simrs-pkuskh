<?php

namespace App\Http\Controllers\it\log;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\logit;
use App\Models\ref_logit;
use App\Models\user;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Storage;
use Response;
use Redirect;
use Auth;
use \PDF;
use Image;

class logController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = logit::join('ref_logit','ref_logit.id','=','logit.kegiatan')->select('ref_logit.kegiatan as nama_kegiatan','ref_logit.kategori as nama_kategori','logit.*')->orderBy('created_at','DESC')->limit('20')->get();
        $showAll = logit::join('ref_logit','ref_logit.id','=','logit.kegiatan')->select('ref_logit.kegiatan as nama_kegiatan','ref_logit.kategori as nama_kategori','logit.*')->orderBy('created_at','DESC')->get();
        $ref = ref_logit::orderBy('kategori','DESC')->get();
        $user = DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('users.*')
                ->where('roles.name', 'it')
                ->where('users.status', null)
                ->where('users.nama', '<>','')
                ->where('users.name', '<>','it')
                ->where('users.name', '<>','ztaqin')
                ->get();

        $data = [
            'user' => $user,
            'ref' => $ref,
            'show' => $show,
            'showAll' => $showAll,
        ];

        return view('pages.new.it.supervisi.supervisi')->with('list', $data);
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
        $this->validate($request,[
            'nama' => 'required',
            'kegiatan' => 'required',
            'keterangan' => 'nullable',
            'lokasi' => 'nullable',
            'title' => 'nullable',
            'file' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:50000',
            ]);

        if ($request->kegiatan == "Pilih") {
            return Redirect::back()->withErrors(['msg' => 'Pilih Kegiatan terlebih dahulu']);
        } else {
            $kegiatan = $request->kegiatan;
        }
        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');     
        // print_r($uploadedFile);
        // die();
        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        if ($uploadedFile == '') {
            $path = '';
            $title = '';
        }else {
            $path = $uploadedFile->store('public/files/it/log');
            $title = $request->title ?? $uploadedFile->getClientOriginalName();
        }
        // print_r($request->lokasi);
        // die();

        $find = user::where('id', $request->nama)->first();

        $data = new logit;
        $data->id_user = $find->id;
        $data->nama = $find->nama;

        $data->kegiatan = $kegiatan;
        
            $data->title = $title;
            
            $data->filename = $path;
        if ($request->keterangan == '') {
            $data->keterangan = '';
            if ($request->lokasi == '') {
                $data->lokasi = '';
            }else {
                $data->lokasi = $request->lokasi;
            }
        }elseif ($request->lokasi == '') {
            $data->lokasi = '';
            if ($request->keterangan == '') {
                $data->keterangan = '';
            }else {
                $data->keterangan = $request->keterangan;
            }
        }else {
            $data->lokasi = $request->lokasi;
            $data->tgl = Carbon::now();
            $data->keterangan = $request->keterangan;
        }

        $data->save();
        return redirect('/it/supervisi')->with('message','Tambah Kegiatan Supervisi Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = logit::find($id);
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
        $data = logit::find($id);
        // return view('pages.it.log.index')->with('list', $data);
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
            // 'kegiatan' => 'required',
            'lokasi' => 'nullable',
            'keterangan' => 'nullable',
            'tgl' => 'nullable',
            ]);

        // $getTgl = Carbon::createFromFormat('Y-m-d H:i:s', $request->tgl)->format('F j, Y @ g:i A');

        $data = logit::find($id);
        $data->tgl = $request->tgl;

        if ($request->keterangan == '') {
            $data->keterangan = '';
            if ($request->lokasi == '') {
                $data->lokasi = '';
            }else {
                $data->lokasi = $request->lokasi;
            }
        }elseif ($request->lokasi == '') {
            $data->lokasi = '';
            if ($request->keterangan == '') {
                $data->keterangan = '';
            }else {
                $data->keterangan = $request->keterangan;
            }
        }else {
            $data->lokasi = $request->lokasi;
            $data->keterangan = $request->keterangan;
        }

        $data->save();
        return redirect()->back()->with('message','Perubahan Kegiatan Supervisi Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = logit::find($id);
        $delete_file = $data->filename;
        Storage::delete($delete_file);
        $data->delete();

        // redirect
        return \Redirect::to('/it/supervisi')->with('message','Hapus Kegiatan Supervisi Berhasil');
    }

    // public function showGambar($id)
    // {
    //     return Image::make(storage_path() . '/it/log/' . $id )->response();
    //     // print_r($id);
    //     // die();
    // }

    // public function showPDF($id)
    // {
    //     $file = logit::find($id);
    //     // print_r($file);
    //     // die();
    //     return response()->file(storage_path('/app/'.$file->filename));
    // }

    public function showAll()
    {
        $show = logit::join('ref_logit','ref_logit.id','=','logit.kegiatan')->select('ref_logit.kegiatan as nama_kegiatan','ref_logit.kategori as nama_kategori','logit.*')->orderBy('created_at','DESC')->get();
        $user = DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('users.*')
                ->where('roles.name', 'it')
                ->get();

        $data = [
            'user' => $user,
            'show' => $show
        ];

        return view('pages.new.it.supervisi.supervisiAll')->with('list', $data);
    }

    public function getLampiran($id)
    {
        $data = logit::where('id', $id)->get();

        return response()->json($data, 200);
    }

    public function unduhLampiran($id)
    {
        $data = logit::find($id);
        return Storage::download($data->filename, $data->title);
    }
}

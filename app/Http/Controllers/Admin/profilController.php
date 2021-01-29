<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\data_users;
use App\Models\foto_profil;
use App\user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Storage;
use Exception;
use Redirect;

class profilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user  = Auth::user();
        $id    = $user->id;
        $name  = $user->name;
        $email = $user->email;
        $role  = $user->roles->first()->name; //kabag-keperawatan
        // $show  = data_users::where('user_id','=', $id)->get();
        $show = DB::table('data_users')
                ->where('user_id', '=', $id)
                // ->get()
                ->first();

        $foto = DB::table('foto_profil')
                ->where('user_id', '=', $id)
                // ->get()
                ->first();

        if (empty($show)) {
            
        } else {
            # code...
        }
        

        $data = [
            // 'id_user' => $id,
            // 'name_user' => $name,
            'data_user' => $show,
            'foto' => $foto,
            'user' => $user
        ];
        // print_r($user->nama);
        // die();

        return view('profil')->with('list', $data);
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
        $id = $request->id;
        $name = $request->name;
        $nama = $request->nama;
        $email = $request->email;
        
        $query_string = "SELECT * FROM data_users WHERE user_id = $id";
        $find = DB::select($query_string);

        // print_r($find);
        // die();

        // Ubah data Kepegawaian Table data_users
        if (empty($find)) {
            $data = new data_users;
            $data->user_id = $id;
            $data->nama = $nama;
            $data->save();            
        } else {
            $data = DB::table('data_users')
            ->where('user_id', '=', $id)
            ->update(['nama' => $nama]);
        }

        // ubah data Table User
        $data = user::find($id);
        $data->name = $name;
        $data->email = $email;
        $data->save();  
        
        return Redirect::back()->with('message','Data Akun Berhasil Di Ubah');
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

    public function storeImg(Request $request)
    {
        $this->validate($request,[
            'file' => 'nullable|file|max:1000000',
            ]);
        
        $now = Carbon::now();

        // tampung berkas yang sudah diunggah ke variabel baru
        // 'file' merupakan nama input yang ada pada form
        $uploadedFile = $request->file('file');     
        // print_r($uploadedFile);
        // die();
        // simpan berkas yang diunggah ke sub-direktori 'public/files'
        // direktori 'files' otomatis akan dibuat jika belum ada
        if ($uploadedFile == '') {
            return redirect()->back()->with('message','Upload Foto Gagal, tidak ada foto yang dimasukkan.');
        }else {
            $path = $uploadedFile->store('public/files/foto_profil');
            $title = $request->title ?? $uploadedFile->getClientOriginalName();
        }
        // print_r($request->lokasi);
        // die();
        $user  = Auth::user();
        $id    = $user->id;
        $name  = $user->name;
        $role  = $user->roles->first()->name; //kabag-keperawatan

        $query = foto_profil::where('user_id', $id)->first();

        if ($query == null) {
            $data = new foto_profil;
            $data->user_id = $id;
            $data->name = $name;
            $data->unit = $role;
            
                $data->title = $title;
                $data->filename = $path;

            $data->created_at = $now;
            $data->save();
        } else {
            $data = foto_profil::find($query->id);
            $data->user_id = $id;
            $data->name = $name;
            $data->unit = $role;
            
                $data->title = $title;
                $data->filename = $path;

            $data->updated_at = $now;
            $data->save();
        }
        
        return redirect()->back()->with('message','Ubah Foto Profil Berhasil');
    }
}

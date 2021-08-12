<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\data_users;
use App\Models\foto_profil;
use App\Models\ac_profiles;
use App\Models\user;
use App\Models\logs;
use App\Models\location_province;
use App\Models\location_city;
use App\Models\location_district;
use App\Models\location_village;
use App\Models\ref_desa;
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

        $showuser = user::where('id', $id)->first();
        
        $foto = DB::table('foto_profil')
                ->where('user_id', '=', $id)
                // ->get()
                ->first();      
        
        $showlog = logs::where('user_id', $id)->where('log_type', '=', 'login')->select('log_date')->orderBy('log_date', 'DESC')->get();
        
        $provinsi = ref_desa::select('provinsi')->groupBy('provinsi')->get();
        // $propinsi = ref_desa::select('propinsi')->groupBy('nama_kabkota')->get();
        $nama_kabkota = ref_desa::select('nama_kabkota')->groupBy('nama_kabkota')->get();
        $kecamatan = ref_desa::select('kecamatan')->groupBy('kecamatan')->get();
        $desa = ref_desa::select('desa')->groupBy('desa')->get();
        // $province = location_province::get();
        // $city = location_city::get();
        // $district = location_district::get();
        // $village = location_village::get();

        $data = [
            // 'id_user' => $id,
            'showuser' => $showuser,
            'showlog' => $showlog,
            'data_user' => $show,
            'foto' => $foto,
            'user' => $user,
            'provinsi' => $provinsi,
            'nama_kabkota' => $nama_kabkota,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
            // 'city' => $city,
            // 'district' => $district,
            // 'village' => $village
        ];
        // print_r($data['showlog'][1]->log_date);
        // die();
        // print_r($data['nama_kabkota']);
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
        
        // $query_string = "SELECT * FROM data_users WHERE user_id = $id";
        // $find = DB::select($query_string);

        // print_r($find);
        // die();

        // Ubah data Kepegawaian Table data_users
        $data = user::find($id);
        $data->name = $request->name;
        $data->nik = $request->nik;
        $data->nama = $request->nama;
        $data->nick = $request->nick;
        $data->temp_lahir = $request->temp_lahir;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->jns_kelamin = $request->jns_kelamin;
        $data->status_kawin = $request->status_kawin;
        $data->email = $request->email;
        $data->no_hp = $request->no_hp;
        $data->ig = $request->ig;
        $data->fb = $request->fb;

            // ALAMAT KTP
            $data->alamat_ktp = $request->alamat_ktp;
            if (empty($data->ktp_provinsi)) {
                $data->ktp_provinsi = $request->ktp_provinsi;
            } else {
                if ($request->ktp_provinsi == null) {   
                } else {
                    $data->ktp_provinsi = $request->ktp_provinsi;
                }
            }
            if (empty($data->ktp_kabupaten)) {
                $data->ktp_kabupaten = $request->ktp_kabupaten;
            } else {
                if ($request->ktp_kabupaten == null) {   
                } else {
                    $data->ktp_kabupaten = $request->ktp_kabupaten;
                }
            }
            if (empty($data->ktp_kecamatan)) {
                $data->ktp_kecamatan = $request->ktp_kecamatan;
            } else {
                if ($request->ktp_kecamatan == null) {   
                } else {
                    $data->ktp_kecamatan = $request->ktp_kecamatan;
                }
            }
            if (empty($data->ktp_kelurahan)) {
                $data->ktp_kelurahan = $request->ktp_kelurahan;
            } else {
                if ($request->ktp_kelurahan == null) {   
                } else {
                    $data->ktp_kelurahan = $request->ktp_kelurahan;
                }
            }

            // ALAMAT DOMISILI
            if ($request->cek_dom == '0') {
                $data->dom_provinsi = null;
                $data->dom_kabupaten = null;
                $data->dom_kecamatan = null;
                $data->dom_kelurahan = null;
                $data->alamat_dom = null;
            } else {
                $data->alamat_dom = $request->alamat_dom;
                if (empty($data->dom_provinsi)) {
                    $data->dom_provinsi = $request->dom_provinsi;
                } else {
                    if ($request->dom_provinsi == null) {   
                    } else {
                        $data->dom_provinsi = $request->dom_provinsi;
                    }
                }
                if (empty($data->dom_kabupaten)) {
                    $data->dom_kabupaten = $request->dom_kabupaten;
                } else {
                    if ($request->dom_kabupaten == null) {   
                    } else {
                        $data->dom_kabupaten = $request->dom_kabupaten;
                    }
                }
                if (empty($data->dom_kecamatan)) {
                    $data->dom_kecamatan = $request->dom_kecamatan;
                } else {
                    if ($request->dom_kecamatan == null) {   
                    } else {
                        $data->dom_kecamatan = $request->dom_kecamatan;
                    }
                }
                if (empty($data->dom_kelurahan)) {
                    $data->dom_kelurahan = $request->dom_kelurahan;
                } else {
                    if ($request->dom_kelurahan == null) {   
                    } else {
                        $data->dom_kelurahan = $request->dom_kelurahan;
                    }
                }
            }

            $data->sd = $request->sd;
            $data->smp = $request->smp;
            $data->sma = $request->sma;
            $data->d1 = $request->d1;
            $data->d3 = $request->d3;
            $data->d4 = $request->d4;
            $data->s1 = $request->s1;
            $data->s2 = $request->s2;
            $data->s3 = $request->s3;
            
            if (empty($data->th_sd)) {
                $data->th_sd = $request->th_sd;
            } else {
                if ($request->th_sd == null) {   
                } else {
                    $data->th_sd = $request->th_sd;
                }
            }
            if (empty($data->th_smp)) {
                $data->th_smp = $request->th_smp;
            } else {
                if ($request->th_smp == null) {   
                } else {
                    $data->th_smp = $request->th_smp;
                }
            }
            if (empty($data->th_sma)) {
                $data->th_sma = $request->th_sma;
            } else {
                if ($request->th_sma == null) {   
                } else {
                    $data->th_sma = $request->th_sma;
                }
            }
            if (empty($data->th_d1)) {
                $data->th_d1 = $request->th_d1;
            } else {
                if ($request->th_d1 == null) {   
                } else {
                    $data->th_d1 = $request->th_d1;
                }
            }
            if (empty($data->th_d3)) {
                $data->th_d3 = $request->th_d3;
            } else {
                if ($request->th_d3 == null) {   
                } else {
                    $data->th_d3 = $request->th_d3;
                }
            }
            if (empty($data->th_d4)) {
                $data->th_d4 = $request->th_d4;
            } else {
                if ($request->th_d4 == null) {   
                } else {
                    $data->th_d4 = $request->th_d4;
                }
            }
            if (empty($data->th_s1)) {
                $data->th_s1 = $request->th_s1;
            } else {
                if ($request->th_s1 == null) {   
                } else {
                    $data->th_s1 = $request->th_s1;
                }
            }
            if (empty($data->th_s2)) {
                $data->th_s2 = $request->th_s2;
            } else {
                if ($request->th_s2 == null) {   
                } else {
                    $data->th_s2 = $request->th_s2;
                }
            }
            if (empty($data->th_s3)) {
                $data->th_s3 = $request->th_s3;
            } else {
                if ($request->th_s3 == null) {   
                } else {
                    $data->th_s3 = $request->th_s3;
                }
            }

        if (Auth::user()->hasRole('kepegawaian')) {
            $data->nip = $request->nip;
            $data->jabatan = $request->jabatan;
            $data->masuk_kerja = $request->masuk_kerja;
            $data->no_str = $request->no_str;
            $data->masa_str = $request->masa_str;
            $data->masa_sip = $request->masa_sip;
            $data->pengalaman_kerja = $request->pengalaman_kerja;   
        } else {
            $data->pengalaman_kerja = $request->pengalaman_kerja;   
        }
        
        $data->riwayat_penyakit = $request->riwayat_penyakit;
        $data->riwayat_penyakit_keluarga = $request->riwayat_penyakit_keluarga;
        $data->riwayat_operasi = $request->riwayat_operasi;
        $data->riwayat_penggunaan_obat = $request->riwayat_penggunaan_obat;

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
            // print_r($uploadedFile);
            // die();
            $save = Storage::disk('image')->put('', $uploadedFile);
        }
        // print_r($save);
        // die();
        $user  = Auth::user();
        $id    = $user->id;
        $name  = $user->name;
        $role  = $user->roles->first()->name; //kabag-keperawatan

        $query = foto_profil::where('user_id', $id)->first();
        $queryAcProfiles = ac_profiles::where('user_id', $id)->first();
        $getUser = user::where('id',$id)->first();
        $getDetailUser = DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('roles.name as nama_role','users.*')
                ->where('users.id',$id)
                ->first();

        // Save to Foto Profil
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

        // Save to Ac Profiles
        if ($queryAcProfiles == null) {
            $chat = new ac_profiles;
            $chat->user_id = $id;
            $chat->fullname = $getUser->nama.' - '.$getDetailUser->nama_role;
            $chat->avatar = $save;
            $chat->status = 0;
            $chat->dt_updated = $now;
            $chat->save();
        } else {
            Storage::disk('image')->delete($queryAcProfiles->avatar);
            $queryAcProfiles->fullname = $getUser->nama.' - '.$getDetailUser->nama_role;
            $queryAcProfiles->avatar = $save;
            $queryAcProfiles->dt_updated = $now;
            $queryAcProfiles->save();
        }
        
        
        return redirect()->back()->with('message','Ubah Foto Profil Berhasil');
    }

    public function apiProvinsi($id)
    {
        $data = DB::table('ref_desa')
                ->select('nama_kabkota')
                ->where('provinsi', $id)
                ->groupBy('nama_kabkota')
                ->get();
        
        return response()->json($data, 200);
    }

    public function apiKota($id)
    {
        $data = DB::table('ref_desa')
                ->select('kecamatan')
                ->where('nama_kabkota', $id)
                ->groupBy('kecamatan')
                ->get();
        
        return response()->json($data, 200);
    }

    public function apiKecamatan($id)
    {
        $data = DB::table('ref_desa')
                ->select('desa')
                ->where('kecamatan', $id)
                ->groupBy('desa')
                ->get();
        
        return response()->json($data, 200);
    }
}

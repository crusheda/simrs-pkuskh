<?php

namespace App\Http\Controllers\excell;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Exports\insentifExport;
use App\Imports\insentifImport;
use App\Models\user;
use App\Models\insentifKehadiran;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Session;

class insentifController extends Controller
{
    public function index() {

        $user = user::whereNotNull('nik')->where('status',null)->get();
        $show = insentifKehadiran::get();
        $userAll = DB::table('users')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select('roles.name as nama_role','users.*')
                ->where('users.status',null)
                ->get();

        $data = [
            'userAll' => $userAll,
            'user' => $user,
            'show' => $show
        ];

        // print_r($data);
        // die();
        return view('pages.it.finger.index')->with('list', $data);
    }

    public function export() {
        return Excel::download(new insentifExport, 'users.xlsx');
    }

    public function import(Request $request) {
        
        // Validasi FILE
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

        // Validasi DB
        $tgl = Carbon::now()->isoFormat('DD-MM-YY');
        $getLast = insentifKehadiran::orderBy('created_at','DESC')->first();
        if (!empty($getLast)) {
            $convertGet = Carbon::parse($getLast->created_at)->isoFormat('DD-MM-YY');
            // print_r($getLast->created_at);
            // die();

            if ($tgl == $convertGet) {
                insentifKehadiran::where('created_at', $getLast->created_at)->delete();
            }
        }

		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = $tgl.'_'.$file->getClientOriginalName();
 
		// upload ke folder file_siswa di dalam folder public
		$file->move('excell',$nama_file);
 
		// import data
		Excel::import(new insentifImport, public_path('/excell/'.$nama_file));
 
		// notifikasi dengan session
		Session::flash('sukses','Data Finger Berhasil Diimport!');
 
		// alihkan halaman kembali
		return back();
    }
}

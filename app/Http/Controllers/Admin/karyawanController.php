<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\karyawan;
use App\Models\user;
// use App\user;
use Illuminate\Http\Request;
use Redirect;
use Auth;

class karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $show = karyawan::get();

        $user  = Auth::user();
        $id    = $user->id;
        $name  = $user->name;
        $email = $user->email;
        $role  = $user->roles->first()->name; //kabag-keperawatan

        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.id', 'users.name', 'roles.name AS unit')
            ->get();

            // print_r($users);
            // die();

        $data = [
            'show' => $show,
            'users' => $users
        ];

        return view('admin.karyawan')->with('list', $data);
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
        // $users = user::select('')
        $users = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('roles.name AS unit')
            ->where('users.id', '=', $request->user_id)
            ->first();
        // print_r($users->unit);
        // die();

        $data = new karyawan;
        $data->user_id = $request->user_id;
        $data->name = $request->name;
        $data->unit = $users->unit;
        $data->save();

        return Redirect::back()->with('message','Penambahan Data Karyawan Berhasil');
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
        $data = karyawan::find($id);
        $data->user_id = $request->user_id;
        $data->name = $request->name;
        $data->unit = $request->unit;

        $data->save();

        return Redirect::back()->with('message','Perubahan Karyawan Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = karyawan::find($id);
        $data->delete();

        return Redirect::back()->with('message','Karyawan berhasil dihapus');
    }
}

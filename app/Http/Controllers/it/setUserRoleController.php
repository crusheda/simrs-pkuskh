<?php

namespace App\Http\Controllers\it;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\setRoleUser;
use App\Models\role;
use App\Models\user;
use Carbon\Carbon;
use Auth;
use Redirect;

class setUserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $show = setRoleUser::get();
        $show = DB::table('set_role_users')
                ->join('users', 'set_role_users.id_user', '=', 'users.id')
                ->where('set_role_users.deleted_at',null)
                ->select('users.name','users.nama','set_role_users.*')
                // ->limit('30')
                ->get();
        $user = user::get();
        $role = role::get();
        // print_r($show);
        // die();

        $data = [
            'show' => $show,
            'user' => $user,
            'role' => $role
        ];

        return view('pages.it.user-setrole')->with('list', $data);
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
        $data = new setRoleUser;
        $data->id_user = $request->user;
        $data->id_roles = $request->role;
        $data->save();
        return Redirect::back()->with('message','Set Role User Berhasil');
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
        $data = setRoleUser::find($id);
        $data->id_user = $request->user;
        $data->id_roles = $request->role;
        $data->save();
        return Redirect::back()->with('message','Ubah Role User Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = setRoleUser::find($id);
        $data->delete();
        return Redirect::back()->with('message','Hapus Role User Berhasil');
    }
}

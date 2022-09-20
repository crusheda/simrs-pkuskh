<?php

namespace App\Http\Controllers\administrator\user;

use App\Http\Controllers\Controller;
// use App\Http\Requests\Admin\StoreUsersRequest;
// use App\Http\Requests\Admin\UpdateUsersRequest;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use App\Models\user;
use App\Models\role;
use App\Models\setRoleUser;
use Redirect;
// use Spatie\Permission\Models\Role;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $show = user::Join('set_role_users', 'users.id', '=', 'set_role_users.id_user')
        //         ->Join('roles', 'set_role_users.id_roles', '=', 'roles.id')
        //         ->select('roles.id as id_roles','roles.name as nama_roles','users.id','users.name','users.updated_at')
        //         ->orderBy('users.updated_at', 'asc')
        //         ->get();
        $user = user::select('id','name','nama','updated_at')->orderBy('nama', 'asc')->get();
        $role = setRoleUser::join('roles', 'set_role_users.id_roles', '=', 'roles.id')->select('set_role_users.id_user','roles.name as nama_role')->get();

        $data = [
            'user' => $user,
            'role' => $role,
        ];
        
        return view('pages.administrator.user.index')->with('list', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = user::find($id);
        $role = setRoleUser::join('roles', 'set_role_users.id_roles', '=', 'roles.id')->select('set_role_users.id_user','roles.id as id_role','roles.name as nama_role')->get();

        $data = [
            'user' => $user,
            'role' => $role,
        ];
        
        return view('pages.administrator.user.ubah')->with('list', $data);
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
}

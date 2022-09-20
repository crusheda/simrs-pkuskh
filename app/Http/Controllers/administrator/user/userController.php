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
use App\Models\model_has_roles;
use Redirect;
use Carbon\Carbon;
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
        $role = model_has_roles::join('roles', 'model_has_roles.role_id', '=', 'roles.id')->select('model_has_roles.model_id as id_user','roles.name as nama_role')->get();

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
        $role = role::get();
        
        return view('pages.administrator.user.tambah')->with('role', $role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new user;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        foreach ($request->role as $key => $value) {
            $model = new model_has_roles;
            $model->role_id = $value;
            $model->model_type = 'App\User';
            $model->model_id = $data->id;
            // print_r($model);
            // die();
            $model->save();
        }

        return redirect()->route('user.index')->with('message','Ubah Akun '.$data->name.' Berhasil');
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
        $model = model_has_roles::where('model_id', $id)->get();
        $role = role::get();

        // print_r($model);
        // die();

        $data = [
            'user' => $user,
            'model' => $model,
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
        // print_r(bcrypt($request->password));
        // print_r($request->role);
        // die();

        $data = user::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        if (!empty($request->password)) {
            $data->password = bcrypt($request->password);
        }
        $data->save();

        model_has_roles::where('model_id', $id)->delete();

        foreach ($request->role as $key => $value) {
            $model = new model_has_roles;
            $model->role_id = $value;
            $model->model_type = 'App\User';
            $model->model_id = $id;
            // print_r($model);
            // die();
            $model->save();
        }

        return redirect()->route('user.index')->with('message','Ubah Akun '.$data->name.' Berhasil');
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

    public function verifName($name)
    {
        $data = user::where('name',$name)->first();
        if (!empty($data)) {
            $retur = 1;
        } else {
            $retur = 0;
        }
        
        return response()->json($retur, 200);
    }

    public function hapus($id)
    {
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = user::find($id);
        $data->delete();
        model_has_roles::where('model_id', $id)->delete();
        
        return response()->json($tgl, 200);
    }
}
